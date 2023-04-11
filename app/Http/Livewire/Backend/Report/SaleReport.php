<?php

namespace App\Http\Livewire\Backend\Report;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\ContactInfo\Contact;
use Carbon\Carbon;
use Livewire\Component;

class SaleReport extends Component
{
    public $from_date='00-00-00';
    public $to_date='01-01-3000';
    public $contact_id;

    public function dateFilter($model){
        return $model->where('sale_date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('sale_date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }
    public function render()
    {
        $salesInvoice=SaleInvoice::orderBy('id', 'desc');
        if($this->contact_id){
            $salesInvoice->whereContactId($this->contact_id);
        }
        return view('livewire.backend.report.sale-report', [
              'customers' => Contact::whereType('Customer')->get(),
              'salesInvoice' => $salesInvoice->get(),
        ]);
    }
}
