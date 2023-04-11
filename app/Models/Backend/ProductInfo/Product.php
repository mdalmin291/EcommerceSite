<?php

namespace App\Models\Backend\ProductInfo;

use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\ProductInfo\Color;
use App\Models\Backend\ProductInfo\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function ProductImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class)->take(1);
    }

    public function ProductImageFirst()
    {
        return $this->hasOne(ProductImage::class)->whereIsDefault(1);
    }

    public function ProductImageLast()
    {
        return $this->hasOne(ProductImage::class)->orderBy('id', 'desc');
    }

    public function ProductImageTop4()
    {
        return $this->hasMany(ProductImage::class)->where('is_default','!=', 1);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function SubSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function ProductProperties()
    {
        return $this->hasMany(ProductProperties::class);
    }

    public function Vat()
    {
        return $this->belongsTo(Vat::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }


    public function Size()
    {
        return $this->belongsTo(Size::class);
    }


    public function StockManager()
    {
        return $this->hasOne(StockManager::class);
    }

    public function PurchaseInvoiceDetail()
    {
        return $this->hasMany(purchaseInvoiceDetail::class);
    }

    public function SaleInvoiceDetail()
    {
        return $this->hasMany(SaleInvoiceDetail::class);
    }

    public function ProductInfo()
    {
        return $this->hasOne(ProductInfo::class);
    }
}
