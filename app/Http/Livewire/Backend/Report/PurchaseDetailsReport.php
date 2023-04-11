<?php

namespace App\Http\Livewire\Backend\Report;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseDetailsReport extends Component
{
    public $from_date;
    public $to_date;
    public $contact_id;

    // public function dateFilter($model){
    //     return $model->where('sale_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('sale_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    // }
    public function render()
    {
        $PurchaseInvoiceDetail=PurchaseInvoiceDetail::orderBy('id', 'desc');
        if($this->contact_id){
            $PurchaseInvoiceDetail=$PurchaseInvoiceDetail->PurchaseInvoice->whereContactId($this->contact_id);
        }
        return view('livewire.backend.report.purchase-details-report', [
            'suppliers' => Contact::whereType('Supplier')->get(),
             'purchaseDetails' => $PurchaseInvoiceDetail->get(),
        ]);
    }
}
