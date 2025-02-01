<?php

namespace App\Livewire\ClientPage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.clientarea')]
#[Title('Upload Assets | Client Area')]
class UploadAssets extends Component
{
    use Interactions, WithFileUploads;

    public $file;

    public $files;

    protected function rules()
    {
        return [
            'file' => ['required', 'file', 'max:10240', function ($attr, $value, $fail) {
                if (! in_array($value->getMimeType(), ['text/x-php', 'text/plain', 'text/html'])) {
                    $fail('Hanya file html dan php yang diperbolehkan.');
                }
            }],
        ];
    }

    protected $messages = [
        'file.max' => 'Maksimal file size adalah 10Mb.',
        'file.mimes' => 'Hanya file html dan php yang diperbolehkan.',
    ];

    public function mount()
    {
        $this->files = auth('web')->user()->uploadedAssets()->get();
    }

    public function render()
    {
        return view('livewire.client-page.upload-assets');
    }

    public function refreshData()
    {
        $this->files = auth('web')->user()->uploadedAssets()->get();
    }

    public function updated()
    {
        $validate = Validator::make($this->all(), $this->rules(), $this->messages);
        if ($validate->fails()) {
            return $this->toast()->timeout(5)->error('Gagal upload file!', collect($validate->errors()->get('file'))->join('\n'))->send();
        }

        $this->validate();
        $user = auth('web')->user();

        $filename = $this->file->getClientOriginalName();
        $path = $this->file->storeAs("assets/{$user->id}", $filename);

        $user->uploadedAssets()->create(['path' => $path]);

        $this->file = null;
        $this->refreshData();

        $this->toast()->timeout(5)->success('File Disimpan.', "File dengan nama {$filename} berhasil disimpan.")->send();
    }

    public function delete(string $id)
    {
        $file = auth('web')->user()->uploadedAssets()->find($id);
        $filename = basename($file->path);

        Storage::delete($file->path);
        $file->delete();

        $this->refreshData();
        $this->toast()->timeout(5)->success('File Dihapus.', "File dengan nama {$filename} berhasil dihapus.")->send();
    }
}
