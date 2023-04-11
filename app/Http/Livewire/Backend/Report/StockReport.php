<?php

namespace App\Http\Livewire\Backend\Report;

use Livewire\Component;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\Brand;
use App\Models\Backend\ProductInfo\Product;


class StockReport extends Component
{
    public $category_id;
    public $brand_id;
    public $product_id;
    public function render()
    {
        $product=Product::orderBy('id', 'desc');
        if($this->category_id){
           $product->whereCategoryId($this->category_id);
        }
        if($this->brand_id){
            $product->whereBrandId($this->brand_id);
        }
        if($this->product_id){
            $product->where('id',$this->product_id);
        }
        // dd($this->brand_id);
        return view('livewire.backend.report.stock-report', [
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'product' => Product::get(),
            'products' => $product->get(),
        ]);
    }
}
