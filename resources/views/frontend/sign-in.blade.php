@extends('layouts.front_end')
@section('content')
<div>

    <x-slot name="title">
        Category
    </x-slot>
    <x-slot name="header">
       Category
    </x-slot>
   <!-- main-area -->
   <main>

    <!-- my-account-area -->
    <section class="my-account-area pattern-bg pt-20 pb-20" data-background="{{ URL::asset('venam/') }}/img/bg/pattern_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="my-account-bg" data-background="{{ URL::asset('venam/') }}/img/bg/my_account_bg.png">
                        <div class="my-account-content">
                            <p style="color: #ff5c00;">Welcome To @if($companyInfo) {{$companyInfo->name}} @endif!</p>
                            <div class="direct-login">
                                <a class="btn-hover" href="{{route('register')}}" style="background-color: red;font-weight: bold;"><i class="form-grp-btn"></i>রেজিষ্ট্রেশন করুন</a>
                                {{-- <a href="#" class="xing"><i class="fab fa-xing"></i>Login with xing</a> --}}
                            </div>
                            <form method="POST" action="{{ route('customer_sign_in') }}" class="login-form">
                                @csrf
                                <div class="form-grp">
                                    <x-jet-label for="mobile" value="{{ __('মোবাইল নাম্বার') }}" />
                                     <x-jet-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" required autofocus placeholder="মোবাইল নাম্বার লিখুন"/>
                                </div>
                                <div class="form-grp">
                                    <x-jet-label for="password" value="{{ __('পাসওয়ার্ড') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="আপনার পাসওয়ার্ড দিন"/>
                                    <i class="far fa-eye" aria-hidden="true" onclick="visibility()"></i>
                                </div>
                                <div class="form-grp-bottom">
                                    <div class="remember">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember" />
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="forget-pass">
                                        <a href="{{ route('forget_password.submit') }}">forgot password</a>
                                    </div>
                                </div>
                                <div class="form-grp-btn">
                                    {{-- <a href="#" class="btn">Login</a> --}}
                                    <button class="btn" type="submit" style="background: #ff6000;color:white;">
                                        {{ __('লগইন') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my-account-area-end -->
</main>
<!-- main-area-end -->

</div>
<script>
    function visibility() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
        </script>
@endsection


