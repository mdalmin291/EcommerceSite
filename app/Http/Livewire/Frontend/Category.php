<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Category extends Component
{
    public function render()
    {
        return view('livewire.frontend.category')
        ->layout('layouts.front_end');
    }
}
