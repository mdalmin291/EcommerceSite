<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Backend\Setting\InvoiceSetting as InvoiceSettingInfo;
use App\Models\Backend\Setting\Currency;
use App\Models\Backend\Setting\Branch;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class InvoiceSetting extends Component
{
    use WithFileUploads;

    public $type;
    public $logo;
    public $invoice_header;
    public $invoice_title;
    public $invoice_footer;
    public $vat_reg_no;
    public $vat_area_code;
    public $vat_text;
    public $website;
    public $currency_id;
    public $is_paid_due_hide;
    public $is_memo_no_hide;
    public $is_chalan_no_hide;
    public $created_by;
    public $invoiceSettingId;
    public $invoiceInfoDetails;
    public $branch_id;



    public function invoiceSettingSave(){

        $this->validate([
            'type'              => 'required',
            // 'invoice_title'    => 'required',
            'currency_id'    => 'required',
        ]);
        $this->invoiceInfoDetails=InvoiceSettingInfo::whereCreatedBy(Auth::user()->id)->first();
        if($this->invoiceInfoDetails){
        $this->invoiceSettingId= $this->invoiceInfoDetails->id;
        }
        if ($this->invoiceSettingId){
            $Query = InvoiceSettingInfo::whereCreatedBy(Auth::user()->id)->find($this->invoiceSettingId);
        }else{
            $Query  = new InvoiceSettingInfo();
            $Query->created_by    = Auth::user()->id;
        }
        $Query->type                = $this->type;
        if($this->logo){
          $path = $this->logo->store('/public/photo');
          $Query->logo = basename($path);
        }

        $Query->invoice_header      = $this->invoice_header;
        $Query->invoice_title       = $this->invoice_title;
        $Query->invoice_footer      = $this->invoice_footer;
        $Query->vat_reg_no          = $this->vat_reg_no;
        $Query->vat_area_code       = $this->vat_area_code;
        $Query->vat_text            = $this->vat_text;
        $Query->website             = $this->website;
        $Query->currency_id         = $this->currency_id;
        $Query->is_paid_due_hide    = $this->is_paid_due_hide;
        $Query->is_memo_no_hide     = $this->is_memo_no_hide;
        $Query->is_chalan_no_hide   = $this->is_chalan_no_hide;
        $Query->branch_id           = Auth::user()->branch_id;
        $Query->save();
        $this->emit('success',[
           'text' => 'Invoice setting has been saved successfully',
        ]);
    }

    public function mount(){
        $this->invoiceInfoDetails          = InvoiceSettingInfo::whereCreatedBy(Auth::user()->id)->first();
        if ($this->invoiceInfoDetails){

            $this->invoiceSettingId    = $this->invoiceInfoDetails->id;
            $this->type                 = $this->invoiceInfoDetails->type;
            $this->invoice_header       = $this->invoiceInfoDetails->invoice_header;
            $this->invoice_title        = $this->invoiceInfoDetails->invoice_title;
            $this->invoice_footer       = $this->invoiceInfoDetails->invoice_footer;
            $this->vat_reg_no           = $this->invoiceInfoDetails->vat_reg_no;
            $this->vat_area_code        = $this->invoiceInfoDetails->vat_area_code;
            $this->vat_text             = $this->invoiceInfoDetails->vat_text;
            $this->website              = $this->invoiceInfoDetails->website;
            $this->currency_id          = $this->invoiceInfoDetails->currency_id;
            $this->branch_id            = $this->invoiceInfoDetails->branch_id;
        }

    }

    public function render()
    {
        return view('livewire.backend.setting.invoice-setting',[
            'Currencies' => Currency::get(),
            'Branches'   => Branch::get(),
        ]);
    }
}
