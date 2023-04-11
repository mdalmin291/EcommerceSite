<?php

namespace App\Http\Livewire\Backend\AccountsSetting;
use App\Models\Backend\AccountsSetting\Transaction;
use Livewire\Component;

class ReceiveInvoice extends Component
{
    public $ReceiveId;

    public function mount($id=NULL){
        $this->ReceiveId=$id;
     }
    public function render()
    {
        $receive=Transaction::find($this->ReceiveId);
        return view('livewire.backend.accounts-setting.receive-invoice',[
            'receive'=>$receive,
        ])->layout('layouts.invoice-master');
    }
}
