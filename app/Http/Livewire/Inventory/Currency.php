<?php
namespace App\Http\Livewire\Inventory;
use App\Models\Inventory\Currency as CurrencyA;
use livewire\Component;

class Currency extends Component {

    public function CurrencySave(){
        dd('');
    }
    public function CurrencyModel(){
        $this->emit('modal', 'CurrencyModel');
    }

    public function render(){
        return view('livewire.Inventory.currency');
    }
}

