<?php

namespace App\Models\Backend\ProductInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\ProductInfo\SubCategory;
use App\Models\Backend\ProductInfo\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function SubCategory(){
        return $this->hasMany(SubCategory::class);
    }
    public function CategoryCheck(){
        return $this->hasOne(Product::class);
    }
}
