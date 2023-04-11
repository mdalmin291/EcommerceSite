<?php

namespace App\Http\Livewire\Frontend;
use App\Models\Backend\ContactInfo\ContactCategory;
use App\Models\Backend\ContactInfo\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CustomerRegister extends Component
{
    //Contact
    public $first_name;
    public $last_name;
    public $address;
    public $shipping_address;
    public $post_code;
    public $state;
    public $country_id;
    public $phone;
    public $mobile;
    public $email;
    public $due_date;
    public $birthday;
    public $contact_category_id;
    public $status;
    public $password;
    public $password_confirmation;
    public $message;

    public function contactSave(){
        $this->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'address'=> 'required',
            'shipping_address'=> 'required',
            'email'=> 'required|unique:contacts',
            'phone'=> 'unique:contacts',
            'mobile'=> 'unique:contacts',
            'contact_category_id'=> 'required',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        // Save Contact
        $Query=new Contact();
        $Query->type="Customer";
        $Query->first_name=$this->first_name;
        $Query->last_name=$this->last_name;
        $Query->address=$this->address;
        $Query->shipping_address=$this->shipping_address;
        $Query->post_code=$this->post_code;
        $Query->state=$this->state;
        $Query->country_id=$this->country_id;
        $Query->phone=$this->phone;
        $Query->mobile=$this->mobile;
        $Query->email=$this->email;
        $Query->contact_category_id=$this->contact_category_id;
        $Query->status=$this->status;
        $Query->password=Hash::make($this->password);
        $Query->user_id=1;
        $Query->branch_id=1;
        $Query->save();
        // $Query->syncRoles('user');
        $this->reset();
        $this->message="Contact Created Successfully!";
    }
    public function render()
    {
        return view('livewire.frontend.customer-register',[
            'contactCategories'=>ContactCategory::get(),
        ])
        ->layout('layouts.front_end');
    }
}
