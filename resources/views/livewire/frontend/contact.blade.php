@push('css')

@endpush
<div>
    <x-slot name="title">
        Contact
    </x-slot>
    <x-slot name="header">
        Contact
    </x-slot>

    <section class="contact-area primary-bg pt-100 pb-70">
        <div class="container">
            <div class="contact-wrap-padding">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="contact-info-box text-center mb-30">
                            <div class="contact-box-icon">
                                <i class="flaticon-placeholder"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Our Location</h5>
                                <p>W898 RTower Stat, Suite 56 Brockland, CA 9622 United States</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="contact-info-box text-center mb-30">
                            <div class="contact-box-icon">
                                <i class="flaticon-mail"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Our Email</h5>
                                <p>Email Us: Support@info.Com</p>
                                <p>Vanamsupport.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="contact-info-box text-center mb-30">
                            <div class="contact-box-icon">
                                <i class="flaticon-telephone"></i>
                            </div>
                            <div class="contact-info-content">
                                <h5>Phone Number</h5>
                                <p>Contacr Numbers: 458-965-3224</p>
                                <p>458-965-3224</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

    <!-- contact-area -->
    <section class="contact-area pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-7 col-md-9">
                    <div class="contact-title text-center mb-60">
                        <div class="section-title text-center">
                            <span class="sub-title">LET’S TALK</span>
                            <h2 class="title">Send Us a Massage</h2>
                        </div>
                        <p>We are always happy to talk with you. Be sure to write to us if you have any
                            questions or need help and support.</p>
                    </div>
                </div>
            </div>
            <div class="contact-wrap-padding">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" placeholder="First Name*">
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" placeholder="Last Name*">
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="email" required placeholder="Your Email*">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" placeholder="Phone*">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="message" id="message" placeholder="Enter Your Massage"></textarea>
                                <button type="submit" class="btn">submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-map">
                            <img src="{{ URL::asset('venam/') }}/img/images/map.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</div>
@push('scripts')

@endpush
