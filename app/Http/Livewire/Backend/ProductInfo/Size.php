<?php

namespace App\Http\Livewire\Backend\ProductInfo;
use App\Models\Backend\ProductInfo\Size as SizeInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Size extends Component
{
    public $code;
    public $size_name;
    public $SizeId;
    public function sizeDelete($id){
        SizeInfo::find($id)->delete();
        $this->emit('success', [
            'text' => 'Size Deleted Successfully',
        ]);
    }
    public function sizeEdit($id){
       $QueryUpdate=SizeInfo::find($id);
       $this->SizeId=$QueryUpdate->id;
       $this->code=$QueryUpdate->code;
       $this->size_name=$QueryUpdate->size_name;
       $this->emit('modal', 'sizeModal');
    }
    public function sizeSave(){
        $this->validate([
            'code' => 'required',
            'size_name' => 'required',
        ]);

        // Insert Or Update Color
        if($this->SizeId){
           $Query=SizeInfo::find($this->SizeId);
        }else{
            $Query=new SizeInfo();
            $Query->created_by = Auth::user()->id;
        }

        $Query->code=$this->code;
        $Query->size_name=$this->size_name;
        $Query->save();
        $this->reset();
        $this->sizeModal();
        $this->emit('success', [
            'text' => 'Size C/U Successfully',
        ]);
    }

    public function sizeModal()
    {
        $this->reset();
        $this->code = 'S'.floor(time() - 999999);
        $this->emit('modal', 'sizeModal');
    }

    public function render()
    {
        return view('livewire.backend.product-info.size',[
            'sizes'=>SizeInfo::get(),
        ]);
    }
}
