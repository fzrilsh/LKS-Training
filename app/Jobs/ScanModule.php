<?php

namespace App\Jobs;

use App\Imports\MarkingImport;
use App\Models\Module;
use App\Models\ModuleChangelog;
use App\Models\ModuleToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class ScanModule implements ShouldQueue
{
    use Queueable;

    public function __construct() {}

    public function handle(): void
    {
        $zips = collect(Storage::files('modules-ftp'));
        $zips->filter(fn ($name) => ! str_ends_with($name, '.zip'))->each(fn ($name) => Storage::delete($name));

        $zips = collect(Storage::files('modules-ftp'));
        if (! count($zips)) {
            return;
        }

        $zips->each(function ($filename) {
            $fullPath = Storage::path($filename);

            $destinationFolderName = now()->format('d-m-Y_H:i:s').'_'.Str::random(10);
            $destinationFolderPath = Storage::path("modules/{$destinationFolderName}");

            $zip = new ZipArchive;
            if ($zip->open($fullPath) === true) {
                $zip->extractTo($destinationFolderPath);
                $zip->close();

                $this->getModuleDetail("modules/{$destinationFolderName}", date('d-m-Y H:i', filectime(Storage::path($filename))));
                // Storage::delete($filename);
            } else {
                Log::error("Failed to open: {$filename}");
            }
        });
    }

    public function getModuleDetail(string $path, $filecreatedAt)
    {
        if (! Storage::exists($path.'/readme.txt')) {
            $filename = basename($path);

            ModuleChangelog::query()->create(['message' => "Module yang diupload dengan nama file {$filename} pada {$filecreatedAt} tidak sesuai format."]);

            return $this->deleteModule($path);
        }

        [$token, $name, $category, $summary, $moduleFilename, $mediaFilename, $markingFilename] = $this->parseReadme(Storage::get($path.'/readme.txt'));

        $token = ModuleToken::query()->where('token', $token)->first();
        if (! $token) {
            ModuleChangelog::query()->create(['message' => "Token untuk module yang diupload pada {$filecreatedAt} tidak valid."]);

            return $this->deleteModule($path);
        }

        $errors = [];
        $validator = Validator::make(['name' => $name, 'category' => $category, 'summary' => $summary], [
            'name' => 'required|unique:modules,name',
            'category' => 'required',
            'summary' => 'required',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                $errors[] = 'Nama harus unik.';
            }
            if ($validator->errors()->has('category')) {
                $errors[] = 'Category harus dicantumkan.';
            }
            if ($validator->errors()->has('summary')) {
                $errors[] = 'Summary harus dicantumkan.';
            }
        }

        if (! str_ends_with($moduleFilename, '.docx')) {
            $errors[] = 'File module harus berupa docx.';
        }

        if (! str_ends_with($mediaFilename, '.zip')) {
            $errors[] = 'Media file harus berupa zip.';
        }

        if (! str_ends_with($markingFilename, '.xlsx')) {
            $errors[] = 'File marking harus berupa xlsx.';
        }

        if (
            ! Storage::exists("{$path}/{$moduleFilename}") ||
            ! Storage::exists("{$path}/{$mediaFilename}") ||
            ! Storage::exists("{$path}/{$markingFilename}")
        ) {
            $errors[] = 'File wajib seperti Module, Media, atau Marking tidak dapat ditemukan.';
        }

        if (
            (filesize(Storage::path("{$path}/{$moduleFilename}")) < 1000) ||
            (filesize(Storage::path("{$path}/{$markingFilename}")) < 1000)
        ) {
            $errors[] = 'File wajib seperti Module atau Marking kosong.';
        }

        if (! Storage::exists("{$path}/{$moduleFilename}")) {
            $errors[] = 'File docx module tidak ditemukan.';
        }

        if (! Storage::exists("{$path}/{$mediaFilename}")) {
            $errors[] = 'File zip media tidak ditemukan.';
        }

        if (! Storage::exists("{$path}/{$markingFilename}")) {
            $errors[] = 'File xlsx marking tidak ditemukan.';
        }

        $markingData = filesize(Storage::path("{$path}/{$markingFilename}")) > 0 ? $this->parseExcel(Excel::toArray(new MarkingImport, Storage::path("{$path}/{$markingFilename}"))[0]) : [];
        if (! $markingData->count()) {
            $errors[] = 'File xlsx marking tidak sesuai format.';
        }

        if (count($errors)) {
            $error = collect($errors)->join("\n- ");

            ModuleChangelog::query()->create(['message' => "Module yang diupload dengan nama {$name} pada {$filecreatedAt} tidak sesuai format yang telah ditentukan.\n- {$error}"]);

            return $this->deleteModule($path);
        }

        $module = Module::query()->create([
            'name' => $name,
            'category' => strtolower($category),
            'summary' => $summary,
            'media_path' => "{$path}/{$mediaFilename}",
            'exercise_path' => "{$path}/{$moduleFilename}",
            'marking_path' => "{$path}/{$markingFilename}",
            'publisher_id' => $token->user_id,
        ]);

        $module->Marking()->create([
            'json' => json_encode($markingData->toArray()),
            'max_point' => $markingData->reduce(fn($a, $b) => $a + $b['total_point'])
        ]);

        $token->delete();
        ModuleChangelog::query()->create(['message' => "Module yang diupload dengan nama {$name} pada {$filecreatedAt} telah lulus verifikasi."]);
    }

    public function parseReadme(string $input): array
    {
        $lines = explode("\n", $input);

        $result = [];

        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }

            $value = trim(explode(':', $line, 2)[1]);

            $result[] = $value;
        }

        return $result;
    }

    public function deleteModule(string $path): void
    {
        File::deleteDirectory(Storage::path($path));
    }

    public function parseExcel(array $rows): Collection{
        $headers = $rows[0];

        $columns = [];
        foreach ($headers as $index => $header) {
            if(is_null($header)) continue;

            if (str_contains(strtolower($header), 'aspect - description')) {
                $columns['description'] = $index;
            }

            if (str_contains(strtolower($header), 'max')) {
                $columns['total_point'] = $index;
            }

            if (str_contains(strtolower($header), 'requirement')) {
                $columns['requirement'] = $index;
            }
        }

        if(!count($columns)) return collect([]);

        $filtered = collect($rows)->filter(function ($row) {
            return isset($row[3]) && $row[3] === 'M';
        });

        $results = $filtered->map(function ($row) use ($columns) {
            return [
                'description' => $row[$columns['description']] ?? null,
                'total_point' => $row[$columns['total_point']] ?? null,
                'requirement' => $row[$columns['requirement']] ?? null,
                'point' => 0,
            ];
        });

        return $results->values();
    }
}
