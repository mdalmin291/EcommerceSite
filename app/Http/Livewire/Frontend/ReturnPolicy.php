<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class ReturnPolicy extends Component
{
    public function render()
    {
        return view('frontend.return-policy')
        ->layout('layouts.front_end');
    }
}
