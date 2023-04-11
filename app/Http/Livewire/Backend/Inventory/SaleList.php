<?php

namespace App\Http\Livewire\Backend\Inventory;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Inventory\SaleInvoice as SaleInvoiceInfo;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SaleList extends Component
{
    public function SendInvoiceByMail($id){
        $data = ['SaleId'=>'S'.floor(time() - 999999999), 'SaleInvoiceId'=>$id, 'SaleInvoice'=> SaleInvoiceInfo::whereId($id)->first()];
        $invoice = SaleInvoice::find($id);
        $email = $invoice->Contact->email;
        if($email){
        Mail::send('livewire.backend.inventory.sale-invoice', $data, function($messages) use($email){
           $messages->to($email);
           $messages->subject('Order Summery');
        });

        $this->emit('success', [
            'text' => 'Sale Summery Mailed To '.$email.'.'
        ]);
        }else{
            $this->emit('success', [
                'text' => 'Email Address Not Found!!'
            ]);
        }
    }
    public function SaleDelete($invoiceId){
        SaleInvoice::whereId($invoiceId)->delete();
        SaleInvoiceDetail::whereSaleInvoiceId($invoiceId)->delete();
        SalePayment::whereSaleInvoiceId($invoiceId)->delete();

        $this->emit('success', [
            'text' => 'Sale Invoice Deleted Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.inventory.sale-list');
    }
}
