<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Wishlist extends Component
{
    public function render()
    {
        return view('livewire.frontend.wishlist')
        ->layout('layouts.front_end');
    }
}
