<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('frontend.about')
        ->layout('layouts.front_end');
    }
}
