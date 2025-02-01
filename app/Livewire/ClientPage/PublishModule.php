<?php

namespace App\Livewire\ClientPage;

use App\Models\ModuleChangelog;
use App\Models\ModuleToken;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.clientarea')]
#[Title('Publish Module | Client Area')]
class PublishModule extends Component
{
    public function with()
    {
        $userToken = ModuleToken::query()->firstOrCreate(['user_id' => auth('web')->user()->id], [
            'token' => Str::random('30'),
        ]);

        return [
            'changelogs' => ModuleChangelog::all(),
            'token' => $userToken,
        ];
    }

    public function render()
    {
        return view('livewire.client-page.publish-module', $this->with());
    }
}
