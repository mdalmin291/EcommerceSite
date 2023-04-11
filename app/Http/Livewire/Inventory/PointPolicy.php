<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;

class PointPolicy extends Component
{

    public function pointPolicySave(){
        dd('');
    }

    public function pointPolicyModel(){
        $this->emit('modal','pointPolicyModel');
    }
    public function render()
    {
        return view('livewire.Inventory.pointPolicy');
    }
}
