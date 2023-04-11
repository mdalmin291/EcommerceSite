<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Setting\CouponCode as CouponCodeInfo;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CouponCode extends Component
{
    public $code;
    public $expired_day;
    public $expired_date;
    public $after_effect_date;
    public $offer_type;
    public $offer_amount;
    public $min_buy_amount;
    public $is_active=1;
    public $CouponCodeId;
    public $QueryUpdate;


public function couponCodeSave(){
    $this->validate([
       'code'                 => 'required',
       'expired_day'                 => 'required',
       'expired_date'                 => 'required',
       'after_effect_date'                 => 'required',
       'offer_type'          => 'required',
       'offer_amount'              => 'required',
       'is_active'         => 'required',
    ]);


    if ($this->CouponCodeId){
        $Query = CouponCodeInfo::find($this->CouponCodeId);
    }else{
        $Query  = new CouponCodeInfo();
        $Query->created_by = Auth::user()->id;
    }

    $Query->code               = $this->code;
    $Query->expired_day       = $this->expired_day;
    $Query->expired_date       = $this->expired_date;
    $Query->after_effect_date       = $this->after_effect_date;
    $Query->offer_type         = $this->offer_type;
    $Query->offer_amount             = $this->offer_amount;
    $Query->min_buy_amount     = $this->min_buy_amount;
    $Query->is_active             = $this->is_active;
    $Query->branch_id          = Auth::user()->branch_id;
    $Query->save();
    $this->reset();
    $this->couponCodeModal();
    $this->emit('success',[
       'text' => 'Coupon Code Saved successfully',
    ]);

}

public function couponEdit($id){
   $this->QueryUpdate        = CouponCodeInfo::find($id);
   $this->CouponCodeId      = $this->QueryUpdate->id;
   $this->code               = $this->QueryUpdate->code;
   $this->expired_day       = $this->QueryUpdate->expired_day;
   $this->expired_date       = $this->QueryUpdate->expired_date;
   $this->after_effect_date       = $this->QueryUpdate->after_effect_date;
   $this->offer_type         = $this->QueryUpdate->offer_type;
   $this->offer_amount             = $this->QueryUpdate->offer_amount;
   $this->min_buy_amount     = $this->QueryUpdate->min_buy_amount;
   $this->is_active             = $this->QueryUpdate->is_active;

   $this->couponCodeModal();
}

public function couponDelete($id){
    CouponCodeInfo::find($id)->delete();
    $this->emit('success',[
       'text' => 'Coupon Code Deleted Successfully',
    ]);
}


    public function couponCodeModal(){
        $this->code = 'CO'. floor(time()-99999);
        $this->emit('modal','couponCodeModal');
    }
    public function render()
    {
        return view('livewire.backend.setting.coupon-code');
    }
}
