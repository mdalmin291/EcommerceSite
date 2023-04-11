<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Customer extends Component
{
    public function render()
    {
        return view('livewire.frontend.login')
        ->layout('layouts.front_end');
    }
}
