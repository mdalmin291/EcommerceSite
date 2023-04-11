<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class OrderCompleted extends Component
{
    public function render()
    {
        return view('livewire.frontend.order-completed')
            ->layout('layouts.front_end');
    }
}
