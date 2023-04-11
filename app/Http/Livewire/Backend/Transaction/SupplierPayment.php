<?php

namespace App\Http\Livewire\Backend\Transaction;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Setting\Currency;
use Illuminate\Support\Facades\Auth;
use App\Traits\NumberToWord;
use Livewire\Component;

class SupplierPayment extends Component
{
    use NumberToWord;
    protected $listeners = [
        'search' => 'InvoiceIdSearch',
    ];
    public $contact_id;
    public $date;
    public $purchase_code;
    public $code;
    public $transaction_id;
    public $payment_method_id;
    public $receipt_no;
    public $note;
    public $Receipt;
    public $total_amount;
    public $purchase_invoice_id;
    public $PaymentId;

    public function InvoiceIdSearch($invoice)
    {
      $this->purchase_invoice_id=$invoice['id'];
      $PurchaseInvoice=PurchaseInvoice::find($this->purchase_invoice_id);
      $this->total_amount=$PurchaseInvoice->total_amount;
    }

    public function editPayment($id){
        $this->PaymentId=$id;
        $QueryUpdate=PurchasePayment::find($this->PaymentId);
        // $Invoice=PurchaseInvoice::whereId($QueryUpdate->invoice_id)->first();
        $this->contact_id=$QueryUpdate->contact_id;
        $this->date=$QueryUpdate->date;
        $this->purchase_invoice_id=$this->purchase_invoice_id;
        $this->code=$QueryUpdate->code;
        $this->transaction_id=$QueryUpdate->transaction_id;
        $this->payment_method_id=$QueryUpdate->payment_method_id;
        $this->receipt_no=$QueryUpdate->receipt_no;
        $this->note=$QueryUpdate->note;
        $this->total_amount=$QueryUpdate->total_amount;
    }

    public function moneyReceiptModal($id){
        $this->receipt_no = floor(time() - 999999999);
        $this->Receipt=PurchasePayment::find($id);
        $this->emit("modal", "moneyReceipt");
    }
    public function deletePayment($id){
        PurchasePayment::whereId($id)->delete();
       $this->emit('success', [
        'text' => 'Payment Deleted Successfully',
    ]);
    }
    public function paymentSave(){
        $this->validate([
            'code' => 'required',
            'date' => 'required',
            'contact_id' => 'required',
            'transaction_id' => 'required',
            'payment_method_id' => 'required',
            'total_amount' => 'required',
        ]);

        // dd($this->sale_code);
        $purchase_invoice_id=PurchaseInvoice::whereCode($this->purchase_code)->first();
        // dd($sale_invoice_id);
        if($this->PaymentId){
            $Query=PurchasePayment::find($this->PaymentId);
        }else{
           $Query=new PurchasePayment();
           $Query->created_by=Auth::user()->id;
        }
        $Query->code=$this->code;
        $Query->date=$this->date;
        // $Query->type ='Supplier Payment';
        $Query->contact_id=$this->contact_id;
        $Query->purchase_invoice_id=$this->purchase_invoice_id;
        $Query->total_amount=$this->total_amount;
        $Query->payment_method_id=$this->payment_method_id;
        $Query->transaction_id=$this->transaction_id;
        $Query->receipt_no=$this->receipt_no;
        $Query->note=$this->note;
        $Query->branch_id=Auth::user()->branch_id;
        $Query->save();

        $this->emit('success', [
            'text' => 'Purchase Payment C/U Successfully',
        ]);
    }
    public function mount($purchase_code = null)
    {
        // dd($sale_code);
        $this->code = 'CP'.floor(time() - 999999999);
        $this->transaction_id = 'TI'.floor(time() - 999999999);
        if (request()->filled('search')) {
            $this->InvoiceIdSearch(PurchaseInvoice::where('code', request()->search)->first());
            $this->purchase_code=request()->search;
        }
        //   dd($this->sale_code);
        $this->date=date('Y-m-d', time());
        $this->receipt_no = floor(time() - 999999999);
    }
    public function render()
    {
        $supplier_payments = PurchasePayment::orderBy('id', 'DESC')->paginate(10);
        // dd($payments);
        $total=0;
        if ($this->Receipt) {
            $invoice = PurchaseInvoice::find($this->Receipt->purchase_invoice_id);
            // dd($invoice);
            $currency = Currency::first();
            if(isset($this->Receipt->PurchaseInvoice->total_amount)){
                $total = $this->numtowords($this->Receipt->total_amount, $currency->in_word_prefix, $currency->in_word_surfix, $currency->in_word_prefix_position, $currency->in_word_surfix_position);
            }
        }
        return view('livewire.backend.transaction.supplier-payment',[
            'purchase_codes'=>PurchaseInvoice::get(),
            'contacts'=>Contact::whereType('Supplier')->get(),
            'payment_methods'=>PaymentMethod::get(),
            'payments'=>$supplier_payments,
            'total'=>$total,
        ]);
    }
}
