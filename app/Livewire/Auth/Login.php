<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
class Login extends Component
{
    public function render()
    {
        if(auth('web')->check()){
            return redirect()->route('clientarea.dashboard');
        }

        return view('livewire.auth.login');
    }
}
