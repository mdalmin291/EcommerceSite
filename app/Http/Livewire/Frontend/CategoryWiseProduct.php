<?php

namespace App\Http\Livewire\Frontend;
use App\Models\Backend\ProductInfo\ProductImage;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\SubCategory;
use Livewire\Component;

class CategoryWiseProduct extends Component
{
    public $singleCategory;
    public function mount($id=NULL){
        $this->singleCategory=Category::find($id);
    }
    public function render()
    {
        return view('livewire.frontend.category_wise_product')
        ->layout('layouts.front_end');
    }
}
