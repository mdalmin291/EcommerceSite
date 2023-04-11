@extends('layouts.front_end')
@section('content')
<div class="wrapper-content">
	<div class="container">
        <div class="row">
					<form id="otpUpdate" class="col-sm-16" method="POST" action="{{ route('otp.update') }}">
						@csrf
						<div class="row">

                            <div class="offset-md-11 col-md-11">

                                    <h3 class="mt-2 text-center">OTP Check</h3>
                                <hr class="my-2">

                            </div>

							<div class="offset-md-11 col-md-11">
								<div class="form-group">
										<div class="col-lg-16 col-md-16">
											<label>Mobile:</label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">+88</span>
                                            </div>
											<input type="text" name="mobile" class="form-control" value="{{Auth::User()->mobile}}" readonly>
										</div>
									</div>
								</div>
								<div class="form-group">

										<div class="col-lg-16 col-md-16">

                                            <label>Activation Code:</label>
											<input type="number" name="verify_code" class="form-control">

										</div>

								</div>
								<div class="form-group">

										<div class="col-lg-16 col-md-16 verify_required">
											<center>
												<button type="submit" class="btn btn-primary">Verify</button>
												<button type="button" class="btn btn-info send_verify_code">Resend</button>
											</center>
										</div>
										{{-- <div class="col-lg-16 col-md-16 verified">
											<center>
												<a href="{{route('my-account')}}" class="btn btn-success">Next</a>
											</center>
										</div> --}}
								</div>
							</div>

						</div>
					</div>
				</form>
</div>
</div>
@endsection
@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script> --}}
{{-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> --}}
{{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script> --}}
<script>
	$(document).ready(function(){
		$('.verify_required').show();
		$('.verified').hide();

		$('#otpUpdate').ajaxForm({
			beforeSend: formBeforeSend,
			beforeSubmit: formBeforeSubmit,
			error: formError,
			success: function (responseText, statusText, xhr, $form) {
                swal({
                    title: responseText.message,
                    text: "You will redirect to Your Account",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                    // },
                    // function(){
                    //     window.location.href = "{{route('my-account')}}";
                    }).then(function() {
    window.location = "{{route('my-account')}}";
});
				$('.verify_required').hide();
                $('.verified').show();
			}
		});

		$(document).on('click','.send_verify_code',function(event){
            console.log(true);
			event.preventDefault();

			$(event).ajaxSubmit({
				type: 'POST',
				url: "{{route('otp.update')}}",
				data:{
					mobile: $('input[name="mobile"]').val(),
					resend:'#'
				},
				beforeSend: formBeforeSend,
				beforeSubmit: formBeforeSubmit,
				error: formError,
				success: function (responseText, statusText, xhr, $form) {
					formSuccess(responseText, statusText, xhr, $form);
				}
			});

		});
	});
</script>
@endsection
