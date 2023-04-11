<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Checkout extends Component
{
    public $shipping_charge;

    public function render()
    {
        return view('livewire.frontend.checkout')
        ->layout('layouts.front_end');
    }
}
