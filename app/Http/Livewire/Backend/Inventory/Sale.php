<?php

namespace App\Http\Livewire\Backend\Inventory;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\Unit;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Setting\InvoiceSetting;
use App\Models\Backend\Setting\Warehouse;
use App\Models\Backend\Setting\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Sale extends Component
{
    public $code;
    public $date;
    public $sale_payment_date;
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
    public $shipping_charge = 0;
    public $due;
    public $paid_amount;
    public $payment_method_id;
    public $payment_amount;
    public $payment_code;
    public $SaleInvoice;
    public $sub_sub_category_id;
    public $name;
    public $regular_price;
    public $special_price;
    public $wholesale_price;
    public $purchase_price;
    public $transaction_id;
    public $warehouse_id;
    public $warehouse_error;
    public $is_active = 1;
    public $shipping_fee;
    public $barcode;
    public $Key = 0;
    public $product_id = [];
    public $paymentMethodList = [];
    public $orderProductList = [];
    protected $listeners = [
        'product_search' => 'AddProduct',
        'payment_method_search' => 'AddPaymentMethod',
    ];

    public function Submit()
    {
        // dd(true);
        $this->validate([
            'code' => 'required',
            'contact_id' => 'required',
            'date' => 'required',
            'subtotal' => 'required',
            // 'warehouse_id' => 'required',
        ]);
        DB::transaction(function () {
            if ($this->SaleInvoice) {
                $Query = SaleInvoice::find($this->SaleInvoice->id);
            } else {
                $Query = new SaleInvoice();
                $Query->created_by = Auth::id();
            }
            $Query->sale_date = $this->date;
            $Query->code = $this->code;
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

            if ($this->SaleInvoice) {
                SaleInvoiceDetail::whereSaleInvoiceId($Query->id)->whereNotIn('product_id', $this->product_id)->delete();
            }
            foreach ($this->orderProductList as $key => $value) {

                // $product = Product::find($this->product_id[$key]);
                // $StockManager = StockManager::whereProductId($product->id)->firstOrNew();
                // $StockManager->product_id=$this->product_id[$key];
                // $StockManager->stock_in_purchase=$StockManager->stock_in_purchase+$this->product_quantity[$key];
                // $StockManager->branch_id=Auth::user()->branch_id;
                // $StockManager->created_by = Auth::user()->id;
                // $StockManager->save();

                $product = Product::find($this->product_id[$key]);
                $SaleInvoiceDetail = SaleInvoiceDetail::whereProductId($product->id)->whereSaleInvoiceId($Query->id)->first();
                if (!$SaleInvoiceDetail) {
                    $SaleInvoiceDetail = new SaleInvoiceDetail();
                    $SaleInvoiceDetail->created_by = Auth::id();
                    $SaleInvoiceDetail->branch_id = Auth::user()->branch_id;
                }
                $SaleInvoiceDetail->sale_invoice_id = $Query->id;
                $SaleInvoiceDetail->product_id = $product->id;
                $SaleInvoiceDetail->unit_price = $this->product_sale_price[$key];
                $SaleInvoiceDetail->quantity = $this->product_quantity[$key];
                $SaleInvoiceDetail->save();
            }

            $sale_payment_id = [];
            foreach ($this->paymentMethodList as $key => $value) {
                // dd($value['id']);
                if (isset($value['id']) && $value['id']) {
                    array_push($sale_payment_id, $value['id']);
                }
            }
            if ($this->SaleInvoice) {
                SalePayment::whereSaleInvoiceId($Query->id)->whereNotIn('id', $sale_payment_id)->delete();
            }

            foreach ($this->paymentMethodList as $key => $value) {
                // dd($value['id']);
                if (isset($value['id']) && $value['id']) {
                    $SalePayment = SalePayment::find($value['id']);
                } else {
                    $SalePayment = new SalePayment();
                }

                $SalePayment->date = $value['date'];
                $SalePayment->contact_id = $Query->contact_id;
                $SalePayment->sale_invoice_id = $Query->id;
                $SalePayment->payment_method_id = $value['payment_method_id'];
                $SalePayment->total_amount = $value['payment_amount'];
                $SalePayment->transaction_id = $value['transaction_id'];
                $SalePayment->code = $value['payment_code'];
                $SalePayment->created_by = Auth::id();
                $SalePayment->branch_id = Auth::user()->branch_id;
                $SalePayment->save();
            }
            // Start Sale Product Stock Manager
            foreach ($this->orderProductList as $key => $value) {
                $product = Product::find($key);
                $StockManager = StockManager::whereProductId($key)->firstOrNew();
                $StockManager->product_id = $key;
                $StockManager->stock_out_sale = $StockManager->stock_out_sale + $this->product_quantity[$key];
                // $StockManager->warehouse_id=$this->warehouse_id[$key];
                $StockManager->branch_id = Auth::user()->branch_id;
                $StockManager->created_by = Auth::user()->id;
                $StockManager->save();
            }
            $invoiceSetting=InvoiceSetting::first();
            if( $invoiceSetting->type=='Receipt'){
                $this->emit('success_redirect', [
                    'text' => 'Sale Added Successfully',
                    // 'url' => route('inventory.sale-invoice', ['id' => $Query->id]),
                    'url' => route('order.order-invoice-print', ['id' => $Query->id]),
                ]);
            }else{
                $this->emit('success_redirect', [
                    'text' => 'Sale Added Successfully',
                    'url' => route('inventory.sale-invoice', ['id' => $Query->id]),
                ]);
            }
            // End Sale Product Stock Manager

        });

        if (!$this->SaleInvoice) {
            $this->reset();
        }
        $this->payment_code = 'PM' . floor(time() - 999999999);
        $this->code = 'PR' . floor(time() - 999999999);
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
        if ($this->payment_amount + $this->paid_amount <= $this->grand_total) {
            $PaymentMethod = PaymentMethod::find($this->payment_method_id);
            $paymentMethodList = collect($this->paymentMethodList);
            $cartItem = [
                'id' => null,
                'payment_method_id' => $PaymentMethod->id,
                'date' => $this->sale_payment_date,
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
            $this->payment_code = 'PM' . floor(time() - 999999999);
            $this->updateProductCal();
        } else {
            $this->emit('error', [
                'text' => 'Over Payment Not Possible',
            ]);
        }
    }
    public function updateProductCal()
    {
        $grandTotal = 0;

        foreach ($this->orderProductList as $key => $value) {
            if (is_numeric($this->product_sale_price[$key]) && is_numeric($this->product_quantity[$key])) {
                $this->product_subtotal[$key] = $this->product_sale_price[$key] * $this->product_quantity[$key];
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
        // dd($this->orderProductList);
        // $cart = collect($this->orderProductList);
        // $cart->pull($productId);
        // $this->orderProductList = $cart;
        // $this->updateProductCal();
    }
    public function AddProduct($product)
    {
        // Start Add Product
        $cart = collect($this->orderProductList);
        if (isset($cart[$this->Key])) {
            $cart[$this->Key] = $product;
            $this->product_quantity[$this->Key] = $this->product_quantity[$this->Key] + 1;
        } else {
            if (in_array($product['id'], $this->product_id)) {
                $this->emit('error', [
                    'text' => 'Product Already Added!',
                ]);
            } else {
                $cart[$this->Key] = $product;
                $this->Product = Product::find($product['id']);
                if ($this->Product->StockManager) {
                    $this->warehouse_id[$this->Key] = $this->Product->StockManager->warehouse_id;
                }
                $this->product_quantity[$this->Key] = 1;
                $this->product_id[$this->Key] = $product['id'];
                $this->product_rate[$this->Key] = $product['purchase_price'];
                $this->product_sale_price[$this->Key] =  $product['regular_price'];
                $this->product_discount[$this->Key] = 0;
                $this->product_subtotal[$this->Key] = $product['regular_price'];
                $this->Key++;
            }
        }
        $this->orderProductList = $cart->toArray();
        $this->updateProductCal();
        // End Add Product

        // $cart = collect($this->orderProductList);
        // if (isset($cart[$product['id']])) {
        //     $cart[$product['id']] = $product;
        //     $this->product_quantity[$product['id']] = $this->product_quantity[$product['id']] + 1;
        // } else {
        //     $cart[$product['id']] = $product;
        //     $this->Product=Product::find($product['id']);
        //     if($this->Product->StockManager){
        //        $this->warehouse_id[$product['id']] = $this->Product->StockManager->warehouse_id;
        //     }
        //     $this->product_quantity[$product['id']] = 1;
        //     $this->product_rate[$product['id']] = $product['regular_price'];
        //     $this->product_discount[$product['id']] = 0;
        //     $this->product_subtotal[$product['id']] = 0;
        // }
        // $this->orderProductList = $cart->toArray();
        // $this->updateProductCal();
    }
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
                                $this->product_subtotal[$key] = $this->product_sale_price[$key]* $this->product_quantity[$key];
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

    public function mount($id = NULL)
    {
        $this->code = 'PR' . floor(time() - 999999999);
        $this->transaction_id = 'TR' . floor(time() - 999999999);
        $this->payment_code = 'PM' . floor(time() - 999999999);

        if ($id) {
            $this->SaleInvoice = SaleInvoice::find($id);
            $this->contact_id = $this->SaleInvoice->contact_id;
            $this->date = $this->SaleInvoice->date;
            $this->shipping_charge = $this->SaleInvoice->shipping_charge;
            $this->discount = $this->SaleInvoice->discount;
            $this->grand_total = $this->SaleInvoice->grand_total;
            $this->subtotal = $this->SaleInvoice->subtotal;
            $this->expense_point = $this->SaleInvoice->expense_point;
            $this->expense_point_amount = $this->SaleInvoice->expense_point_amount;
            $this->due = $this->SaleInvoice->due;
            $this->note = $this->SaleInvoice->note;

            $stock_managers = StockManager::whereInvoiceId($id)->get();
            foreach ($stock_managers as $stock_manager) {
                $this->warehouse_id[$stock_manager->product_id] = $stock_manager->warehouse_id;
            }

            $this->paid_amount = SalePayment::whereSaleInvoiceId($id)->sum('total_amount');
            $SaleInvoiceDetail = SaleInvoiceDetail::whereSaleInvoiceId($this->SaleInvoice->id)->get();
            // dd($SaleInvoiceDetail);
            $cart = collect($this->orderProductList);
            foreach ($SaleInvoiceDetail as $stockProduct) {
                $product = Product::find($stockProduct->product_id);
                $this->product_quantity[$this->Key] = $stockProduct->quantity;
                $this->product_id[$this->Key] = $product->id;
                $this->warehouse_id[$this->Key] = $stockProduct->warehouse_id;
                $this->product_sale_price[$this->Key] = $stockProduct->unit_price;
                $cart[$this->Key] = $product;
                $this->Key++;


                // $product = Product::find($stockProduct->product_id);
                // $this->product_quantity[$product->id] = $stockProduct->quantity;
                // $this->product_rate[$product->id] = $stockProduct->unit_price;
                // $cart[$product->id] = $product;
            }
            $this->orderProductList = $cart;

            $PaymentList = SalePayment::whereSaleInvoiceId($this->SaleInvoice->id)->get();
            $cartPayment = collect($this->paymentMethodList);
            foreach ($PaymentList as $paymentList) {
                $paymentMethod = PaymentMethod::find($paymentList->payment_method_id);
                $cartItem = [
                    'id' => $paymentList->id,
                    'payment_method_id' => $paymentMethod->id,
                    'payment_method_name' => $paymentMethod->name,
                    'date' => $paymentList->date,
                    'transaction_id' => $paymentList->transaction_id,
                    'payment_amount' => $paymentList->total_amount,
                    'payment_code' => $paymentList->code,
                ];
                $this->paymentMethodList = $cartPayment->push($cartItem);
            }
            $this->paymentMethodList = $cartPayment;
            // dd($this->paymentMethodList);
            $this->updateProductCal();
        }
        $this->date = date('Y-m-d', time());
        $this->sale_payment_date = date('Y-m-d', time());
    }
    public function updated()
    {
        if ($this->shipping_fee) {
            //   dd($this->shipping_fee);
            $this->shipping_charge = $this->shipping_fee;
            $this->shipping_fee = NULL;
        }
        $this->updateProductCal();
    }

    public function render()
    {
        // dd($this->paymentMethodList);

        return view('livewire.backend.inventory.sale', [
            'contacts' => Contact::whereType('Customer')->get(),
            'payments' => PaymentMethod::get(),
            'categories' => Category::get(),
            'Units' => Unit::all(),
            'vats' => Vat::get(),
            'branches' => Branch::get(),
            'warehouses' => Warehouse::get(),
            'shipping_charges' => ShippingCharge::get(),
        ]);
    }
}
