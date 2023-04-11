<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\Inventory\SaleInvoice as SaleInvoiceInfo;
use Livewire\Component;

class SaleInvoice extends Component
{
    public $SaleId;
    public $SaleInvoiceId;
    public function mount($id){
      $this->SaleInvoiceId=$id;
      $this->SaleId='S'.floor(time() - 999999999);
    }
    public function render()
    {
        return view('livewire.backend.inventory.sale-invoice',[
            'SaleInvoice'=>SaleInvoiceInfo::whereId($this->SaleInvoiceId)->first(),
        ]);
    }
}
