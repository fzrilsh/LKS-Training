<?php

namespace App\Livewire\ClientPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.clientarea')]
#[Title('Dashboard | Client Area')]
class Dashboard extends Component
{
    public function with(): array
    {
        return [
            'tasks' => auth('web')->user()->module_tasks,
        ];
    }

    public function render()
    {
        return view('livewire.client-page.dashboard', $this->with());
    }
}
