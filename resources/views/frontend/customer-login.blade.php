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

    <!-- breadcrumb-area -->
    {{-- <section class="breadcrumb-area breadcrumb-bg" data-background="{{ URL::asset('venam/') }}/img/bg/breadcrumb_bg.jpg"> --}}
        {{-- <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2>আপনার অ্যাকাউন্টে লগইন করুন</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">হোম</a></li>
                                <li class="breadcrumb-item active" aria-current="page">আমার অ্যাকাউন্ট</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- </section> --}}
    <!-- breadcrumb-area-end -->

    <!-- my-account-area -->
    {{-- <section class="my-account-area pattern-bg pt-100 pb-100" data-background="{{ URL::asset('venam/') }}/img/bg/pattern_bg.jpg"> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <br>
                    <div class="my-account-bg" data-background="{{ URL::asset('venam/') }}/img/bg/my_account_bg.png">
                        <div class="my-account-content">
                            <div class="login-page-title">
                                <h2 class="title"><span>লগইন করুন</span></h2>
                            </div>
                            {{-- <p>Welcome Vanam Please Login Your <span>Account</span></p> --}}
                            {{-- <div class="direct-login">
                                <a href="#"><i class="fab fa-facebook-f"></i>Login with facebook</a>
                                <a href="#" class="xing"><i class="fab fa-xing"></i>Login with xing</a>
                            </div> --}}
                            {{-- <span class="or">- OR -</span> --}}
                            <form method="POST" action="{{ route('customer_sign_in') }}" class="login-form">
                                @csrf
                                <div class="form-grp">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                     <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                </div>
                                <div class="form-grp">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                    <i class="far fa-eye"></i>
                                </div>
                                <div class="form-grp-bottom">
                                    <div class="remember">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember" />
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="forget-pass">
                                        <a href="#">forgot password</a>
                                    </div>
                                </div>
                                <div class="form-grp-btn">
                                    {{-- <a href="#" class="btn">Login</a> --}}
                                    <button class="btn" type="submit" style="background: #ff6000;color:white;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    {{-- </section> --}}
    <!-- my-account-area-end -->
</main>
<!-- main-area-end -->

</div>
@endsection


