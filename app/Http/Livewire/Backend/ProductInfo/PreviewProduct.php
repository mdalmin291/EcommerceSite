<?php

namespace App\Http\Livewire\Backend\ProductInfo;
use App\Models\Backend\ProductInfo\Product;

use Livewire\Component;

class PreviewProduct extends Component
{
    public $ProductId;
    public function mount($id){
       $this->ProductId=$id;
    }
    public function render()
    {
        return view('livewire.backend.product-info.preview-product',[
            'ProductPreview'=>Product::find($this->ProductId),
        ]);
    }
}
