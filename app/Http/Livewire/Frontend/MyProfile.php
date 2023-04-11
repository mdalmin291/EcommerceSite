<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class MyProfile extends Component
{
    public function render()
    {
        return view('frontend.my-profile')
        ->layout('layouts.front_end');
    }
}
