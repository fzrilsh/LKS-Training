<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ingin Menang di Lomba LKS Tanpa Mengeluarkan Uang? Disini Ajaa!')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page');
    }
}
