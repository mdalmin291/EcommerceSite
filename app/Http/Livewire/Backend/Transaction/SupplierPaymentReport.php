<?php

namespace App\Http\Livewire\Backend\Transaction;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Transaction\Payment;
use Carbon\Carbon;
use Livewire\Component;

class SupplierPaymentReport extends Component
{
    public $contact_id;
    public $branch_id;
    public $type;
    public $from_date = '00-00-00';
    public $to_date = '01-01-3000';
    public function dateFilter($model)
    {
        return $model->where('date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }
    public function render()
    {
        $purchase_payments = PurchasePayment::query();
        if ($this->contact_id) {
            $purchase_payments=$purchase_payments->whereContactId($this->contact_id);
        }
        if ($this->branch_id) {
            $purchase_payments=$purchase_payments->whereBranchId($this->branch_id);
        }
        // dd(Contact::whereType('Supplier')->orderBy('id', 'DESC')->get());
        return view('livewire.backend.transaction.supplier-payment-report',[
            'supplier_payments' => $purchase_payments->get(),
            'suppliers' => Contact::whereType('Supplier')->orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get()
        ]);
    }
}
