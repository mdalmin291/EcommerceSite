<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;

class DelieveryMethod extends Component
{

    public function deliveryMethodSave(){
        dd('');
    }

    public function deliveryModal(){
        $this->emit('modal','deliveryModal');
    }
    public function render()
    {
        return view('livewire.inventory.delivery-method');
    }
}
