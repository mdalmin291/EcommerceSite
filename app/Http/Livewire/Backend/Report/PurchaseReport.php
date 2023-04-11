<?php

namespace App\Http\Livewire\Backend\Report;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\PurchaseInvoice;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseReport extends Component
{
    public $from_date='00-00-00';
    public $to_date='01-01-3000';
    public $contact_id;

    public function dateFilter($model){
        return $model->where('purchase_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('purchase_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }

    public function render()
    {
        // dd(Contact::whereType('Supplier')->get());
        $purchaseInvoice=PurchaseInvoice::orderBy('id', 'desc');
        if($this->contact_id){
            $purchaseInvoice->whereContactId($this->contact_id);
        }
        return view('livewire.backend.report.purchase-report', [
            'suppliers' => Contact::whereType('Supplier')->get(),
            'purchasesInvoice' => $purchaseInvoice->get(),
        ]);
    }
}
