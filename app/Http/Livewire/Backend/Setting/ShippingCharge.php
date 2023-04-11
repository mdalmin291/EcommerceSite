<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Backend\Setting\ShippingCharge as ShippingChargeInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingCharge extends Component
{
    public $code;
    public $title;
    public $type;
    public $from;
    public $to;
    public $shipping_fee;
    public $country_id;
    public $is_active=1;
    public $ShippingChargeId;

    public function ShippingChargeEdit($id){
        $QueryUpdate = ShippingChargeInfo::find($id);
        $this->ShippingChargeId = $QueryUpdate->id;
        $this->code = $QueryUpdate->code;
        $this->title = $QueryUpdate->title;
        $this->type = $QueryUpdate->type;
        $this->from = $QueryUpdate->from;
        $this->to = $QueryUpdate->to;
        $this->shipping_fee = $QueryUpdate->shipping_fee;
        $this->country_id = $QueryUpdate->country_id;
        $this->is_active = $QueryUpdate->is_active;
		$this->emit('modal', 'ShippingChargeMOdal');
    }
    public function ShippingChargeDelete($id){
        ShippingChargeInfo::find($id)->delete();
        $this->emit('success',[
           'text' => 'Shipping Charge Deleted Successfully',
        ]);
    }
    public function ShippingChargeSave(){
        $this->validate([
            'code' => 'required',
            'title'=> 'required',
            'type' => 'required',
            'from' => 'required|numeric',
            'to' => 'required|numeric',
            'shipping_fee' => 'required|numeric',
            'country_id' => 'required',
            'is_active' => 'required',
        ]);

        if ($this->ShippingChargeId){
            $Query  = ShippingChargeInfo::find($this->ShippingChargeId);
        }else{
            $Query = new ShippingChargeInfo();
            $Query->created_by = Auth::user()->id;
        }

        $Query->code = $this->code;
        $Query->title = $this->title;
        $Query->type = $this->type;
        $Query->from = $this->from;
        $Query->to = $this->to;
        $Query->shipping_fee = $this->shipping_fee;
        $Query->country_id = $this->country_id;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;
        $Query->save();

        $this->reset();
        $this->ShippingChargeModal();
        $this-> emit('success',[
           'text' => 'Shipping Charge Saved Successfully',
        ]);
    }
    public function ShippingChargeModal(){
        $this->reset();
        $this->code = 'SC'. floor(time()-999999);
        $this->emit('modal','ShippingChargeMOdal');
    }
    public function render()
    {
        return view('livewire.backend.setting.shipping-charge');
    }
}
