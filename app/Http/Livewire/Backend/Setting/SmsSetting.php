<?php

namespace App\Http\Livewire\Backend\Setting;

use App\Models\Setting\SmsSetting as SmsSettingData;
use Livewire\Component;

class SmsSetting extends Component
{

    public $url;
    public $api_key;
    public $username;
    public $password;
    public $sender_id;
    public $business_name;
    public $contact_info;
    public $is_sale;
    public $is_purchase;
    public $is_receive;
    public $is_payment;
    public $is_contact;
    public $is_receivable;
    public $SmsSettingData;

public function mount(){
    $this->SmsSettingData  = SmsSettingData::first();
    if ($this->SmsSettingData){
        $this->url= $this->SmsSettingData->url;
        $this->api_key= $this->SmsSettingData->api_key;
        $this->username= $this->SmsSettingData->username;
        $this->password= $this->SmsSettingData->password;
        $this->sender_id= $this->SmsSettingData->sender_id;
        $this->business_name= $this->SmsSettingData->business_name;
        $this->contact_info= $this->SmsSettingData->contact_info;
        $this->is_sale= $this->SmsSettingData->is_sale;
        $this->is_purchase= $this->SmsSettingData->is_purchase;
        $this->is_receive= $this->SmsSettingData->is_receive;
        $this->is_payment= $this->SmsSettingData->is_payment;
        $this->is_contact= $this->SmsSettingData->is_contact;
        $this->is_receivable= $this->SmsSettingData->is_receivable;

    }
}

public function SmsSettingSave(){

    // $this->validate([
    //    'name'   => 'required',
    //    'phone'  => 'required',
    //    'address' => 'required',
    // ]);

       $Query  = SmsSettingData::first();
        if (!$Query){
           $Query= new SmsSettingData();
        }
          $Query->url = $this->url;
          $Query->api_key = $this->api_key;
          $Query->username = $this->username;
          $Query->password = $this->password;
          $Query->sender_id = $this->sender_id;
          $Query->business_name = $this->business_name;
          $Query->contact_info = $this->contact_info;
          $Query->is_sale = $this->is_sale;
          $Query->is_purchase = $this->is_purchase;
          $Query->is_receive = $this->is_receive;
          $Query->is_payment = $this->is_payment;
          $Query->is_contact = $this->is_contact;
          $Query->is_receivable = $this->is_receivable;
          $Query->save();
          $this->emit('success',[
             'text' => 'Sms Setting Saved Successfully',
          ]);
}

    public function render()
    {
        return view('livewire.backend.setting.sms-setting');
    }
}
