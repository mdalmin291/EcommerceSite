<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return view('frontend.contact')
        ->layout('layouts.front_end');
    }
}
