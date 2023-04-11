<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Contact\Contact;
use App\Models\Inventory\Category;
use App\Models\Backend\Inventory\Invoice;
use App\Models\Inventory\Item as ItemM;
use App\Models\Backend\Inventory\StockManager;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Transaction\Payment;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\ProductInfo\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Purchase extends Component
{
    use WithFileUploads;

    public $type;
    public $category_id;
    public $brand;
    public $item_code;
    public $name;
    public $unit_id;
    public $opening_stock;
    public $vat_id;
    public $low_stock_alert;
    public $branch_id;
    public $purchase_price;
    public $code;
    public $item_id = null;
    public $date;
    public $contact_id;
    public $discount;
    public $shipping_charge;
    public $sale_price;
    public $image;
    public $Invoice;
    public $item;
    public $Item;
    public $item_quantity;
    public $item_rate;
    public $item_discount;
    public $item_subtotal;
    public $subtotal;
    public $grand_total;
    public $paid_amount;
    public $due;
    public $memberPoint;
    public $payment_method_id;
    public $payment_amount;
    public $payment_code;
    public $paymentMethodList = [];
    public $orderItemList = [];
    protected $listeners = [
        'item_search' => 'AddItem',
        'payment_method_search' => 'AddPaymentMethod',
    ];

    public function removePaymentList($itemId)
    {
        $cart = collect($this->paymentMethodList);
        $cart->pull($itemId);
        $this->paymentMethodList = $cart;
        $this->updateItemCal();
    }

    public function AddPaymentMethod()
    {
        $PaymentMethod = PaymentMethod::find($this->payment_method_id);

        $paymentMethodList = collect($this->paymentMethodList);
        $cartItem = [
            'id' => null,
            'payment_method_id' => $PaymentMethod->id,
            'payment_method_name' => $PaymentMethod->name,
            'payment_amount' => $this->payment_amount,
            'payment_code' => $this->payment_code,
        ];
        $this->paymentMethodList = $paymentMethodList->push($cartItem);
        $key = $paymentMethodList->keys()->last();
        $payment_amount_total = 0;
        foreach ($this->paymentMethodList as $key => $amount) {
            $payment_amount_total += $amount['payment_amount'];
        }
        $this->paid_amount = $payment_amount_total;
        $this->reset(['payment_method_id', 'payment_amount']);

        $this->updateItemCal();
    }

    public function refreshPage()
    {
        $this->reset();
        $this->code = 'TH'.floor(time() - 999999999);
        $this->item_code = 'TH'.floor(time() - 999999999);
        $this->payment_code = 'TH'.floor(time() - 999999999);
        $this->emit('modal', 'InvoiceModal');
    }

    public function AddItem($item)
    {
        $cart = collect($this->orderItemList);
        if (isset($cart[$item['id']])) {
            $cart[$item['id']] = $item;
            $this->item_quantity[$item['id']] = $this->item_quantity[$item['id']] + 1;
        } else {
            $cart[$item['id']] = $item;
            $this->Item = ItemM::find($item['id']);
            $this->item_quantity[$item['id']] = 1;
            $this->item_discount[$item['id']] = 0;
            $this->item_rate[$item['id']] = $item['purchase_price'];
            $this->item_subtotal[$item['id']] = 0;
        }
        $this->orderItemList = $cart->toArray();
        //  dd($this->orderItemList);
        $this->updateItemCal();
        //    dd($this->orderItemList);
    }

    public function updated()
    {
        $this->updateItemCal();
    }

    public function updateItemCal()
    {
        $grandTotal = 0;

        foreach ($this->orderItemList as $key => $value) {
            if (is_numeric($this->item_rate[$key]) && is_numeric($this->item_quantity[$key]) && is_numeric($this->item_discount[$key])) {
                $this->item_subtotal[$key] = $this->item_rate[$key] * $this->item_quantity[$key] - floatval($this->item_discount[$key]);
                $grandTotal += $this->item_subtotal[$key];
            }
        }

        $this->grand_total = $grandTotal;
        $this->subtotal = $grandTotal;
        if ((is_numeric($this->shipping_charge) && !empty($this->shipping_charge && isset($this->shipping_charge))) || is_numeric($this->discount) && !empty($this->discount) || is_numeric($this->paid_amount) && !empty($this->paid_amount)) {
            {
            $this->grand_total = $this->grand_total - floatval($this->discount) + floatval($this->shipping_charge);
            $this->due = $this->grand_total -  floatval($this->paid_amount);
            }
         }

    }

    public function removeItem($itemId)
    {
        $cart = collect($this->orderItemList);
        $cart->pull($itemId);
        $this->orderItemList = $cart;
        $this->updateItemCal();
    }

    public function Submit()
    {
        $this->validate([
            'code' => 'required',
            'contact_id' => 'required',
            'date' => 'required',
            'subtotal' => 'required',
        ]);
        if ($this->Invoice) {
            $Query = Invoice::find($this->Invoice->id);
        } else {
            $Query = new Invoice();
            $Query->user_id = Auth::id();
            $Query->type = 'Purchase';
        }
        $Query->date = $this->date;
        $Query->code = $this->code;
        $Query->contact_id = $this->contact_id;
        $Query->subtotal = $this->subtotal;
        $Query->vat_id = $this->vat_id;
        $Query->discount = $this->discount;
        $Query->shipping_charge = $this->shipping_charge;
        $Query->grand_total = $this->grand_total;
        $Query->paid_amount = $this->paid_amount;
        $Query->due = $this->due;
        $Query->status = 'Complete';
        $Query->branch_id = '1';
        $Query->save();

        foreach ($this->orderItemList as $key => $value) {
            // dd($this->orderItemList);
            $item = ItemM::find($key);
            $Stock = StockManager::whereItemId($key)->whereInvoiceId($Query->id)->first();
            if (!$Stock) {
                $Stock = new StockManager();
                $Stock->user_id = Auth::id();
                $Stock->branch_id = 1;
            }

            $Stock->code = $this->code;
            $Stock->date = $this->date;
            $Stock->type = 'In';
            $Stock->invoice_id = $Query->id;
            $Stock->contact_id = $Query->contact_id;
            $Stock->item_id = $key;
            $Stock->unit_id = $item->unit_id;
            $Stock->vat_id = $item->vat_id;
            $Stock->quantity = $this->item_quantity[$key];
            $Stock->sale_price = $this->item_rate[$key];
            $Stock->purchase_price = $this->item_rate[$key];
            $Stock->discount = $this->item_discount[$key];
            $Stock->purchase_subtotal = $this->item_rate[$key] * $this->item_quantity[$key];
            $Stock->sale_subtotal = $this->item_rate[$key] * $this->item_quantity[$key];
            $Stock->save();
        }
        foreach ($this->paymentMethodList as $key => $value) {
            if (isset($value['id']) && $value['id']) {
                $Payment = Payment::find($value['id']);
            } else {
                $Payment = new Payment();
            }
            $Payment->type = 'SupplierPayment';
            $Payment->date = $Query->date;
            $Payment->contact_id = $Query->contact_id;
            $Payment->invoice_id = $Query->id;
            $Payment->payment_method_id = $value['payment_method_id'];
            $Payment->amount = $value['payment_amount'];
            $Payment->code = $value['payment_code'];
            $Payment->user_id = Auth::id();
            $Payment->branch_id = 1;
            $Payment->save();
        }
        //    $this->emit('success', redirect()->to('/member/sales/invoice/'.$Query->id));

        // $this->emit('modal', 'InvoiceModal');
        if (!$this->Invoice) {
            $this->reset();
        }

        $this->code = 'TH'.floor(time() - 999999999);
        $this->payment_code = 'TH'.floor(time() - 999999999);

        $this->emit('success', [
        'text' => 'Purchase Added Successfully',
    ]);

    }

    public function ItemSave()
    {
        // dd($this->item_code);
        $this->validate([
            'category_id' => 'required',
            'item_code' => 'required',
            'name' => 'required',
            'unit_id' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
        ]);
        $Query = new ItemM();
        $Query->user_id = Auth::id();
        $Query->category_id = $this->category_id;
        $Query->item_type = 'Product';
        $Query->code = $this->item_code;
        $Query->name = $this->name;
        $Query->unit_id = $this->unit_id;
        $Query->purchase_price = $this->purchase_price;
        $Query->opening_stock = $this->opening_stock;
        $Query->vat_id = $this->vat_id;
        $Query->sale_price = $this->sale_price;
        $Query->low_stock_alert = $this->low_stock_alert;
        $Query->branch_id = $this->branch_id;
        if($this->image){
        $path = $this->image->store('/public/photo');
        $Query->image = basename($path);
        }

        $Query->save();
        $this->item_code = 'I'.floor(time() - 999999999);
        $this->emit('success', [
            'text' => 'Item C/U Successfully',
        ]);
    }

    public function ItemModal()
    {
        $this->reset();
        $this->code = 'TH'.floor(time() - 999999999);
        $this->item_code = 'TH'.floor(time() - 999999999);
        $this->emit('modal', 'ItemModal');
    }

    public function mount($id = null)
    {
        // dd($id);
        if (Auth::user()->branch) {
            $this->branch_id = Auth::user()->branch_id;
        }
        $this->code = 'TH'.floor(time() - 999999999);
        $this->item_code = 'TH'.floor(time() - 999999999);
        $this->payment_code = 'TH'.floor(time() - 999999999);
        if ($id) {
            $this->Invoice = Invoice::find($id);
            $this->contact_id = $this->Invoice->contact_id;
            $this->waiter_id = $this->Invoice->waiter_id;
            $this->table_id = $this->Invoice->table_id;
            $this->vat_id = $this->Invoice->vat_id;
            $this->date = $this->Invoice->date;
            $this->shipping_charge = $this->Invoice->shipping_charge;
            $this->discount = $this->Invoice->discount;
            $this->grand_total = $this->Invoice->grand_total;
            $this->subtotal = $this->Invoice->subtotal;
            $this->expense_point = $this->Invoice->expense_point;
            $this->expense_point_amount = $this->Invoice->expense_point_amount;
            $this->paid_amount = $this->Invoice->paid_amount;
            $this->due = $this->Invoice->due;
            $this->note = $this->Invoice->note;
            $StockManager = StockManager::whereInvoiceId($this->Invoice->id)->get();
            $cart = collect($this->orderItemList);
            foreach ($StockManager as $stockItem) {
                $item = ItemM::find($stockItem->item_id);
                $this->item_quantity[$item->id] = $stockItem->quantity;
                $this->item_discount[$item->id] = $stockItem->discount;
                $this->item_rate[$item->id] = $stockItem->sale_price;
                $this->item_subtotal[$item->id] = $stockItem->sale_price * $stockItem->quantity;
                $cart[$item->id] = $item;
            }
            $this->orderItemList = $cart;

            $PaymentList = Payment::whereInvoiceId($this->Invoice->id)->get();
            // dd($PaymentList->count());
            $cartPayment = collect($this->paymentMethodList);
            foreach ($PaymentList as $paymentList) {
                $paymentMethod = PaymentMethod::find($paymentList->payment_method_id);
                $cartItem = [
                    'id' => $paymentList->id,
                    'payment_method_id' => $paymentMethod->id,
                    'payment_method_name' => $paymentMethod->name,
                    'payment_amount' => $paymentList->amount,
                    'payment_code' => $paymentList->code,
                ];

                $this->paymentMethodList = $cartPayment->push($cartItem);
                // $this->payment_amount[$paymentMethod->id] = $paymentList->amount;

                // $cartPayment[$paymentMethod->id] = $paymentMethod;
            }
            $this->paymentMethodList = $cartPayment;
            $this->updateItemCal();
        }
    }

    public function render()
    {
        return view('livewire.inventory.purchase', [
            'contacts' => Contact::whereType('Supplier')->get(),
            'itemTypes' => ItemM::get(),
            'payments' => PaymentMethod::get(),
            'categories' => Category::get(),
            'Units' => Unit::all(),
            'vats' => Vat::get(),
            'branches' => Branch::get(),
        ]);
    }
}
