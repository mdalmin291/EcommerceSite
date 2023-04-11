<?php

namespace App\Http\Livewire\Backend\Order;

use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\FrontEnd\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeliveredOrderList extends Component
{
    public $from_date = '00-00-00';
    public $to_date = '01-01-3000';
    public $search_order;

    public function OrderStatus()
    {
        $IdStatus = explode(' ', $this->status);
        $this->status = $IdStatus['0'];
        $id = $IdStatus['1'];
        $statusCheck = $this->status;
        if ($this->status == 'returned') {

            DB::transaction(function () use ($id) {
                $order = Order::find($id);
                $saleInvoice = SaleInvoice::whereOrderId($order->id)->first();
                SaleInvoice::whereOrderId($order->id)->delete();
                SaleInvoiceDetail::whereSaleInvoiceId($saleInvoice->id)->delete();

                // Approve Order
                $order->status = 'returned';
                $order->save();
            });
            $this->emit('success', [
                'text' => 'Order Returned Successfully',
            ]);
        }
    }
    public function dateFilter($model)
    {
        return $model->where('order_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('order_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }

    public function render()
    {
        $order = Order::whereStatus('delivered')->orderBy('id', 'DESC');
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
        $this->status = '';

        return view('livewire.backend.order.delivered-order-list', [
            'deliveredOrders' => $order->get(),
        ]);
    }
}
