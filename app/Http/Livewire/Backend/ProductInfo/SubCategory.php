<?php

namespace App\Http\Livewire\Backend\ProductInfo;
use App\Models\Inventory\Category;
use App\Models\Backend\ProductInfo\SubCategory as SubCategoryProductInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;

class SubCategory extends Component
{
    use WithFileUploads;
    public $code;
    public $name;
    public $image;
    public $description;
    public $category_id;
    public $is_active=1;
    public $QueryUpdate;
    public $SubCategoryId;

    public function SubCategoryEdit($id){
        $this->QueryUpdate = SubCategoryProductInfo::find($id);
        $this->SubCategoryId = $this->QueryUpdate->id;
        $this->code = $this->QueryUpdate->code;
        $this->name = $this->QueryUpdate->name;
        $this->description = $this->QueryUpdate->description;
        $this->category_id = $this->QueryUpdate->category_id;
        $this->is_active = $this->QueryUpdate->is_active;

        $this->emit('modal', 'SubCategoryModal');
    }
    public function SubCategoryDelete($id){
        SubCategoryProductInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'SubCategory Deleted Successfully',
        ]);
    }
    public function saveSubCategory(){
        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'is_active' => 'required',
        ]);
        if(!$this->SubCategoryId){
            $this->validate([
                'image' => 'required',
            ]);
        }
        if($this->SubCategoryId){
            $Query = SubCategoryProductInfo::find($this->SubCategoryId);
        }else{
            $Query = new SubCategoryProductInfo();
            $Query->created_by = Auth::user()->id;
        }
        $Query->code = $this->code;
        $Query->name = $this->name;
        if($this->image){
        $path = $this->image->store('/public/photo');
        $Query->image = basename($path);
        }
        $Query->description = $this->description;
        $Query->category_id = $this->category_id;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;

        $Query->save();
        $this->reset();
        $this->SubCategoryModal();

        $this->emit('success', [
            'text' => 'SubCategory Created Successfully',
        ]);
    }
    public function SubCategoryModal(){

        $this->code = 'SC'.floor(time() - 999999999);
        $this->emit('modal','SubCategoryModal');
    }
    public function render()
    {
        return view('livewire.backend.product-info.sub-category',[
           'categories'=>Category::get(),
        ]);
    }
}
