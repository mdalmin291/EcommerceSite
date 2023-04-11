<?php

namespace App\Http\Livewire\Backend\Order;

use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Setting\ShippingCharge;
use App\Models\Backend\Setting\Warehouse;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderEdit extends Component
{

    public $code;
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
    public $warehouse_id;
    public $warehouse_error;
    public $is_active = 1;
    public $shipping_fee;
    public $OrderId;
    public $status;
    public $Key = 0;
    public $product_id = [];
    public $paymentMethodList = [];
    public $orderProductList = [];

    // Payment
    public $sale_payment_date;
    public $payment_method_id;
    public $transaction_id;
    public $payment_code;
    public $payment_amount;
    public $date;
    public $order_id;

    // Order
    public $contact_id;
    public $Order;

    protected $listeners = [
        'product_search' => 'AddProduct',
        'payment_method_search' => 'AddPaymentMethod',
    ];

    public $DeleteId;

    public function Edit()
    {
        $this->Submit();
    }
    public function ConfirmEdit()
    {
        $this->emit('modal', 'EditPopup');
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
    public function updatedStatus()
    {
        $OrderUpdateQuery = Order::find($this->OrderId);
        $OrderUpdateQuery->status = $this->status;
        $OrderUpdateQuery->save();
        return redirect()->route('inventory.sale-list');
    }
    public function Submit()
    {

        //   Start Order Edit
        DB::transaction(function () {
            $SaleInvoice = SaleInvoice::whereOrderId($this->OrderId)->first();
            if ($SaleInvoice) {
                $this->emit('error_redirect', [
                    'text' => 'Order Already Delivered',
                    'url' => route('inventory.sale-list'),
                ]);
            } else {
                $OrderUpdateQuery = Order::find($this->OrderId);
                $OrderUpdateQuery->total_amount = $this->subtotal;
                $OrderUpdateQuery->discount = $this->discount;
                $OrderUpdateQuery->shipping_charge = $this->shipping_charge;
                $OrderUpdateQuery->payable_amount = $this->grand_total;
                $OrderUpdateQuery->save();

                $productId = [];

                foreach ($this->orderProductList as $key => $value) {
                    array_push($productId, $this->product_id[$key]);
                    $OrderEditUpdateQuery = OrderDetail::whereOrderId($this->OrderId)->whereProductId($this->product_id[$key])->first();
                    if (!$OrderEditUpdateQuery) {
                        $OrderEditUpdateQuery = new OrderDetail();
                        $OrderEditUpdateQuery->order_id = $OrderUpdateQuery->id;
                    }
                    $OrderEditUpdateQuery->product_id = $key;
                    $OrderEditUpdateQuery->unit_price = $this->product_rate[$key];
                    $OrderEditUpdateQuery->quantity = $this->product_quantity[$key];
                    $OrderEditUpdateQuery->save();
                }

                OrderDetail::whereOrderId($this->OrderId)->whereNotIn('product_id', $productId)->delete();

                $StatusUpdate = Order::find($this->OrderId);
                $StatusUpdate->status = 'delivered';
                $StatusUpdate->save();
                // Start Sale After Delivery
                // if($this->SaleInvoice){
                //     $Query = SaleInvoice::find($this->SaleInvoice->id);
                // }else{
                $Query = new SaleInvoice();
                $Query->created_by = Auth::id();
                // }
                $Query->sale_date = Carbon::now()->format('Y-m-d');
                $Query->code = $this->code;
                $Query->contact_id = $this->contact_id;
                $Query->order_id = $this->order_id;
                $Query->total_amount = $this->subtotal;
                $Query->discount = $this->discount;
                $Query->shipping_charge = $this->shipping_charge;
                $Query->payable_amount = $this->grand_total;
                $Query->branch_id = Auth::user()->branch_id;
                $Query->save();
                foreach ($this->orderProductList as $key => $value) {
                    $product = Product::find($this->product_id[$key]);
                    $SaleInvoiceDetail = new SaleInvoiceDetail();
                    $SaleInvoiceDetail->created_by = Auth::id();
                    $SaleInvoiceDetail->branch_id = Auth::user()->branch_id;
                    $SaleInvoiceDetail->sale_invoice_id = $Query->id;
                    $SaleInvoiceDetail->product_id = $this->product_id[$key];
                    $SaleInvoiceDetail->unit_price = $this->product_rate[$key];
                    $SaleInvoiceDetail->quantity = $this->product_quantity[$key];
                    $SaleInvoiceDetail->save();
                }
                foreach ($this->paymentMethodList as $key => $value) {
                    $SalePayment = new SalePayment();
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
                    $product = Product::find($this->product_id[$key]);
                    $StockManager = new StockManager();
                    $StockManager->product_id = $this->product_id[$key];
                    $StockManager->stock_out_sale = $StockManager->stock_out_sale + $this->product_quantity[$key];
                    $StockManager->warehouse_id = $this->warehouse_id[$key];
                    $StockManager->branch_id = Auth::user()->branch_id;
                    $StockManager->created_by = Auth::user()->id;
                    $StockManager->save();
                }
                // End Sale Product Stock Manager
                $this->emit('success_redirect', [
                    'text' => 'Order Delivered Successfully',
                    'url' => route('inventory.sale-list'),
                ]);
                // End sale After Delivery
            }
        });
        // $this->reset();

        //   End Order Edit
    }
    public function removeProduct($productId, $product_id)
    {
        $cart = collect($this->orderProductList);
        $cart->pull($productId);
        $this->product_id = array_diff($this->product_id, [$product_id]);
        $this->orderProductList = $cart;
        $this->updateProductCal();
        // $cart = collect($this->orderProductList);
        // $cart->pull($productId);
        // $this->orderProductList = $cart;
        // $this->updateProductCal();
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
                $this->product_rate[$this->Key] = $product['regular_price'];
                $this->product_discount[$this->Key] = 0;
                $this->product_subtotal[$this->Key] = 0;
                $this->Key++;
            }
        }
        $this->orderProductList = $cart->toArray();
        $this->updateProductCal();


        // $cart = collect($this->orderProductList);
        // if (isset($cart[$product['id']])) {
        //     $cart[$product['id']] = $product;
        //     $this->product_quantity[$product['id']] = $this->product_quantity[$product['id']] + 1;
        // } else {
        //     $cart[$product['id']] = $product;
        //     $this->Product = Product::find($product['id']);
        //     $this->warehouse_id[$product['id']] = null;
        //     $this->product_quantity[$product['id']] = 1;
        //     $this->product_rate[$product['id']] = $product['regular_price'];
        //     $this->product_discount[$product['id']] = 0;
        //     $this->product_subtotal[$product['id']] = 0;
        // }
        // $this->orderProductList = $cart->toArray();
        // $this->updateProductCal();
    }

    public function mount($id = NULL)
    {
        $this->transaction_id = 'TR' . floor(time() - 999999999);
        $this->payment_code = 'PM' . floor(time() - 999999999);
        $this->code = 'PR' . floor(time() - 999999999);
        $this->sale_payment_date = Carbon::now()->format('Y-m-d');
        if ($id) {
            $this->Order = Order::find($id);
            $this->OrderId = $id;
            $this->contact_id = $this->Order->contact_id;
            $this->order_id = $this->Order->id;
            $this->date = $this->Order->order_date;
            $this->shipping_charge = $this->Order->shipping_charge;
            $this->discount = $this->Order->discount;
            $this->grand_total = $this->Order->grand_total;
            $this->subtotal = $this->Order->total_amount;
            $this->note = $this->Order->note;
            $OrderDetail = OrderDetail::whereOrderId($this->Order->id)->get();
            $cart = collect($this->orderProductList);
            foreach ($OrderDetail as $orderProduct) {

                $product = Product::find($orderProduct->product_id);
                $this->product_quantity[$this->Key] = $orderProduct->quantity;
                $this->product_id[$this->Key] = $product->id;
                $this->warehouse_id[$this->Key] = $orderProduct->warehouse_id;
                $this->product_rate[$this->Key] = $orderProduct->unit_price;
                $cart[$this->Key] = $product;
                $this->Key++;

                // $product = Product::find($orderProduct->product_id);
                // $this->product_quantity[$product->id] = $orderProduct->quantity;
                // $this->product_rate[$product->id] = $orderProduct->unit_price;
                // $this->warehouse_id[$product->id] = null;
                // $cart[$product->id] = $product;
            }
            $this->orderProductList = $cart->toArray();
            $this->updateProductCal();
        }
    }
    public function updated()
    {

        $this->updateProductCal();
    }
    public function render()
    {
        return view('livewire.backend.order.order-edit', [
            'warehouses' => Warehouse::get(),
            'shipping_charges' => ShippingCharge::get(),
            'payments' => PaymentMethod::get(),
        ]);
    }
}
