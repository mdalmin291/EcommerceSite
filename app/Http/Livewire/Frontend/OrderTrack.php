<?php

namespace App\Http\Livewire\Frontend;
use App\Models\FrontEnd\Order;
use Livewire\Component;

class OrderTrack extends Component
{

    public $code;

    public function mount($code ="OC647494102")
    {
        $this->code = $code;
    }


    public function render()
    {
        // dd(Order::where('code', $this->ordercode)->first());
        return view('frontend.order-track',[
            'orders' => Order::where('code', $this->code)->first(),
        ])->layout('layouts.front_end');
    }
}
