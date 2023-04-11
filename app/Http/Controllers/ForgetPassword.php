<?php

namespace App\Http\Controllers;

use App\Models\Setting\SmsSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OTPHP\TOTP;
use ParagonIE\ConstantTime\Base32;

class ForgetPassword extends Controller
{
    public function ForgetPasswordPage()
    {
        return view('frontend.forget_password');
    }

    public function getCustomKey($id)
    {
        return Base32::encodeUpper($id); //You can remove the '=' padding if any

        // return strtoupper(substr(md5(md5(Auth::id())), 0, 16));
        // return 'JBSWY3DPEHPK3PXP';
    }

    public function getSendOtpSms($user)
    {
        $SMSSEtting = SmsSetting::first();
        $otp = TOTP::create(
            $this->getCustomKey($user->id), // New TOTP with custom secret
            1000                  // The number of digits (int)
        );

        new SendSmsController(['88'.$user->mobile], 'Welcome to '.$SMSSEtting->business_name.'.Your Activation key : '.$otp->now(), 'Sign-up');
    }

    public function getOneTimePassword($user, $password)
    {
        $SMSSEtting = SmsSetting::first();
        // $otp = TOTP::create(
        // $this->getCustomKey($user->id), // New TOTP with custom secret
        // 1000                  // The number of digits (int)
        // );
        new SendSmsController(['88'.$user->mobile], 'Welcome to '.$SMSSEtting->business_name.'.Your Login Pass : '.$password, 'Sign-up');
    }

    public function generatePassword($number = null)
    {
        if (!$number) {
            $number = 'P'.mt_rand(1000000, 9999999); // better than rand()
        }
        // call the same function if the barcode exists alread
        // otherwise, it's valid and can be used
        return $number;
    }

    public function passwordUpdate(Request $request)
    {
        // return $this->generatePassword();
        // return  $request->mobile;
        // return $user = User::where('mobile',$request->mobile)->first();

        $this->validate($request, [
            'mobile' => ['required', 'string', 'max:11'],
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if ($user->mobile != $request->mobile) {
            $user->mobile = $request->mobile;
            $user->save();
        }

        if ($request->has('resend')) {
            $this->getSendOtpSms($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Your Temporary Password is send to '.$user->mobile.'.Please check your sms inbox',
            ]);
        } else {
            $this->validate($request, [
                'verify_code' => ['required', 'string', 'max:6'],
            ]);
            $otp = TOTP::create(
                $this->getCustomKey($user->id), // New TOTP with custom secret
                1000                  // The number of digits (int)
            );
            $password = $this->generatePassword();
            if ($otp->verify($request->verify_code) == 'true') {
                $user->mobile_verified_at = Carbon::now();
                $user->password = Hash::make($password);
                $user->save();
                // $this->getOneTimePassword($user, $password);

                // return response()->json([
                //     'status' => 'success',
                //     'message' => 'Account Verified Successfully',
                // ]);
                Auth::loginUsingId($user->id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login Success',
                    // 'redirect_url' => route('forget_password.change'),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Activation code is not valid',
                ], 422);
            }
        }
    }

    public function ForgetPasswordChange(){
        return view('frontend.forget_password_change');
    }
    public function ForgetPasswordNewUpdate(Request $request){

  $this->validate($request, [
                'password' => ['required', 'string', 'min:4'],
     ]);
     $user=Auth::user();
     $user->password = Hash::make($request->password);
     $user->save();
     return response()->json([
        'status' => 'success',
        'message' => 'Your Password Changed Successfully',
        // 'redirect_url' => route('forget_password.change'),
    ]);

    }
}
