<?php

namespace App\Http\Livewire\Frontend;
use App\Models\Backend\ProductInfo\ProductImage;
use App\Models\Backend\ProductInfo\Product;
use Livewire\Component;

class ProductView extends Component
{
    public $productImages;
    public $productMainImage;
    public $product;
    public function mount($id=NULL){
       $this->productMainImage=ProductImage::whereProductId($id)->first();
       $this->productImages=ProductImage::whereProductId($id)->take(4)->get();
       $this->product=Product::find($id);
    }
    public function render()
    {
        return view('livewire.frontend.product-view')
        ->layout('layouts.front_end');
    }
}
