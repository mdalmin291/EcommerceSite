<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;

class WareHouse extends Component
{
    public function warehouseSave(){
        dd('');
    }

    public function WarhouseModel(){
        $this->emit('modal','WarhouseModel');
    }

    public function render()
    {
        return view('livewire.inventory.ware-house');
    }
}
