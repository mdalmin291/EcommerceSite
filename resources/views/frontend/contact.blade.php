@extends('layouts.front_end')
@section('content')
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
                                <p>@if($companyInfo) {!! $companyInfo->address !!} @endif</p>
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
                                <p>Email Us: @if($companyInfo) {!! $companyInfo->email !!} @endif</p>
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
                                <p>Contacr Numbers: @if($companyInfo) {!! $companyInfo->phone !!} @endif</p>
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
                            <span class="sub-title">Complain Box</span>
                            <h2 class="title">Send Us a Massage</h2>
                        </div>
                        <p>We are always happy to talk with you. Be sure to write to us if you have any
                            questions or need help and support.</p>
                    </div>
                </div>
            </div>
            <div class="contact-wrap-padding">
                @if(session()->has('message'))
                <div class="alert alert-success col-6">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form id="messages" method="POST" action="{{ route('send-message') }}"
                                enctype="multipart/form-data" class="" accept-charset="utf-8">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" name="first_name" placeholder="First Name*">
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" name="last_name" placeholder="Last Name*">
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="email" name="email" required placeholder="Your Email*">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-grp">
                                            <input type="text" name="phone" placeholder="Phone*">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-grp">
                                            <input type="text" name="subject" placeholder="Subject*">
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
                            @if($companyInfo) {!! $companyInfo->google_map_location !!} @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
		$('#messages').ajaxForm({
			beforeSend: formBeforeSend,
			beforeSubmit: formBeforeSubmit,
			error: formError,
			success: function (responseText, statusText, xhr, $form) {
				// window.location.replace(responseText.redirect_url);
                formSuccess(responseText, statusText, xhr, $form);
			},
			clearForm: true,
			resetForm: true
		});
	});
</script>
@endsection
