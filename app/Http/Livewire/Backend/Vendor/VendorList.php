<?php

namespace App\Http\Livewire\Backend\Vendor;
use App\Models\FrontEnd\Vendor;
use App\Models\User;
use App\Models\Backend\ContactInfo\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VendorList extends Component
{
    public function vendorApprove($id){
        DB::transaction(function() use($id) {

        // Vendor Status
        $Query = Vendor::find($id);
        $Query->status='Approved';
        $Query->save();

        // User Create
        $UserQuery=new User();
        $UserQuery->name=$Query->name;
        $UserQuery->mobile=$Query->mobile;
        $UserQuery->email=$Query->email;
        $UserQuery->type=$Query->account_type;
        $UserQuery->branch_id=1;
        $UserQuery->upazila_id=1;
        $UserQuery->profile_photo_path=$Query->profile_photo_path;
        $UserQuery->password=$Query->password;
        // $UserQuery->type='Customer';
        $UserQuery->save();
        //  Create Contact
        $ContactQuery=new Contact();
        $ContactQuery->type='Customer';
        $ContactQuery->user_id=$UserQuery->id;
        $ContactQuery->first_name=$Query->name;
        $ContactQuery->mobile=$Query->mobile;
        $ContactQuery->email=$Query->email;
        $ContactQuery->business_name=$Query->business_name;
        $ContactQuery->district_id=$Query->district_id;
        $ContactQuery->branch_id=1;
        $ContactQuery->created_by=Auth::user()->id;
        $ContactQuery->save();

        $this->emit('success', [
            'text' => 'Vendor Approved Successfully',
        ]);
    });
    }
    public function vendorCancel($id){
        $Query = Vendor::find($id);
        $Query->status='Cancel';
        $Query->save();
        $this->emit('success', [
            'text' => 'Vendor Cancel Successfully',
        ]);
    }
    public function render()
    {
        return view('livewire.backend.vendor.vendor-list');
    }
}
