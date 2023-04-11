<?php


namespace App\Http\Livewire\UserProfile;
use App\Models\UserProfile\ProfileSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;


class ProfileSettings extends Component
{
    use WithFileUploads;

    public $business_name;
    public $email;
    public $name;
    public $address;
    public $postal_code;
    public $city;
    public $country;
    public $profile_photo;
    public $ProfileSetting = null;

    public function mount()
    {
        $this->ProfileSetting = ProfileSetting::first();
        if ($this->ProfileSetting) {
            $this->business_name = $this->ProfileSetting->business_name;
            $this->email = $this->ProfileSetting->email;
            $this->name = $this->ProfileSetting->name;
            $this->address = $this->ProfileSetting->address;
            $this->postal_code = $this->ProfileSetting->postal_code;
            $this->city = $this->ProfileSetting->city;
            $this->country = $this->ProfileSetting->country;
        }
    }

    public function ProfileSave()
    {
        // dd(true);
        $this->validate([
            'business_name' => 'required',
            'email' => 'required',
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        if ($this->ProfileSetting) {
            $Query = $this->ProfileSetting;
        } else {
            $Query = new ProfileSetting();
            // $Query->user_id = Auth::id();
        }
        $Query->business_name = $this->business_name;
        $Query->email = $this->email;
        $Query->name = $this->name;
        $Query->address = $this->address;
        $Query->postal_code = $this->postal_code;
        $Query->city = $this->city;
        $Query->country = $this->country;
        if($this->profile_photo){
            $path = $this->profile_photo->store('/public/photo');
            $Query->profile_photo = basename($path);
        }
        $Query->company_id = Auth::user()->id;
        $Query->branch_id = 1;
        $Query->save();
        $this->emit('success', ['text' => 'Profile Settings C/U Successfully']);
    }

    public function render()
    {
        return view('livewire.user-profile.profile-settings');
    }
}
