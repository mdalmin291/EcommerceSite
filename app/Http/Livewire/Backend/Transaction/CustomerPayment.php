<?php

namespace App\Http\Livewire\Backend\Transaction;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Setting\Currency;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\NumberToWord;
class CustomerPayment extends Component
{
    use NumberToWord;
    protected $listeners = [
        'search' => 'InvoiceIdSearch',
    ];
    public $contact_id;
    public $date;
    public $sale_invoice_id;
    public $code;
    public $sale_code;
    public $transaction_id;
    public $payment_method_id;
    public $receipt_no;
    public $Receipt;
    public $total_amount;
    public $note;
    public $invoice;
    public $PaymentId;

    public function InvoiceIdSearch($invoice)
    {
      $this->sale_invoice_id=$invoice['id'];
      $SaleInvoice=SaleInvoice::find($this->sale_invoice_id);
      $this->total_amount=$SaleInvoice->total_amount;
    }

    public function editPayment($id)
    {
        $this->PaymentId = $id;
        $QueryUpdate = SalePayment::find($this->PaymentId);
        $this->contact_id = $QueryUpdate->contact_id;
        $this->date = $QueryUpdate->date;
        $this->code = $QueryUpdate->code;
        $this->sale_invoice_id = $QueryUpdate->sale_invoice_id;
        $this->transaction_id = $QueryUpdate->transaction_id;
        $this->payment_method_id = $QueryUpdate->payment_method_id;
        $this->receipt_no = $QueryUpdate->receipt_no;
        $this->note = $QueryUpdate->note;
        $this->total_amount = $QueryUpdate->total_amount;
    }

    public function moneyReceiptModal($id)
    {

        $this->receipt_no = floor(time() - 999999999);
        $this->Receipt = SalePayment::find($id);
        // dd($this->Receipt);
        $this->emit("modal", "moneyReceipt");
    }


    public function deletePayment($id)
    {
        SalePayment::whereId($id)->delete();
        $this->emit('success', [
        'text' => 'Payment Deleted Successfully',
    ]);
    }

    public function paymentSave()
    {
        $this->validate([
            'code' => 'required',
            'date' => 'required',
            'contact_id' => 'required',
            'transaction_id' => 'required',
            'payment_method_id' => 'required',
            'total_amount' => 'required',
        ]);

        // dd($this->code);
        $sale_invoice_id = SaleInvoice::whereCode($this->sale_code)->first();
        // dd($sale_invoice_id);
        if ($this->PaymentId) {
            $Query = SalePayment::find($this->PaymentId);
        } else {
            $Query = new SalePayment();
            $Query->created_by = Auth::user()->id;
        }
        $Query->code = $this->code;
        $Query->date = $this->date;
        // $Query->type = "CustomerPayment";
        $Query->contact_id = $this->contact_id;
        $Query->sale_invoice_id = $this->sale_invoice_id;
        $Query->total_amount = $this->total_amount;
        $Query->payment_method_id = $this->payment_method_id;
        $Query->transaction_id = $this->transaction_id;
        $Query->receipt_no = $this->receipt_no;
        $Query->note = $this->note;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->save();

        $this->emit('success', [
            'text' => 'Sales Payment C/U Successfully',
        ]);
    }

    public function mount($sale_code = null)
    {
        // dd($sale_code);
        $this->code = 'CP'.floor(time() - 999999999);
        $this->transaction_id = 'TI'.floor(time() - 999999999);
        if (request()->filled('search')) {
            $this->InvoiceIdSearch(SaleInvoice::where('code', request()->search)->first());
            $this->sale_code=request()->search;
        }
        //   dd($this->sale_code);
        $this->date=date('Y-m-d', time());
        $this->receipt_no = floor(time() - 999999999);
    }

    public function render()
    {
        $customer_payments = SalePayment::orderBy('id', 'DESC')->paginate(10);
        $total=0;
        if ($this->Receipt) {
            $currency = Currency::first();
            if(isset($this->Receipt->SaleInvoice->total_amount)){
                $total = $this->numtowords($this->Receipt->total_amount, $currency->in_word_prefix, $currency->in_word_surfix, $currency->in_word_prefix_position, $currency->in_word_surfix_position);
            }
        }
        return view('livewire.backend.transaction.customer-payment', [
            'sale_codes' => SaleInvoice::get(),
            'contacts' => Contact::whereType('Customer')->get(),
            'payment_methods' => PaymentMethod::get(),
            'total'=>$total,
            // 'payments' => SalePayment::orderBy('id', 'DESC')->paginate(10),
            'payments'=>$customer_payments,
        ]);
    }
}
