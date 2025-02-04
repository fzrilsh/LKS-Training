<?php

namespace App\Livewire\ClientPage;

use App\Models\ModuleChangelog;
use App\Models\ModuleToken;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.clientarea')]
#[Title('Publish Module | Client Area')]
class PublishModule extends Component
{
    use Interactions;

    public function with()
    {
        $userToken = ModuleToken::query()->firstOrCreate(['user_id' => auth('web')->user()->id], [
            'token' => Str::random('30'),
        ]);

        return [
            'changelogs' => ModuleChangelog::all()->sortByDesc('created_at'),
            'token' => $userToken,
        ];
    }

    public function render()
    {
        return view('livewire.client-page.publish-module', $this->with());
    }

    public function downloadTemplate()
    {
        $this->toast()->timeout(5)->success('File Downloaded.', 'Template format berhasil di download.')->send();

        return response()->download(Storage::path('contoh.zip'));
    }
}
