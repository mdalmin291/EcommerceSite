<?php

namespace App\Http\Livewire\Backend\Order;

use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\FrontEnd\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CancelOrderList extends Component
{
    public $from_date = '00-00-00';
    public $to_date = '01-01-3000';
    public $status;
    public $search_order;

    public function mount(){
        // $this->from_date = Carbon::now()->format('Y-m-d');
        // $this->to_date = Carbon::now()->format('Y-m-d');
    }
    public function dateFilter($model)
    {
        return $model->where('order_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('order_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }

    public function OrderStatus()
    {
        $IdStatus = explode(' ', $this->status);
        $this->status = $IdStatus['0'];
        $id = $IdStatus['1'];
        $statusCheck = $this->status;
        if ($this->status == 'delivered') {
            DB::transaction(function () use ($id) {
                // Start Data From Order To Sale Invoice
                $order = Order::find($id);
                $saleInvoice = SaleInvoice::whereOrderId($order->id)->firstOrNew();
                $saleInvoice->order_id = $order->id;
                $saleInvoice->code = 'SI'.floor(time() - 999999999);
                $saleInvoice->contact_id = $order->contact_id;
                $saleInvoice->sale_date = Carbon::now();
                $saleInvoice->total_amount = $order->total_amount;
                $saleInvoice->discount = $order->discount;
                $saleInvoice->shipping_charge = $order->shipping_charge;
                $saleInvoice->vat = $order->vat;
                $saleInvoice->payable_amount = $order->payable_amount;
                $saleInvoice->branch_id = Auth::user()->branch_id;
                $saleInvoice->created_by = Auth::user()->id;
                $saleInvoice->save();
                // End Data From Order To Sale Invoice

                // Start Order Detail To Sale Invoice Details
                foreach ($order->OrderDetail as $orderProduct) {
                    $saleInvoiceDetail = new SaleInvoiceDetail();
                    $saleInvoiceDetail->sale_invoice_id = $saleInvoice->id;
                    $saleInvoiceDetail->product_id = $orderProduct->product_id;
                    $saleInvoiceDetail->unit_price = $orderProduct->unit_price;
                    $saleInvoiceDetail->quantity = $orderProduct->quantity;
                    $saleInvoiceDetail->quantity = $orderProduct->quantity;
                    $saleInvoiceDetail->quantity = $orderProduct->quantity;
                    $saleInvoiceDetail->branch_id = Auth::user()->branch_id;
                    $saleInvoiceDetail->created_by = Auth::user()->id;
                    $saleInvoiceDetail->save();
                }
                // End Order Detail To Sale Invoice Details

                // Approve Order
                $order->status = $this->status;
                $order->save();
            });
            $this->emit('success', [
                'text' => 'Order Delivered Successfully',
            ]);
        } elseif ($this->status == 'delivered' || $this->status == 'processing' || $this->status == 'shipped' || $this->status == 'returned') {
            //  Approve Order
            $order = Order::find($id);
            $order->status = $statusCheck;
            $order->save();
            // dd($id);
            $this->emit('success', [
                'text' => 'Order Status Change Successfully',
            ]);
        }
    }

    public function render()
    {
        $order = Order::whereStatus('cancelled')->orderBy('id', 'DESC');
        if ($this->search_order) {
            $order->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('contacts')
                    ->whereRaw('contacts.id = orders.contact_id')
                    // ->whereRaw('chart_of_accounts.name != "Output VAT"')
                    // ->whereRaw('chart_of_accounts.name != "Sales Shipping Charge"')
                    // ->where('contacts.name = "Sales Discount"');
                    ->where('contacts.business_name', 'like', '%'.$this->search_order.'%')
                    ->orWhere('contacts.mobile', 'like', '%'.$this->search_order.'%')
                    ->orWhere('contacts.first_name', 'like', '%'.$this->search_order.'%')
                    ->orWhere('contacts.shipping_address', 'like', '%'.$this->search_order.'%')
                    ->orWhere('total_amount', 'like', '%'.$this->search_order.'%');
            })->orWhere('code', 'like', '%'.$this->search_order.'%');
        }

        return view('livewire.backend.order.cancel-order-list', [
            'cancelOrders' => $order->get(),
        ]);
    }
}
