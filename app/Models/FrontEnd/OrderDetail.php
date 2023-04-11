<?php

namespace App\Models\FrontEnd;
use App\Models\Backend\ProductInfo\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
