<?php

namespace App\Http\Livewire\Backend\ProductInfo;

use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\ProductInfo\ProductImage;
use App\Models\Backend\ProductInfo\ProductInfo;
use App\Models\Backend\ProductInfo\ProductProperties;
use Livewire\Component;

class ProductList extends Component
{
    public $ProductDetail;

    public function ProductDetails($id)
    {
        $this->ProductDetail = Product::find($id);
        $this->emit('modal', 'productDetailModal');

        // dd($this->ProductDetail);
    }

    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        ProductInfo::whereProductId($id)->delete();
        ProductImage::whereProductId($id)->delete();
        // ProductProperties::whereProductId($id)->delete();

        $this->emit('success', [
            'text' => 'Product Deleted Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.product-info.product-list');
    }
}
