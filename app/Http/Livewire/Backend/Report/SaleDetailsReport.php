<?php

namespace App\Http\Livewire\Backend\Report;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\ContactInfo\Contact;
use Livewire\Component;

class SaleDetailsReport extends Component
{
    public $from_date;
    public $to_date;
    public $contact_id;

    public function render()
    {
        $SaleInvoiceDetail=SaleInvoiceDetail::orderBy('id', 'desc');
        if($this->contact_id){
            $SaleInvoiceDetail=$SaleInvoiceDetail->SaleInvoice->whereContactId($this->contact_id);
        }
        return view('livewire.backend.report.sale-details-report', [
             'Customers' => Contact::whereType('Customer')->get(),
             'saleDetails' => $SaleInvoiceDetail->get(),
        ]);
    }
}
