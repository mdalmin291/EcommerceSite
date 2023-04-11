<?php

namespace App\Http\Livewire\Backend\ProductInfo;
use App\Models\Backend\ProductInfo\Color as ColorInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Color extends Component
{
    public $name;
    public $code;
    public $color_code;
    public $ColorId;
    public function colorDelete($id){
        ColorInfo::find($id)->delete();
        $this->emit('success', [
            'text' => 'Color Deleted Successfully',
        ]);
    }
    public function colorEdit($id){
       $QueryUpdate=ColorInfo::find($id);
       $this->ColorId=$QueryUpdate->id;
       $this->code=$QueryUpdate->code;
       $this->name=$QueryUpdate->name;
       $this->color_code=$QueryUpdate->color_code;
       $this->emit('modal', 'colorModal');
    }
    public function colorSave(){
        $this->validate([
            'name' => 'required',
            'color_code' => 'required',
        ]);

        // Insert Or Update Color
        if($this->ColorId){
           $Query=ColorInfo::find($this->ColorId);
        }else{
            $Query=new ColorInfo();
            $Query->created_by = Auth::user()->id;
        }
        $Query->code=$this->code;
        $Query->name=$this->name;
        $Query->color_code=$this->color_code;
        $Query->save();
        $this->reset();
        $this->colorModal();

        $this->emit('success', [
            'text' => 'Color C/U Successfully',
        ]);
    }

    public function colorModal()
    {
        $this->reset();
        $this->code = 'C'.floor(time() - 999999);
        $this->emit('modal', 'colorModal');
    }

    public function render()
    {
        return view('livewire.backend.product-info.color',[
            'colors'=>ColorInfo::get(),
        ]);
    }
}
