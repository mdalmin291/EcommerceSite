<?php

namespace App\Http\Livewire\Backend\Report;
use App\Models\FrontEnd\Order;
use Carbon\Carbon;
use Livewire\Component;

class OrderReport extends Component
{
    public $from_date='00-00-00';
    public $to_date='01-01-3000';
    public function dateFilter($model){
        return $model->where('order_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('order_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }
    public function render()
    {
        return view('livewire.backend.report.order-report',[
            'orders'=>Order::get(),
        ]);
    }
}
