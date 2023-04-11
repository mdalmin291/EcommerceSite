<?php

namespace App\Http\Livewire\UserProfile;

use Livewire\Component;

class AuthLockScreen extends Component
{
    public function render()
    {
        return view('livewire.user-profile.auth-lock-screen')->layout('layouts.master-without-nav');
    }
}
