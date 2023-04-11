<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\Inventory\PurchaseInvoiceDetail;
use App\Models\Backend\Inventory\PurchasePayment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class PurchaseList extends Component
{
    public function SendInvoiceByMail($id){
        $data = ['PurchaseId'=>'S'.floor(time() - 999999999), 'PurchaseInvoiceId'=>$id, 'PurchaseInvoice'=> PurchaseInvoice::whereId($id)->first()];
        $invoice = PurchaseInvoice::find($id);
        $email = $invoice->Contact->email;
        if($email){
        Mail::send('livewire.backend.inventory.purchase-invoice', $data, function($messages) use($email){
           $messages->to($email);
           $messages->subject('Purchase Summery');
        });

        $this->emit('success', [
            'text' => 'Purchase Summery Mailed To '.$email.'.'
        ]);
        }else{
            $this->emit('success', [
                'text' => 'Email Address Not Found!!'
            ]);
        }
    }
    public function PurchaseDelete($invoiceId){
        PurchaseInvoice::whereId($invoiceId)->delete();
        PurchaseInvoiceDetail::wherePurchaseInvoiceId($invoiceId)->delete();
        PurchasePayment::wherePurchaseInvoiceId($invoiceId)->delete();

        $this->emit('success', [
            'text' => 'Purchase Invoice Deleted Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.inventory.purchase-list');
    }
}
