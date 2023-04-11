<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\Inventory\StockAdjustment as StockAdjustmentInfo;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\Warehouse;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Inventory\StockManager;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class StockAdjustment extends Component
{
    public $date;
    public $type;
    public $contact_id;
    public $from_branch_id;
    public $to_branch_id;
    public $from_warehouse_id;
    public $to_warehouse_id;
    public $note;
    public $Product;
    public $product_quantity;
    public $product_sale_price;
    public $StockAdjustmentId=NULL;
    public $product_subtotal;
    public $grand_total;
    public $subtotal;
    public $sale_price;
    public $orderProductList = [];
    protected $listeners = [
        'product_search' => 'AddProduct',
    ];
    public function removeProduct($productId)
    {
        $cart = collect($this->orderProductList);
        $cart->pull($productId);
        $this->orderProductList = $cart;
    }
    public function updateProductCal()
    {
        $grandTotal = 0;

        foreach ($this->orderProductList as $key => $value) {
            if (is_numeric($this->product_sale_price[$key]) && is_numeric($this->product_quantity[$key])) {
                $this->product_subtotal[$key] = ($this->product_sale_price[$key] * $this->product_quantity[$key]);
                $grandTotal += $this->product_subtotal[$key];
            }
        }

        $this->grand_total = $grandTotal;
        $this->subtotal = $grandTotal;
        $this->grand_total=$this->grand_total-1+1;
    }
    public function AddProduct($product){
        $cart = collect($this->orderProductList);
        if (isset($cart[$product['id']])) {
            $cart[$product['id']] = $product;
            $this->product_quantity[$product['id']] = $this->product_quantity[$product['id']] + 1;
        } else {
            $cart[$product['id']] = $product;
            $this->Product=Product::find($product['id']);
            $this->product_quantity[$product['id']] = 1;
            $this->product_sale_price[$product['id']] = 0;
        }
        $this->orderProductList = $cart->toArray();
        $this->updateProductCal();
    }
    public function editStockAdjustment($id){
        $QueryUpdate=StockAdjustmentInfo::find($id);
        $this->StockAdjustmentId=$QueryUpdate->id;
        $this->date=$QueryUpdate->date;
        $this->type=$QueryUpdate->type;
        $this->contact_id=$QueryUpdate->contact_id;
        $this->from_branch_id=$QueryUpdate->from_branch_id;
        $this->to_branch_id=$QueryUpdate->to_branch_id;
        $this->from_warehouse_id=$QueryUpdate->from_warehouse_id;
        $this->to_warehouse_id=$QueryUpdate->to_warehouse_id;
        $this->note=$QueryUpdate->note;
    }
    public function deleteStockAdjustment($id){
        StockAdjustmentInfo::find($id)->delete();
        StockManager::where('stock_adjustment_id','=',$id)->delete();
        $this->emit('success', [
            'text' => 'Stock Adjustment Delete Successfully',
        ]);
    }
    public function saveStockAdjustment(){
        $this->validate([
            'type' => 'required',
            'contact_id' => 'required',
            'from_branch_id' => 'required',
            'to_branch_id' => 'required',
            'from_warehouse_id' => 'required',
            'to_warehouse_id' => 'required',
        ]);
        DB::transaction(function() {
        // Product
        if($this->StockAdjustmentId){
           $Query=StockAdjustmentInfo::find($this->StockAdjustmentId);
        }else{
           $Query=new StockAdjustmentInfo();
        }
        $Query->created_by = Auth::user()->id;
        $Query->date=$this->date;
        $Query->type=$this->type;
        $Query->contact_id=$this->contact_id;
        $Query->from_branch_id=$this->from_branch_id;
        $Query->to_branch_id=$this->to_branch_id;
        $Query->from_warehouse_id=$this->from_warehouse_id;
        $Query->to_warehouse_id=$this->to_warehouse_id;
        $Query->note=$this->note;
        $Query->save();
       //    Stock
        foreach ($this->orderProductList as $key => $value) {

            $product = Product::find($key);
            $Stock = new StockManager();
            // $Stock->user_id = Auth::id();
            $Stock->branch_id = 1;
            // $Stock->code = $this->code;
            $Stock->date = $this->date;
            $Stock->stock_adjustment_id = $Query->id;
            $Stock->quantity = $this->product_quantity[$key];
            $Stock->warehouse_id = 1;
            $Stock->subtotal = $product->sale_price * $this->product_quantity[$key];
            $Stock->save();
        }

        });

        $this->reset();
        $this->emit('success', [
            'text' => 'Stock Adjustment C/U Successfully',
        ]);
    }
    public function StockAdjustmentModal(){
        $this->emit('modal','StockAdjustmentModal');
    }

    public function mount($id=null){
        $this->date=date('Y-m-d', time());
    }


    public function render()
    {
        return view('livewire.backend.inventory.stock-adjustment',[
            'contacts'=>Contact::get(),
            'branches'=>Branch::get(),
            'warehouses'=>Warehouse::get(),
            'stockAdjustments'=>StockAdjustmentInfo::get(),
        ]);
    }
}
