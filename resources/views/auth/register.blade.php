{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <img class="img-fluid border shadow-xl rounded-full" src="./icon.png" alt=""
                style="width:100px;height:100px;">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                Policy').'</a>',
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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
                                <p style="color: #ff5c00;">Welcome To @if($companyInfo) {{$companyInfo->name}} @endif!
                                </p>
                                <div class="direct-login">
                                    <a class="btn-hover" href="{{route('sign-in')}}"
                                        style="background-color: red;font-weight: bold;"><i
                                            class="form-grp-btn"></i>LOGIN</a>
                                    {{-- <a href="#" class="xing"><i class="fab fa-xing"></i>Login with xing</a> --}}
                                </div>
                                {{-- <x-jet-authentication-card> --}}
                                    <x-slot name="logo">
                                        {{--
                                        <x-jet-authentication-card-logo /> --}}
                                        {{-- <img cqlass="img-fluid border shadow-xl rounded-full" src="./icon.png"
                                            alt="" style="width:100px;height:100px;"> --}}
                                    </x-slot>
                                    <x-jet-validation-errors class="mb-4" />
                                    <form method="POST" action="{{ route('register') }}" class="login-form">
                                        @csrf
                                        <div class="form-grp">
                                            <x-jet-label for="name" value="{{ __('Name') }}" />
                                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name"
                                                placeholder="Enter Your Name" />
                                        </div>
                                        {{-- <div class="form-grp">
                                            <x-jet-label for="business_name" value="{{ __('দোকানের নাম') }}" />
                                            <x-jet-input id="business_name" class="block mt-1 w-full" type="text"
                                                name="business_name" :value="old('business_name')" required autofocus
                                                autocomplete="name" placeholder="আপনার দোকানের নাম লিখুন" />
                                        </div> --}}
                                        <div class="form-grp">
                                            <x-jet-label for="mobile" value="{{ __('Mobile Number') }}" />
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                </div>
                                                <x-jet-input id="mobile" class="block w-full form-control" type="text"
                                                    name="mobile" :value="old('mobile')" required
                                                    placeholder="Enter Mobile Number" />
                                            </div>
                                        </div>
                                        {{-- <div class="form-grp">
                                            <x-jet-label for="email" value="{{ __('Email') }}" />
                                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                :value="old('email')" required />
                                        </div> --}}
                                        <div class="form-grp">
                                            <x-jet-label for="address" value="{{ __('Zilla') }}" />
                                            <select class="custom-select district" name="district_id" required>
                                                <option value="">Select</option>
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
                                            <x-jet-label for="address" value="{{ __('Delievery Address') }}" />
                                            <x-jet-input id="address" class="block mt-1 w-full" type="text"
                                                name="address" placeholder="Enter Delievery Address" />
                                        </div>

                                        <div class="form-grp">
                                            <x-jet-label for="password" value="{{ __('Password') }}" />
                                            <x-jet-input id="password" class="block mt-1 w-full" type="password"
                                                name="password" required autocomplete="new-password"
                                                placeholder="password" />
                                            <i class="far fa-eye" aria-hidden="true" onclick="visibility()"></i>

                                            {{-- <i class="far fa-eye"></i> --}}
                                        </div>
                                        <div class="form-grp">
                                            <x-jet-label for="password_confirmation"
                                                value="{{ __('Confirm Password') }}" />
                                            <x-jet-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password" id="password_confirmation" name="password_confirmation"
                                                required autocomplete="new-password" placeholder="Confirm Password" />
                                            <i class="far fa-eye" id="togglePassword" aria-hidden="true" onclick="visibility()"></i>
                                        </div>
                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-jet-label for="terms">
                                                <div class="flex items-center">
                                                    <x-jet-checkbox name="terms" id="terms" />

                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank"
                                                            href="'.route('terms.show').'"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms
                                                            of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank"
                                                            href="'.route('policy.show').'"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                                            Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-jet-label>
                                        </div>
                                        @endif

                                        <div class="form-grp-bottom">
                                            <div class="remember">
                                                <input type="checkbox" id="check" checked>
                                                <label for="check">I agree to the <a
                                                        href="{{route('privacy-policy')}}">Privacy Policy</a> and <a
                                                        href="{{route('terms-conditios')}}"> Terms & Conditions </a> of
                                                    @if($companyInfo) {{$companyInfo->name}} @endif.</label>
                                            </div>
                                            {{-- <div class="forget-pass">
                                                <a href="#">forgot password</a>
                                            </div> --}}
                                        </div>
                                        <div class="form-grp-btn">
                                            <button type="submit" class="btn"
                                                style="background: #ff6000;color:white;">Register
                                            </button>

                                            {{-- <x-jet-button class="ml-4" type="submit">
                                                {{ __('Register') }}
                                            </x-jet-button> --}}
                                        </div>
                                    </form>
                                    {{--
                                </x-jet-authentication-card> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my-account-area-end -->
    </main>
    <!-- main-area-end -->
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

    <script>
        const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password_confirmation');

            togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            // this.classList.toggle('fa-eye-slash');
        });
    </script>


</div>
@endsection
