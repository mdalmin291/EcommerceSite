<?php

namespace App\Http\Livewire\Backend\AccountsSetting;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\AccountsSetting\Transaction as TransactionModal;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\AccountsSetting\ChartOfAccount;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;

class Receive extends Component
{

    protected $listeners = [
        'search' => 'InvoiceIdSearch',
    ];
    public $contact_id;
    public $date;
    public $code;
    public $chart_of_account_id;
    public $payment_method_id;
    public $receipt_no;
    public $total_amount;
    public $note;
    public $amount;
    public $QueryUpdate;
    public $transaction_id;
    public $transaction;


    // public function InvoiceIdSearch($invoice)
    // {
    //   $this->sale_invoice_id=$invoice['id'];
    //   $SaleInvoice=SaleInvoice::find($this->sale_invoice_id);
    //   $this->total_amount=$SaleInvoice->total_amount;
    // }

    public function InvoiceModal($id)
    {
        $this->transaction = TransactionModal::find($id);
        $this->emit('modal', 'InvoiceModal');
    }

    public function InvoicePrint($id)
    {
        $this->emit('redirect', [
            'url' => route('setting.receive-invoice', ['id' => $id]),
        ]);
    }

    public function ReceiveSave()
    {
        $this->validate([
            'code' => 'required',
            'date' => 'required',
            'contact_id' => 'required',
            'transaction_id' => 'required',
            'payment_method_id' => 'required',
            'chart_of_account_id' => 'required',
        ]);

        // dd($this->code);
        // $sale_invoice_id = SaleInvoice::whereCode($this->sale_code)->first();
        // dd($sale_invoice_id);


        $Query = TransactionModal::where('transaction_id',$this->transaction_id)->first();

        if (!$Query) {
            $Query = new TransactionModal();
        }

        // if ($this->transaction_id) {
        //     $Query = TransactionModal::find($this->transaction_id);
        // } else {
        //     $Query = new TransactionModal();
        // }

        $Query->code = $this->code;
        $Query->date = $this->date;
        $Query->type = 'Receive';
        $Query->contact_id = $this->contact_id;
        $Query->chart_of_account_id = $this->chart_of_account_id;
        $Query->payment_method_id = $this->payment_method_id;
        $Query->transaction_id = $this->transaction_id;
        $Query->amount = $this->amount;
        $Query->receipt_no = $this->receipt_no;
        $Query->note = $this->note;
        $Query->save();
        $this->reset();
        $this->code = 'CP'.floor(time() - 999999999);
        $this->transaction_id = 'TI'.floor(time() - 999999999);
        $this->date=date('Y-m-d', time());

        $this->emit('success', [
            'text' => 'Transaction Payment C/U Successfully',
        ]);
    }


    public function ReceiveEdit($id)
    {
        $this->transaction_id = $id;
        $QueryUpdate = TransactionModal::find($this->transaction_id);
        $this->contact_id = $QueryUpdate->contact_id;
        $this->date = $QueryUpdate->date;
        $this->code = $QueryUpdate->code;
        $this->payment_method_id = $QueryUpdate->payment_method_id;
        $this->chart_of_account_id = $QueryUpdate->chart_of_account_id;
        $this->transaction_id = $QueryUpdate->transaction_id;
        $this->receipt_no = $QueryUpdate->receipt_no;
        $this->note = $QueryUpdate->note;
        $this->amount = $QueryUpdate->amount;
    }


    public function ReceiveDelete($id)
    {
        TransactionModal::find($id)->delete();
        $this->emit('success', [
            'text' => 'Payment Method Deleted Successfully',
        ]);
    }


public function mount(){
    $this->code = 'CP'.floor(time() - 999999999);
    $this->transaction_id = 'TI'.floor(time() - 999999999);
    $this->date=date('Y-m-d', time());
}



    public function render()
    {

        return view('livewire.backend.accounts-setting.receive',[
               'contacts' => Contact::whereType('Staff')->get(),
               'payment_methods' => PaymentMethod::get(),
               'chart_of_account' => ChartOfAccount::get(),
               'receive' => TransactionModal::whereType('Receive')->get(),
        ]);
    }
}
