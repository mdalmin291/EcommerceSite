<?php

namespace App\Http\Livewire\Backend\ProductInfo;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\ProductInfo\Brand;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\Color;
use App\Models\Backend\ProductInfo\Product as ProductTable;
use App\Models\Backend\ProductInfo\ProductImage;
use App\Models\Backend\ProductInfo\ProductInfo;
use App\Models\Backend\ProductInfo\ProductFeature;
use App\Models\Backend\ProductInfo\Size;
use App\Models\Backend\ProductInfo\SubCategory;
use App\Models\Backend\ProductInfo\SubSubCategory;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\Setting\Warehouse;
use App\Models\FrontEnd\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;

    public $code;
    public $name;
    public $category_id;
    public $sub_category_id;
    public $sub_sub_category_id;
    public $short_description;
    public $long_description;
    public $regular_price;
    public $special_price;
    public $wholesale_price = 0;
    public $purchase_price = 0;
    public $discount;
    public $warehouse_id;
    public $stock_in_opening;
    public $min_order_qty = 1;
    public $featured = 'None';
    public $brand_id;
    public $color;
    public $size;
    // public $product_feature_id;
    public $contact_id;
    public $low_alert;
    public $youtube_link;
    public $meta_title;
    public $meta_description;
    public $meta_keyword;
    public $in_stock = 'In Stock';
    public $vat_id;
    public $is_active = 1;

    public $product_image;
    public $images = [];
    public $selectedColors = [];
    public $selectedSizes = [];
    public $ProductId;
    public $QueryUpdate;
    public $QueryImage;

    public function mount($id = null)
    {
        $this->code = 'P' . floor(time() - 999999999);
        if ($id) {
            // Update Product
            $this->QueryUpdate = ProductTable::find($id);
            $this->ProductId = $this->QueryUpdate->id;
            $this->code = $this->QueryUpdate->code;
            $this->name = $this->QueryUpdate->name;
            $this->regular_price = $this->QueryUpdate->regular_price;
            $this->special_price = $this->QueryUpdate->special_price;
            $this->wholesale_price = $this->QueryUpdate->wholesale_price;
            $this->purchase_price = $this->QueryUpdate->purchase_price;
            $this->discount = $this->QueryUpdate->discount;
            $this->category_id = $this->QueryUpdate->category_id;
            $this->sub_category_id = $this->QueryUpdate->sub_category_id;
            $this->sub_sub_category_id = $this->QueryUpdate->sub_sub_category_id;
            $this->brand_id = $this->QueryUpdate->brand_id;
            $this->color = $this->QueryUpdate->color;
            $this->size = $this->QueryUpdate->size;
            $this->featured = $this->QueryUpdate->featured;
            // $this->product_feature_id = $this->QueryUpdate->product_feature_id;
            $this->min_order_qty = $this->QueryUpdate->min_order_qty;
            // $this->contact_id=$this->QueryUpdate->contact_id;
            $this->low_alert = $this->QueryUpdate->low_alert;
            $this->in_stock = $this->QueryUpdate->in_stock;

            $this->vat_id = $this->QueryUpdate->vat_id;
            $this->is_active = $this->QueryUpdate->is_active;
            $this->branch_id = Auth::user()->branch_id;

            $productInfo = ProductInfo::whereProductId($id)->first();
            if ($productInfo) {
                $this->youtube_link = $productInfo->youtube_link;
                $this->meta_title = $productInfo->meta_title;
                $this->meta_description = $productInfo->meta_description;
                $this->meta_keyword = $productInfo->meta_keyword;
                $this->short_description = $productInfo->short_description;
                $this->long_description = $productInfo->long_description;
                $this->privacy_policy = $productInfo->privacy_policy;
                $this->terms_condition = $productInfo->terms_condition;
            }

            // $i = 0;
            // $j = 0;
            // foreach ($this->QueryUpdate->ProductProperties as $product) {
            //     if ($product->size_id) {
            //         $this->selectedSizes[$i++] = $product->size_id;
            //     }
            //     if ($product->color_id) {
            //         $this->selectedColors[$j++] = $product->color_id;
            //     }
            // }
            // $this->selectedSizes = array_unique($this->selectedSizes);
            // $this->selectedColors = array_unique($this->selectedColors);
        }
        // Stock Manager
        $StockManager = StockManager::whereProductId($id)->first();
        if ($StockManager) {
            $this->stock_in_opening = $StockManager->stock_in_opening;
            if ($this->warehouse_id) {
                $this->warehouse_id = $StockManager->warehouse_id;
            } else {
                $this->warehouse_id = $StockManager->warehouse_id;
            }
        }

        // Product Code
    }

    public function removeMe($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function imageDelete($id)
    {
        //    dd($id);
        ProductImage::whereId($id)->delete();
        $this->QueryUpdate = ProductTable::find($this->ProductId);
        $this->emit('success', [
            'text' => 'Deleted Image Successfully',
        ]);
    }

    // Multiple product delete
    // public function imagesDelete($ProductId)
    // {
    //     ProductImage::whereProductId($ProductId)->delete();
    //     $this->emit('success', [
    //         'text' => 'Multiple Images Deleted Successfully',
    //     ]);
    // }

    public function productSave()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            // 'sub_category_id' => 'required',
            // 'sub_sub_category_id' => 'required',
            'featured' => 'required',
            // 'brand_id' => 'required',
            'regular_price' => 'required',
            // 'special_price' => 'required',
            // 'product_feature_id' => 'required',
            'wholesale_price' => 'required',
            'purchase_price' => 'required',
            'in_stock' => 'required',
            // 'is_active' => 'required',
        ]);
        if (!$this->ProductId) {
            $this->validate([
                'product_image' => 'nullable',
                // 'is_active' => 'required',
            ]);
        }
        DB::transaction(function () {
            // dd();
            // Product Save
            if ($this->ProductId) {
                $Query = ProductTable::find($this->ProductId);
            } else {
                $Query = new ProductTable();
                $Query->created_by = Auth::user()->id;

                $Vendor = Vendor::whereUserId(Auth::user()->id)->first();
                if ($Vendor) {
                    $Query->vendor_id = $Vendor->id;
                }
            }

            $Query->code = $this->code;
            $Query->name = $this->name;

            $Query->regular_price = $this->regular_price;
            if ($this->special_price){
                $Query->special_price = $this->special_price;
            }
            $Query->wholesale_price = $this->wholesale_price;
            $Query->purchase_price = $this->purchase_price;
            $Query->discount = $this->discount;
            $Query->category_id = $this->category_id;
            $Query->sub_category_id = $this->sub_category_id;
            $Query->brand_id = $this->brand_id;
            $Query->color = $this->color;
            $Query->size = $this->size;
            $Query->featured = $this->featured;
            $Query->min_order_qty = $this->min_order_qty;
            $Query->low_alert = $this->low_alert;
            $Query->vat_id = $this->vat_id;
            $Query->is_active = $this->is_active;
            $Query->in_stock = $this->in_stock;
            $Query->branch_id = Auth::user()->branch_id;
            $Query->save();

            $productInfo = ProductInfo::whereProductId($Query->id)->firstOrNew();
            $productInfo->product_id = $Query->id;
            $productInfo->youtube_link = $this->youtube_link;
            $productInfo->meta_title = $this->meta_title;
            $productInfo->meta_description = $this->meta_description;
            $productInfo->meta_keyword = $this->meta_keyword;
            $productInfo->short_description = $this->short_description;
            $productInfo->long_description = $this->long_description;
            $productInfo->branch_id = Auth::user()->branch_id;
            $productInfo->created_by = Auth::user()->id;
            $productInfo->save();

            if ($this->product_image) {
                $QueryImage = ProductImage::whereProductId($Query->id)->whereIsDefault(1)->firstOrNew();
                $QueryImage->product_id = $Query->id;
                $path = $this->product_image->store('/public/photo');
                $QueryImage->image = basename($path);
                $QueryImage->created_by = Auth::user()->id;
                $QueryImage->branch_id = Auth::user()->branch_id;
                $QueryImage->is_active = 1;
                $QueryImage->is_default = 1;
                $QueryImage->save();
                // $pro_image = Image::make(public_path('storage/photo/' . $QueryImage->image));
                // $pro_image->save();
            }

            if ($this->images) {
                //   Image Save
                foreach ($this->images as $image) {
                    $QueryImage = new ProductImage();
                    $QueryImage->product_id = $Query->id;
                    $path = $image->store('/public/photo');
                    $QueryImage->image = basename($path);
                    $QueryImage->created_by = Auth::user()->id;
                    $QueryImage->branch_id = Auth::user()->branch_id;
                    $QueryImage->is_active = 1;
                    $QueryImage->save();
                }
            }

            // dd($this->images);

            // Start Product Save Stock Manager
            if ($this->stock_in_opening) {
                $this->validate([
                    'warehouse_id' => 'required',
                ]);
                $StockManager = StockManager::whereProductId($Query->id)->firstOrNew();
                $StockManager->date = Carbon::now();
                $StockManager->product_id = $Query->id;
                if ($this->ProductId) {
                    $PurchaseQuantityCount = purchaseInvoiceDetail::whereProductId($this->ProductId)->sum('quantity');
                    $SaleQuantityCount = SaleInvoiceDetail::whereProductId($this->ProductId)->sum('quantity');
                    $StockManager->quantity = $PurchaseQuantityCount - $SaleQuantityCount;
                }
                $StockManager->stock_in_opening = $this->stock_in_opening;
                if ($this->warehouse_id) {
                    $StockManager->warehouse_id = 0;
                } else {
                    $StockManager->warehouse_id = $this->warehouse_id;
                }
                $StockManager->branch_id = Auth::user()->branch_id;
                $StockManager->created_by = Auth::user()->id;
                $StockManager->save();
            }

            // End Product Save Stock Manager
        });
        // dd("OK");
        if (!$this->ProductId) {
            $this->reset();
            $this->code = 'P' . floor(time() - 999999999);

            $this->emit('success', [
                'text' => 'Product C/U Successfully',
            ]);
        } else {
            $this->emit('success_redirect', [
                'text' => 'Product C/U Successfully',
                'url' => route('product.product-list'),
            ]);
        }
    }

    public function updatedRegularPrice()
    {
        // dd("OK");
        $this->discountCalculate();
    }

    public function updatedSpecialPrice()
    {
        // dd("OK");
        $this->discountCalculate();
    }

    public function discountCalculate()
    {
        if ((is_numeric($this->regular_price) && !empty($this->regular_price) && isset($this->regular_price)) || is_numeric($this->special_price) && !empty($this->special_price) || is_numeric($this->special_price)) {
            $discount = floatval($this->regular_price) - floatval($this->special_price);
            if ($this->regular_price && $this->special_price) {
                $this->discount = $discount * 100 / floatval($this->regular_price);
            }
        }
    }

    public function render()
    {
        if ($this->category_id) {
            $subCat = SubCategory::whereCategoryId($this->category_id)->get();
        } else {
            $subCat = SubCategory::get();
        }

        if ($this->sub_category_id) {
            $subSubCat = SubSubCategory::whereSubCategoryId($this->sub_category_id)->get();
        } else {
            $subSubCat = SubSubCategory::get();
        }

        return view('livewire.backend.product-info.product', [
            'Categories' => Category::get(),
            'SubCategories' => $subCat,
            'SubSubCategories' => $subSubCat,
            'brands' => Brand::get(),
            // 'feature_products' => ProductFeature::orderBy('position', 'ASC')->get(),
            // 'colors' => Color::get(),
            // 'sizes' => Size::get(),
            'vats' => Vat::get(),
            'contacts' => Contact::get(),
            'warehouses' => Warehouse::get(),
        ]);
    }
}
