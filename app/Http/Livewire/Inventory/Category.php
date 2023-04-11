<?php
namespace App\Http\Livewire\Inventory;
use App\Models\Inventory\Category as CategoryM;
use livewire\Component;
class Category extends Component{

    public $code;
    public $name;
    public $branch_id;
    public $image;
    public function CategorySave(){
        dd($this->code,$this->image);
    }
    public function CategoryModel(){
        $this->code=floor(time()-999999);
        $this->emit('modal', 'CategoryModel');
    }
    public function render(){
        return view('livewire.Inventory.category');
    }
}




