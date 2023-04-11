<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('frontend.privacy-policy')
        ->layout('layouts.front_end');
    }
}
