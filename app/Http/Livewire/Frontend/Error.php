<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Error extends Component
{
    public function render()
    {
        return view('livewire.frontend.error')
            ->layout('layouts.front_end');
    }
}
