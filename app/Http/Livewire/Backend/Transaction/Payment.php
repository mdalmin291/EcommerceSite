<?php

namespace App\Http\Livewire\Backend\Transaction;

use Livewire\Component;

class Payment extends Component
{

    public function PaymentInfoModal(){
        $this->emit('modal','PaymentInfoModal');
    }
    public function render()
    {
        return view('livewire.backend.transaction.payment');
    }
}
