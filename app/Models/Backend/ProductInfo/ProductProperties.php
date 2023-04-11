<?php

namespace App\Models\Backend\ProductInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\ProductInfo\Color;
use App\Models\Backend\ProductInfo\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProperties extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function Product(){
        return $this->belongsTo(Product::class);
    }
    public function Color(){
        return $this->belongsTo(Color::class);
    }
    public function Size(){
        return $this->belongsTo(Size::class);
    }
}
