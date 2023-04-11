{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
 <x-jet-authentication-card-logo />
            <img class="img-fluid border shadow-xl rounded-full" src="./icon.png" alt="" style="width:100px;height:100px;">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
@csrf

<div>
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
        autocomplete="name" />
</div>

<div class="mt-4">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
</div>

<div class="mt-4">
    <x-jet-label for="password" value="{{ __('Password') }}" />
    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="new-password" />
</div>

<div class="mt-4">
    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required autocomplete="new-password" />
</div>

@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
<div class="mt-4">
    <x-jet-label for="terms">
        <div class="flex items-center">
            <x-jet-checkbox name="terms" id="terms" />

            <div class="ml-2">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                ]) !!}
            </div>
        </div>
    </x-jet-label>
</div>
@endif

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/">
        {{ __('Already registered?') }}
    </a>

    <x-jet-button class="ml-4">
        {{ __('Register') }}
    </x-jet-button>
</div>
</form>
</x-jet-authentication-card>
</x-guest-layout> --}}
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
        <section class="my-account-area pattern-bg pt-20 pb-20"
            data-background="{{ URL::asset('venam/') }}/img/bg/pattern_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="my-account-bg"
                            data-background="{{ URL::asset('venam/') }}/img/bg/my_account_bg.png">
                            <div class="my-account-content">
                                <p style="color: #ff5c00;">Welcome To @if($companyInfo) {{$companyInfo->name}} @endif!</p>
                                <div class="direct-login">
                                    {{-- <a class="btn-hover" href="{{route('sign-in')}}"
                                    style="background-color: red;font-weight: bold;"><i
                                        class="form-grp-btn"></i>লগইন</a> --}}
                                    {{-- <a href="#" class="xing"><i class="fab fa-xing"></i>Login with xing</a> --}}
                                </div>
                                {{-- <x-jet-authentication-card> --}}
                                <x-slot name="logo">
                                    {{-- <x-jet-authentication-card-logo /> --}}
                                    {{-- <img cqlass="img-fluid border shadow-xl rounded-full" src="./icon.png" alt="" style="width:100px;height:100px;"> --}}
                                </x-slot>
                                <x-jet-validation-errors class="mb-4" />
                                <form method="POST" action="{{ route('seller-create') }}" class="login-form">
                                    @csrf
                                    <div class="form-grp">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name"
                                            placeholder="Name" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="business_name" value="{{ __('Business Name') }}" />
                                        <x-jet-input id="business_name" class="block mt-1 w-full" type="text"
                                            name="business_name" :value="old('business_name')" required autofocus
                                            autocomplete="business_name" placeholder="Business Name" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="trade_license" value="{{ __('Trade License') }}" />
                                        <x-jet-input id="trade_license" class="block mt-1 w-full" type="text"
                                            name="trade_license" :value="old('trade_license')" required autofocus
                                            autocomplete="trade_license" placeholder="Trade License" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="trn_number" value="{{ __('TRN Number') }}" />
                                        <x-jet-input id="trn_number" class="block mt-1 w-full" type="text"
                                            name="trn_number" :value="old('trn_number')" required autofocus
                                            autocomplete="trn_number" placeholder="TRN Number" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required placeholder="Email" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="mobile" value="{{ __('Mobile Number') }}" />
                                        <x-jet-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                                            :value="old('mobile')" required placeholder="Mobile Number" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="address" value="{{ __('Zila') }}" />
                                        <select class="custom-select district" name="district_id" required>
                                            <option value="">--Select--</option>
                                            @foreach ($Districts as $zilla)
                                            <option value="{{$zilla->id}}"
                                                class="district-items division_id_{{$zilla->division_id}} "
                                                 style="color:black;" @if($zilla->
                                                 name=='Dhaka') selected @endif>{{$zilla->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="business_location" value="{{ __('Business Location') }}" />
                                        <x-jet-input id="business_location" class="block mt-1 w-full" type="text"
                                            name="business_location" :value="old('business_location')" required
                                            autofocus autocomplete="business_location"
                                            placeholder="Business Location" />
                                    </div>
                                    <div class="form-grp">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password"
                                            placeholder="Password" />
                                        {{-- <i class="far fa-eye"></i> --}}
                                    </div>
                                    <div class="form-grp">
                                        <select class="form-control" name="account_type" required>
                                            <option value="">--Type--</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Seller">Seller</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-grp">
                                        <x-jet-label for="password_confirmation"
                                            value="{{ __('কনফার্ম পাসওয়ার্ড') }}" />
                                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="কনফার্ম পাসওয়ার্ড" />
                            </div> --}}


                            <div class="form-grp-bottom">
                                {{-- <div class="remember">
                                    <input type="checkbox" id="check" checked>
                                    <label for="check">I agree to the <a href="{{route('privacy-policy')}}">Privacy
                                Policy</a> and <a href="{{route('terms-conditios')}}"> Terms & Conditions
                                </a> of Paikari Electronics.</label>
                            </div> --}}
                            {{-- <div class="forget-pass">
                                        <a href="#">forgot password</a>
                                    </div> --}}
                        </div>
                        <div class="form-grp-btn">
                            <button type="submit" class="btn" style="background: #ff6000;color:white;">Create</button>

                            {{-- <x-jet-button class="ml-4" type="submit">
                                        {{ __('Register') }}
                            </x-jet-button> --}}
                        </div>
                        </form>
                        {{-- </x-jet-authentication-card> --}}
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
@endsection
