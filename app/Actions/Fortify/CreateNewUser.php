<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\SendSmsController;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Setting\SmsSetting;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use ParagonIE\ConstantTime\Base32;
use OTPHP\TOTP;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            // 'business_name' => ['required', 'string', 'max:255'],
            'district_id' => ['required'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                // 'email' => $input['email'],
                'address' => $input['address'],
                'mobile' => $input['mobile'],
                'type' => 'Customer',
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $this->createTeam($user);
                $user->assignRole('customer');
                $contact = Contact::whereUserId($user->id)->firstOrNew();
                // $contact->business_name = $input['business_name'];
                $contact->first_name = $user->name;
                $contact->address = $user->address;
                $contact->shipping_address = $user->address;
                $contact->user_id = $user->id;
                $contact->type = 'Customer';
                $contact->mobile = $user->mobile;
                $contact->district_id = $input['district_id'];
                $contact->created_by = $user->id;
                $contact->save();
                // $this->getSendOtpSms($user->mobile,$user->id);
                // new SendSmsController(['88'.$user->mobile], 'Congratulations!  Welcome to Shopping From JSR Shopping Mall .For home delivery call:01888641010.Thanks stay with us');
            });
        });
    }
    public function getCustomKey($userID)
    {
        return Base32::encodeUpper($userID); //You can remove the '=' padding if any

        // return strtoupper(substr(md5(md5(Auth::id())), 0, 16));
        // return 'JBSWY3DPEHPK3PXP';
    }

    // public function getSendOtpSms($mobileNumber = null,$userID)
    // {
    //     $SMSSEtting = SmsSetting::first();
    //     $otp = TOTP::create(
    //         $this->getCustomKey($userID), // New TOTP with custom secret
    //         1000                  // The number of digits (int)
    //     );

    //     new SendSmsController(['88'.$mobileNumber], 'Dear Sir,Your OTP is : '.$otp->now().' Thanks,'.$SMSSEtting->business_name.'');
    // }

    /**
     * Create a personal team for the user.
     *
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
