<?php

namespace App\Jobs;

use App\Models\Module;
use App\Models\ModuleChangelog;
use App\Models\ModuleToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use ZipArchive;

class ScanModule implements ShouldQueue
{
    use Queueable;

    public function __construct(){}

    public function handle(): void
    {
        $zips = collect(Storage::files('modules-ftp'));
        $zips->filter(fn($name) => !str_ends_with($name, '.zip'))->each(fn($name) => Storage::delete($name));

        $zips = collect(Storage::files('modules-ftp'));
        if(!count($zips)) return;

        $zips->each(function($filename){
            $fullPath = Storage::path($filename);

            $destinationFolderName = now()->format('D-m-Y_H:i:s') . '_' . Str::random(10);
            $destinationFolderPath = Storage::path("modules/{$destinationFolderName}");

            $zip = new ZipArchive;
            if ($zip->open($fullPath) === TRUE) {
                $zip->extractTo($destinationFolderPath);
                $zip->close();

                Storage::delete($filename);
                $this->getModuleDetail("modules/{$destinationFolderName}");
            } else {
                Log::error("Failed to open: {$filename}");
            }
        });
    }

    public function getModuleDetail(string $path){
        if(!Storage::exists($path . '/readme.txt')){
            $date = date('D-m-Y H:i', filectime(Storage::path($path)));
            ModuleChangelog::query()->create(['message' => "Module yang diupload pada {$date} tidak sesuai format."]);
            return $this->deleteModule($path);
        }

        [$token, $name, $category, $summary, $moduleFilename, $mediaFilename, $markingFilename] = $this->parseReadme(Storage::get($path . '/readme.txt'));

        $token = ModuleToken::query()->where('token', $token)->first();
        if(!$token){
            $date = date('D-m-Y H:i', filectime(Storage::path($path)));
            ModuleChangelog::query()->create(['message' => "Token untuk module yang diupload pada {$date} tidak valid."]);
            return $this->deleteModule($path);
        }

        $errors = [];
        $validator = Validator::make(['name' => $name, 'category' => $category, 'summary' => $summary], [
            'name' => 'required|unique:modules,name', 
            'category' => 'required',
            'summary' => 'required'
        ]);
        if($validator->fails()) {
            if($validator->errors()->has('name')) $errors[] = 'Nama harus unik.';
            if($validator->errors()->has('category')) $errors[] = 'Category harus dicantumkan.';
            if($validator->errors()->has('summary')) $errors[] = 'Summary harus dicantumkan.';
        }

        if(!str_ends_with($moduleFilename, '.docx')){
            $errors[] = 'File module harus berupa docx.';
        }

        if(!str_ends_with($mediaFilename, '.zip')){
            $errors[] = 'Media file harus berupa zip.';
        }

        if(!str_ends_with($markingFilename, '.xlsx')){
            $errors[] = 'File marking harus berupa xlsx.';
        }

        if(!Storage::exists("{$path}/{$moduleFilename}")){
            Log::info("{$path}/{$moduleFilename}");
            $errors[] = 'File docx module tidak ditemukan.';
        }

        if(!Storage::exists("{$path}/{$mediaFilename}")){
            $errors[] = 'File zip media tidak ditemukan.';
        }

        if(!Storage::exists("{$path}/{$markingFilename}")){
            $errors[] = 'File xlsx marking tidak ditemukan.';
        }

        if(count($errors)){
            $date = now()->format('D-m-Y H:i:s');
            $error = collect($errors)->join('\n- ');
            ModuleChangelog::query()->create(['message' => "Module yang diupload bernama {$name} pada {$date} tidak sesuai format yang telah ditentukan.\n- {$error}"]);
            return $this->deleteModule($path);
        }

        Module::query()->create([
            'name' => $name,
            'category' => strtolower($category),
            'summary' => $summary,
            'media_path' => "{$path}/{$mediaFilename}",
            'exercise_path' => "{$path}/{$moduleFilename}",
            'marking_path' => "{$path}/{$markingFilename}",
            'publisher_id' => $token->user_id
        ]);
    }

    public function parseReadme(string $input): array
    {
        $lines = explode("\n", $input);

        $result = [];

        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }

            $value = trim(explode(":", $line, 2)[1]);

            $result[] = $value;
        }

        return $result;
    }

    public function deleteModule(string $path): void{
        File::deleteDirectory(Storage::path($path));
    }
}
