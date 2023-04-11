<?php

namespace App\Http\Livewire\Backend\Transaction;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Setting\Branch;
use Carbon\Carbon;
use Livewire\Component;

class CustomerPaymentReport extends Component
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
        $customer_payments = SalePayment::query();
        if ($this->contact_id) {
            $customer_payments=$customer_payments->whereContactId($this->contact_id);
        }
        if ($this->branch_id) {
            $customer_payments=$customer_payments->whereBranchId($this->branch_id);
        }
        return view('livewire.backend.transaction.customer-payment-report', [
            'customer_payments' => $customer_payments->get(),
            'customers' => Contact::whereType('Customer')->orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get()
        ]);
    }
}
