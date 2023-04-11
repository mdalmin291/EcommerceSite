<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ParagonIE\ConstantTime\Base32;
use OTPHP\TOTP;
use Illuminate\Support\Carbon;

class OtpController extends Controller
{
    public function OtpVerifyPage()
    {
        if(Auth::user() && Auth::user()->mobile_verified_at){
            return redirect()->route('my-account');
        }
        return view('frontend.otp-verify');
    }

    public function getCustomKey()
    {
        return Base32::encodeUpper(Auth::id()); //You can remove the '=' padding if any

        // return strtoupper(substr(md5(md5(Auth::id())), 0, 16));
        // return 'JBSWY3DPEHPK3PXP';
    }

    public function getSendOtpSms($mobileNumber = null)
    {
        $otp = TOTP::create(
            $this->getCustomKey(), // New TOTP with custom secret
            1000                  // The number of digits (int)
        );
        if (!$mobileNumber) {
            $mobileNumber = Auth::User()->mobile;
        }
        new SendSmsController(['88'.$mobileNumber], 'Dear Sir,Your OTP is : '.$otp->now().' Thanks');
    }

    public function otpUpdate(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', 'string', 'max:11'],
        ]);

        $user = Auth::User();

        if ($user->mobile != $request->mobile) {
            $user->mobile = $request->mobile;
            $user->save();
        }

        if ($request->has('resend')) {
            $this->getSendOtpSms();

            return response()->json([
                'status' => 'success',
                'message' => 'Account Activation Code Send to '.$user->mobile.'.Please check your sms inbox',
            ]);
        } else {
            $this->validate($request, [
                'verify_code' => ['required', 'string', 'max:6'],
            ]);
            $otp = TOTP::create(
                $this->getCustomKey(), // New TOTP with custom secret
                1000                  // The number of digits (int)
            );

            if ($otp->verify($request->verify_code) == 'true') {
                $user->mobile_verified_at = Carbon::now();
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Account Verified Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Activation code is not valid',
                ], 422);
            }
        }
    }
}

