<?php

namespace App\Models\Backend\ProductInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Inventory\Category;
use App\Models\Backend\ProductInfo\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function SubSubCategory(){
        return $this->hasMany(SubSubCategory::class);
    }
}
