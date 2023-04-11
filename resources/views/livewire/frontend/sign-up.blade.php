@push('css')

@endpush
<div>
    <x-slot name="title">
        Sign Up
    </x-slot>
    <x-slot name="header">
        Sign Up
    </x-slot>
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg" data-background="{{ URL::asset('venam/') }}/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>আপনার অ্যাকাউন্ট নিবন্ধন করুন</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">হোম</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">রেজিস্ট্রেশন</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- my-account-area -->
        <section class="my-account-area pattern-bg pt-100 pb-100" data-background="{{ URL::asset('venam/') }}/img/bg/pattern_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="login-page-title">
                            <h2 class="title">প্রবেশ / নিবন্ধন</h2>
                        </div>
                        <div class="my-account-bg" data-background="{{ URL::asset('venam/') }}/img/bg/my_account_bg.png">
                            <div class="my-account-content">
                                <p>Welcome Vanam Please Login Your <span>Account</span></p>
                                <div class="direct-login">
                                    <a href="#"><i class="fab fa-facebook-f"></i>Login with facebook</a>
                                    <a href="#" class="xing"><i class="fab fa-xing"></i>Login with xing</a>
                                </div>
                                <span class="or">- OR -</span>
                                <form action="#" class="login-form">
                                    <div class="form-grp">
                                        <label for="uea">USERNAME OR EMAIL ADDRESS <span>*</span></label>
                                        <input type="text" id="uea">
                                    </div>
                                    <div class="form-grp">
                                        <label for="password">PASSWORD <span>*</span></label>
                                        <input type="password" id="password">
                                        <i class="far fa-eye"></i>
                                    </div>
                                    <div class="form-grp-bottom">
                                        <div class="remember">
                                            <input type="checkbox" id="check">
                                            <label for="check">Remember me</label>
                                        </div>
                                        <div class="forget-pass">
                                            <a href="#">forgot password</a>
                                        </div>
                                    </div>
                                    <div class="form-grp-btn">
                                        <a href="#" class="btn">Sign up</a>
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
</div>
@push('scripts')

@endpush
