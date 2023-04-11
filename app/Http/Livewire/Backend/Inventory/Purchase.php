<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\Unit;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\Setting\Warehouse;
use App\Models\Backend\Setting\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Purchase extends Component
{
    public $code;
    public $date;
    public $purchase_payment_date;
    public $contact_id;
    public $product_quantity;
    public $product_sale_price;
    public $Product;
    public $product_discount;
    public $product_subtotal;
    public $subtotal;
    public $grand_total;
    public $discount;
    public $product_rate;
    public $shipping_charge=0;
    public $due;
    public $paid_amount;
    public $payment_method_id;
    public $payment_amount;
    public $payment_code;
    public $PurchaseInvoice;
    public $sub_sub_category_id;
    public $name;
    public $regular_price;
    public $special_price;
    public $wholesale_price;
    public $purchase_price;
    public $shipping_fee;
    public $transaction_id;
    public $warehouse_id;
    public $product_sku;
    public $barcode;
    public $sku;
    public $product_id = [];
    public $is_active=1;
    public $Key=0;
    public $paymentMethodList = [];
    public $orderProductList = [];
    protected $listeners = [
        'product_search' => 'AddProduct',
        'payment_method_search' => 'AddPaymentMethod',
    ];

    public function barcodeScan($value){

        $product=Product::whereCode($value)->first();
        if($product){
        $cart = collect($this->orderProductList);
        if (isset($cart[$this->Key])) {
            $cart[$this->Key] = $product;
            $this->product_quantity[$this->Key] = ($this->product_quantity[$this->Key]) + 1;
        } else {
            if (in_array($product['id'], $this->product_id)) {
                // $orderProductList=array($this->orderProductList);
                // dd($orderProductList);

                    if ( ! array_key_exists(( $product['id'] ), $cart ) ) {
                        foreach($this->orderProductList as $key=>$value){
                            if($value['id']== $product['id']){
                                $this->product_quantity[$key] = $this->product_quantity[$key]+1;
                                $this->product_subtotal[$key] = $this->product_rate[$key]* $this->product_quantity[$key];
                            }

                        }
                    }

            } else {
                $cart[$this->Key] = $product;
                $this->Product = Product::find($product['id']);
                if ($this->Product->StockManager) {
                    $this->warehouse_id[$this->Key] = $this->Product->StockManager->warehouse_id;
                }
                $this->product_quantity[$this->Key] = 1;
                $this->product_id[$this->Key] = $product['id'];
                $this->product_rate[$this->Key] = $product['purchase_price'];
                $this->product_sale_price[$this->Key] = $product['regular_price'];
                $this->product_discount[$this->Key] = 0;
                $this->product_subtotal[$this->Key] = $product['regular_price'];
                $this->product_sku[$this->Key]  ='SKU'.floor(time() - 999999999);
                $this->Key++;
            }
        }
            $this->orderProductList = $cart->toArray();
            $this->updateProductCal();
            }else{
                $this->emit('error', [
                    'text' => 'Please Search Vaild Product Code!',
                ]);
            }
            $this->reset(['barcode']);
    }

    public function Submit(Request $request){
        $this->validate([
            'code' => 'required',
            'contact_id' => 'required',
            'date' => 'required',
            'subtotal' => 'required',
            // 'warehouse_id' => 'required',
        ]);
        //$serverMemo = $request->get("serverMemo");
        //dd($serverMemo['data']['orderProductList']);
        DB::transaction(function() {
            if($this->PurchaseInvoice) {
                $Query = PurchaseInvoice::find($this->PurchaseInvoice->id);
            } else {
                $Query = new PurchaseInvoice();
                $Query->created_by = Auth::id();
                $Query->code = $this->code;
            }

            $Query->purchase_date = $this->date;
            $Query->contact_id = $this->contact_id;
            $Query->total_amount = $this->subtotal;
            if($this->discount){
                $Query->discount = $this->discount;
            }else{
                $Query->discount =0;
            }
            $Query->shipping_charge = $this->shipping_charge;
            $Query->payable_amount = $this->grand_total;
            $Query->branch_id = Auth::user()->branch_id;
            $Query->save();
            if($this->PurchaseInvoice){
                purchaseInvoiceDetail::wherePurchaseInvoiceId($Query->id)->whereNotIn('product_id', $this->product_id)->delete();
            }
            foreach ($this->orderProductList as $key => $value) {
                // dd($this->orderProductList);
                $product = Product::find($this->product_id[$key]);
                $PurchaseInvoiceDetail = purchaseInvoiceDetail::whereProductId($this->product_id[$key])->wherePurchaseInvoiceId($Query->id)->first();
                if (!$PurchaseInvoiceDetail) {
                    $PurchaseInvoiceDetail = new purchaseInvoiceDetail();
                    $PurchaseInvoiceDetail->created_by = Auth::id();
                    $PurchaseInvoiceDetail->branch_id = Auth::user()->branch_id;
                }

                $PurchaseInvoiceDetail->purchase_invoice_id = $Query->id;
                $PurchaseInvoiceDetail->product_id = $product->id;
                $PurchaseInvoiceDetail->unit_price=$this->product_rate[$key];
                $PurchaseInvoiceDetail->quantity = $this->product_quantity[$key];
                $PurchaseInvoiceDetail->save();
            }

            $purchase_payment_id = [];
        foreach ($this->paymentMethodList as $key => $value) {
            // dd($value['id']);
            if (isset($value['id']) && $value['id']) {
                array_push($purchase_payment_id, $value['id']);
            }
        }
        if($this->PurchaseInvoice){
            PurchasePayment::wherePurchaseInvoiceId($Query->id)->whereNotIn('id', $purchase_payment_id)->delete();
        }

            foreach ($this->paymentMethodList as $key => $value) {
                if (isset($value['id']) && $value['id']) {
                    $PurchasePayment = PurchasePayment::find($value['id']);
                } else {
                    $PurchasePayment = new PurchasePayment();
                }

                if(isset($value['date'])){
                  $PurchasePayment->date = $value['date'];
                }
                $PurchasePayment->contact_id = $Query->contact_id;
                $PurchasePayment->purchase_invoice_id = $Query->id;
                $PurchasePayment->payment_method_id = $value['payment_method_id'];
                $PurchasePayment->total_amount = $value['payment_amount'];
                $PurchasePayment->transaction_id = $value['transaction_id'];
                $PurchasePayment->code = $value['payment_code'];
                $PurchasePayment->created_by = Auth::id();
                $PurchasePayment->branch_id = Auth::user()->branch_id;
                $PurchasePayment->save();
            }



        // Start Purchase Product Stock Manager
        foreach ($this->orderProductList as $key => $value) {
            $product = Product::find($this->product_id[$key]);
            $StockManager = StockManager::whereProductId($product->id)->firstOrNew();
            $StockManager->product_id=$this->product_id[$key];
            $StockManager->stock_in_purchase=$StockManager->stock_in_purchase+$this->product_quantity[$key];
            $StockManager->sku = $this->product_sku[$key];
            // dd($this->product_sku[$key]);
            $StockManager->branch_id=Auth::user()->branch_id;
            $StockManager->created_by = Auth::user()->id;
            $StockManager->save();
        }
        // End Purchase Product Stock Manager
        $this->emit('success_redirect', [
            'text' => 'Purchase Added Successfully',
            'url' => route('inventory.purchase-invoice', ['id' => $Query->id]),
        ]);
    });
        if(!$this->PurchaseInvoice){
         $this->reset();
         $this->code = 'PR'.floor(time() - 999999999);
        }
        $this->payment_code = 'PM'.floor(time() - 999999999);
    }

    public function removePaymentList($itemId)
    {
        $cart = collect($this->paymentMethodList);
        $cart->pull($itemId);
        $this->paymentMethodList = $cart;

        $this->updateProductCal();
    }
    public function AddPaymentMethod()
    {
        $this->validate([
            'payment_method_id' => 'required',
            'payment_amount' => 'required',
        ]);

        if($this->payment_amount+$this->paid_amount <= $this->grand_total){
            $PaymentMethod = PaymentMethod::find($this->payment_method_id);

            $paymentMethodList = collect($this->paymentMethodList);
            $cartItem = [
                'id' => null,
                'date' => $this->purchase_payment_date,
                'payment_method_id' => $PaymentMethod->id,
                'payment_method_name' => $PaymentMethod->name,
                'payment_amount' => $this->payment_amount,
                'payment_code' => $this->payment_code,
                'transaction_id' => $this->transaction_id,
            ];
            $this->paymentMethodList = $paymentMethodList->push($cartItem);
            $key = $paymentMethodList->keys()->last();
            $payment_amount_total = 0;
            foreach ($this->paymentMethodList as $key => $amount) {
                $payment_amount_total += $amount['payment_amount'];
            }


            $this->paid_amount = $payment_amount_total;
            $this->reset(['payment_method_id', 'payment_amount']);
            $this->payment_code = 'PM'.floor(time() - 999999999);
            $this->transaction_id='TR'.floor(time() - 999999999);
            $this->updateProductCal();
        }else{
            $this->emit('error', [
                'text' => 'Over Payment Not Possible',
            ]);
        }
    }
    public function updateProductCal()
    {
        $grandTotal = 0;

        foreach ($this->orderProductList as $key => $value) {
            if (is_numeric($this->product_rate[$key]) && is_numeric($this->product_quantity[$key])) {
                $this->product_subtotal[$key] = $this->product_rate[$key] * $this->product_quantity[$key];
                $grandTotal += $this->product_subtotal[$key];
            }
        }

        $this->grand_total = $grandTotal;
        $this->subtotal = $grandTotal;
        if ((is_numeric($this->shipping_charge) && !empty($this->shipping_charge && isset($this->shipping_charge))) || is_numeric($this->discount) && !empty($this->discount) || is_numeric($this->paid_amount) && !empty($this->paid_amount)) {
            $this->grand_total = $this->grand_total - floatval($this->discount) + floatval($this->shipping_charge);
            $this->due = $this->grand_total -  floatval($this->paid_amount);
         }

        $payment_amount_total = 0;
        foreach ($this->paymentMethodList as $key => $amount) {
            $payment_amount_total += $amount['payment_amount'];
        }
        $this->paid_amount = $payment_amount_total;
        $this->due = $this->grand_total -  floatval($this->paid_amount);
    }
    public function removeProduct($productId, $product_id)
    {
        $cart = collect($this->orderProductList);
        $cart->pull($productId);
        $this->product_id = array_diff($this->product_id, [$product_id]);
        $this->orderProductList = $cart;
        $this->updateProductCal();
    }
    public function AddProduct($product){
        $cart = collect($this->orderProductList);
        if (isset($cart[$this->Key])) {
            $cart[$this->Key] = $product;
            $this->product_quantity[$this->Key] = $this->product_quantity[$this->Key] + 1;
        } else {
            if(in_array($product['id'], $this->product_id)){
                $this->emit('error', [
                    'text' => 'Product Already Added!',
                ]);
            }else{
            $cart[$this->Key] = $product;
            $this->Product=Product::find($product['id']);
            if($this->Product->StockManager){
                $this->warehouse_id[$this->Key] = $this->Product->StockManager->warehouse_id;
            }
            $this->product_quantity[$this->Key] = 1;
            $this->product_id[$this->Key] = $product['id'];
            $this->product_rate[$this->Key] = $product['purchase_price'];
            $this->product_sale_price[$this->Key] = $product['regular_price'];
            $this->product_discount[$this->Key] = 0;
            $this->product_subtotal[$this->Key] = 0;
            $this->product_sku[$this->Key]  ='SKU'.floor(time() - 999999999);
            $this->Key++;
           }
        }
        $this->orderProductList = $cart->toArray();
        // dd($this->orderProductList);
        $this->updateProductCal();
    }

    public function mount($id=null){
        $this->code = 'PR'.floor(time() - 999999999);
        $this->transaction_id='TR'.floor(time() - 999999999);
        $this->payment_code = 'PM'.floor(time() - 999999999);

        if ($id) {
            $this->PurchaseInvoice = PurchaseInvoice::find($id);
            $this->contact_id = $this->PurchaseInvoice->contact_id;
            $this->date = $this->PurchaseInvoice->date;
            $this->code = $this->PurchaseInvoice->code;
            $this->shipping_charge = $this->PurchaseInvoice->shipping_charge;
            $this->discount = $this->PurchaseInvoice->discount;
            $this->grand_total = $this->PurchaseInvoice->grand_total;
            $this->subtotal = $this->PurchaseInvoice->subtotal;
            $this->expense_point = $this->PurchaseInvoice->expense_point;
            $this->expense_point_amount = $this->PurchaseInvoice->expense_point_amount;
            $this->due = $this->PurchaseInvoice->due;
            $this->note = $this->PurchaseInvoice->note;


            // $product = Product::find($this->product_id);
            // dd($product);
            $stock_managers=StockManager::whereProductId($id)->get();
            // dd($stock_managers);
            $ware_id=0;
            foreach($stock_managers as $key=> $stock_manager){
                $this->warehouse_id[$ware_id++]=$stock_manager->warehouse_id;
                $this->product_sku[$this->Key]=$stock_manager->sku;
                // dd($this->product_sku[$this->Key]);
                // $this->key++;
            }
            // dd($this->product_sku[$this->Key]=$stock_managers->sku);
            // $this->product_sku[$this->key] = $stock_manager->sku[$this->key];

            $this->paid_amount=PurchasePayment::wherePurchaseInvoiceId($id)->sum('total_amount');
            $PurchaseInvoiceDetail = purchaseInvoiceDetail::wherePurchaseInvoiceId($this->PurchaseInvoice->id)->get();
            // dd($PurchaseInvoiceDetail);
            $cart = collect($this->orderProductList);

            foreach ($PurchaseInvoiceDetail as $stockProduct) {
                $product = Product::find($stockProduct->product_id);
                $this->product_quantity[$this->Key] = $stockProduct->quantity;
                $this->product_id[$this->Key] = $product->id;
                $this->warehouse_id[$this->Key]=$stockProduct->warehouse_id;
                $this->product_rate[$this->Key] = $stockProduct->unit_price;
                $cart[$this->Key] = $product;
                $this->Key++;
            }
            $this->orderProductList = $cart;

            $PaymentList = PurchasePayment::wherePurchaseInvoiceId($this->PurchaseInvoice->id)->get();
            // dd($PaymentList->count());
            $cartPayment = collect($this->paymentMethodList);
            foreach ($PaymentList as $paymentList) {
                $paymentMethod = PaymentMethod::find($paymentList->payment_method_id);
                // dd($paymentMethod->id);
                $cartItem = [
                    'id' => $paymentList->id,
                    'payment_method_id' => $paymentMethod->id,
                    'payment_method_name' => $paymentMethod->name,
                    'transaction_id' => $paymentList->transaction_id,
                    'payment_amount' => $paymentList->total_amount,
                    'payment_code' => $paymentList->code,
                ];

                $this->paymentMethodList = $cartPayment->push($cartItem);

            }
            $this->paymentMethodList = $cartPayment;
            $this->updateProductCal();
        }

        $this->date=date('Y-m-d', time());
        $this->purchase_payment_date=date('Y-m-d', time());
    }
    public function updated(){
        if($this->shipping_fee){
           $this->shipping_charge=$this->shipping_fee;
           $this->shipping_fee=NULL;
        }
        $this->updateProductCal();
    }
    public function render()
    {
        // dd($this->paymentMethodList);

        return view('livewire.backend.inventory.purchase',[
            'contacts'=>Contact::whereType('Supplier')->get(),
            'payments'=>PaymentMethod::get(),
            'categories'=> Category::get(),
            'Units' => Unit::all(),
            'vats'=> Vat::get(),
            'branches'=> Branch::get(),
            'warehouses'=>Warehouse::get(),
            'shipping_charges'=>ShippingCharge::get(),
        ]);
    }
}
