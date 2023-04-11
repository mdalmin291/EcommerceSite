<?php
namespace App\Http\Livewire\Inventory;
use App\Models\Inventory\Language as LanguageM;
use Livewire\Component;

class Language extends Component{

    public function languageSave(){
        dd('');
    }
    public function LanguageModel(){
        $this->emit('modal','LanguageModel');
    }
    public function render(){
        return view('livewire.Inventory.language');
    }
}
