<?php

namespace App\Models\Backend\ProductInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ProductInfo\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function BrandCheck(){
        return $this->hasOne(Product::class);
    }
}
