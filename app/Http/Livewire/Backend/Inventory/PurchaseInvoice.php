<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\Inventory\PurchaseInvoice as PurchaseInvoiceInfo;
use Livewire\Component;

class PurchaseInvoice extends Component
{
    public $PurchaseId;
    public $PurchaseInvoiceId;
    public function mount($id){
      $this->PurchaseInvoiceId=$id;
      $this->PurchaseId='P'.floor(time() - 999999999);
    }
    public function render()
    {
        return view('livewire.backend.inventory.purchase-invoice',[
            'PurchaseInvoice'=>PurchaseInvoiceInfo::whereId($this->PurchaseInvoiceId)->first(),
        ]);
    }
}
