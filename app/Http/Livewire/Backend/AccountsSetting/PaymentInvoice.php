<?php

namespace App\Http\Livewire\Backend\AccountsSetting;
use App\Models\Backend\AccountsSetting\Transaction;
use App\Traits\NumberToWord;
use Livewire\Component;

class PaymentInvoice extends Component
{
    public $PaymentId;

    public function mount($id=NULL){
        $this->PaymentId=$id;
     }
    public function render()
    {
        $payment=Transaction::find($this->PaymentId);
        return view('livewire.backend.accounts-setting.payment-invoice',[
            'payment'=>$payment,
        ])->layout('layouts.invoice-master');
    }
}
