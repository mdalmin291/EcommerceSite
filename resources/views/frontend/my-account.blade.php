@extends('layouts.front_end')
@section('content')
<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
        .image-upload>input {
            display: none;
        }

        #profile-submit-button {
            display: none;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #fdfdfd;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* general styling */
        body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }
    </style>
    <x-slot name="title">
        Category
    </x-slot>
    <x-slot name="header">
        Category
    </x-slot>

    <main>


        <!-- checkout-area -->
        <section class="checkout-area pt-50 pb-100">
            <div class="container">
                {{-- Start My Account --}}
                <div class="row">
                    {{-- Start Left Side --}}
                    <div class="col-md-4">
                        {{-- Start First Card --}}
                        <div class="card shadow-sm mb-3">
                            <center>
                                <img id="imagePreview" class="card-img-top rounded-circle mt-1"
                                    src="{{ asset('images/'.Auth::user()->profile_photo_path) }}"
                                    style="width:100px;height:100px;" alt="Profile Photo">
                                {{-- Start Profile Photo Change --}}
                                <form enctype="multipart/form-data" id="profile_photo_path"
                                    action="{{ route('change-profile-photo') }}" method="POST">
                                    @csrf
                                    <div class="image-upload">
                                        <label for="file-input">
                                            <i style="font-size: 30px;" class="fas fa-camera"></i>
                                        </label>

                                        <input id="file-input" name="profile_photo_path" type="file" />
                                    </div>
                                    <button class="mb-1 mt-0 py-2 px-3" type="submit" id="profile-submit-button"
                                        style="border-radius: 80%; border: 1px solid red;font-size:14px;color: red;">Save</button>
                                </form>
                                {{-- End Profile Photo Change --}}
                            </center>
                            <div class="card-body pt-0 mt-0">
                                <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                                <div class="card-title text-center" style="font-weight: bold;color: black;">
                                    {{ Auth::user()->mobile }}</div>
                                <center>
                                    <div class="heder-top-guide">
                                        <a class="log-out-btn text-danger border border-danger p-1 pt-2 rounded"
                                            href="#"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                                class="bx bx-power-off font-size-16 align-middle text-danger"></i>
                                            লগ আউট</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </center>
                                <center>
                                    {{-- <a href="#" class="btn px-0 py-2" style="width: 130px;background-color:rgb(110, 231, 175);">Check Account</a> --}}
                                </center>
                            </div>
                            <ul class="list-group list-group-flush" style="font-weight: bold;">
                                <li class="list-group-item"><a class="text-dark" href="#delivery-address"
                                        data-toggle="tab">ডেলিভারি এড্রেস</a></li>
                                {{-- <li class="list-group-item"><a href="#basic-information" class="text-dark"
                                        data-toggle="tab">প্রোফাইল</a></li> --}}
                                <li class="list-group-item"><a class="text-dark" href="#change-password"
                                        data-toggle="tab">পাসওয়ার্ড পরিবর্তন</a></li>
                                {{-- <li class="list-group-item"><a class="text-dark" href="#transaction" data-toggle="tab">Transactions</a></li> --}}
                                <li class="list-group-item active"><a class="text-dark" href="#order"
                                        data-toggle="tab"><span style="color: #ff5c00;">অর্ডার লিস্ট</span></a></li>
                            </ul>
                        </div>
                        {{-- End First Card --}}
                    </div>
                    {{-- End Left Side --}}

                    {{-- Start Right Side --}}
                    <div class="col-md-8">
                        {{-- Start Card For Basic Information --}}
                        <div class="card shadow-sm tab-content clearfix">
                            {{-- Start Delivery Address --}}
                            <div class="card-body basic tab-pane" id="delivery-address">
                                <form action="{{ route('edit-shipping-address') }}" method="POST">
                                    @csrf
                                    <h5 class="card-title">ডেলিভারি এড্রেস</h5>
                                    <hr class="mt-2">
                                    {{-- <div class="row">
                                  <div class="col-6 pb-2 font-weight-bold">Delivery Address:</div>
                                  <div class="col-6 pb-2">
                                      <input class="form-control" type="shipping_address" name="shipping_address" value="@if(Auth::user()->Contact) {{Auth::user()->Contact->shipping_address}}
                                    @endif" name="email"/>
                            </div>
                            <hr>
                        </div> --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-grp">
                                    <label for="fName" style="color: black;"> নাম<span>*</span></label>
                                    <input class="form-control" type="text" name="first_name" required
                                        value="@if(Auth::user() && Auth::user()->Contact){{Auth::user()->Contact->first_name}}@endif"
                                        placeholder="আপনার নাম লিখুন">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-grp">
                                    <label for="mobile" style="color: black;">মোবাইল নাম্বার<span>*</span></label>
                                    <input class="form-control" type="text" name="mobile" required
                                        value="@if(Auth::user() && Auth::user()->Contact){{Auth::user()->Contact->mobile}}@endif"
                                        placeholder="মোবাইল নাম্বার লিখুন">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <div class="form-grp">
                                    <label style="color: black;">জেলা *</label>
                                    <select class="custom-select district" name="district_id" required>
                                        <option value="">সিলেক্ট করুন</option>
                                        @foreach ($Districts as $zilla)
                                        <option value="{{$zilla->id}}"
                                            class="district-items division_id_{{$zilla->division_id}} "
                                            @if(Auth::user()->Contact && !Auth::user()->Contact->District) @if($zilla->name=='Dhaka') selected
                                            @endif @elseif(Auth::user()->Contact && $zilla->name==Auth::user()->Contact->District->name) selected
                                            @endif style="color:black;">{{$zilla->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-6 mt-1">
                                <div class="form-grp">
                                    <label style="color: black;">উপজেলা *</label>
                                    <select class="custom-select form-control" id="district" name="district" required>
                                        <option value="Dhaka">Dhaka</option>
                                        <option value="New York">Chittagang</option>
                                        <option value="California">Barisal</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12 mt-1">
                                <div class="form-grp">
                                    <label for="shipping_address" style="color: black;">পূর্ণ ঠিকানা*</label>
                                    {{-- <input class="form-control" type="text" name="shipping_address" required
                                        value="@if(Auth::user()){{Auth::user()->Contact->shipping_address}}@endif"
                                    placeholder="আপনার পূর্ণ ঠিকানা লিখুন" style="height: 50px;"> --}}
                                    <textarea id="shipping_address" class="form-control" name="shipping_address"
                                        placeholder="আপনার পূর্ণ ঠিকানা লিখুন" style="height: 100px;" required
                                        placeholder="আপনার পূর্ণ ঠিকানা লিখুন">@if(Auth::user() && Auth::user()->Contact){{Auth::user()->Contact->shipping_address}}@endif</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <center>
                                    <button type="submit"
                                        class="border py-2 px-5 mt-3 rounded text-info text-light px-3"
                                        style="background-color: #ff5c00;font-size: 14px;">Save</button>
                                </center>
                            </div>
                        </div>

                        <br>
                        </form>
                    </div>
                    {{-- End Delivery Address --}}
                    {{-- Start Basic Information Card --}}
                    <div class="card-body basic tab-pane" id="basic-information">
                        <form id="edit-info-customer" action="{{ route('edit') }}" method="POST">
                            @csrf
                            <hr class="mt-2">
                            <div class="row">
                                <div class="col-6 pb-2 font-weight-bold">আপনার নাম:</div>
                                <div class="col-6 pb-2">
                                    {{-- {{$contact->first_name}} --}}
                                    <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}"
                                        name="first_name" placeholder="আপনার নাম লিখুন" />
                                </div>
                                <div class="col-6 pb-2 font-weight-bold">মোবাইল নাম্বার:</div>
                                <div class="col-6 pb-2">
                                    {{-- {{$contact->phone}} --}}
                                    <input class="form-control" type="text" name="mobile"
                                        value="{{Auth::user()->mobile}}" name="phone"
                                        placeholder="মোবাইল নাম্বার লিখুন" />
                                </div>
                                <div class="col-6 pb-2 font-weight-bold">পূর্ণ ঠিকানা :</div>
                                <div class="col-6 pb-2">
                                    {{-- {{$contact->phone}} --}}
                                    <input class="form-control" type="text" name="address"
                                        value="{{Auth::user()->address}}" name="address"
                                        placeholder="আপনার পূর্ণ ঠিকানা লিখুন" />
                                </div>
                                <hr>
                            </div>
                            {{-- <h5 class="card-title">EMAIL ADDRESS</h5>
                                <hr class="mt-2">
                                <div class="row">
                                  <div class="col-6 pb-2 font-weight-bold">Primary Email:</div>
                                  <div class="col-6 pb-2">
                                      <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}"
                            name="email"/>
                    </div>
                    <hr>
                </div> --}}
                <button type="submit" class="float-right border p-1 rounded text-info text-light px-3"
                    style="background-color: #ff5c00;">Save</button>
                <br>
                </form>
            </div>
            {{-- End Basic Information Card --}}
            {{-- Start Address Card --}}
            <div class="card-body basic tab-pane" id="address">
                <h5 class="card-title">Address</h5>
                <hr class="mt-2">
                <div class="row">
                    <div class="col-md-3 font-weight-bold">Full Name</div>
                    <div class="col-md-3 font-weight-bold">Address</div>
                    <div class="col-md-2 font-weight-bold">Region</div>
                    <div class="col-md-2 font-weight-bold">Phone</div>
                    <div class="col-md-2 font-weight-bold">Action</div>
                    <div class="col-12">
                        <hr class="mt-1">
                    </div>
                    <div class="col-md-3 font-weight-bold">Iqbal Hossain</div>
                    <div class="col-md-3 font-weight-bold">Shahbagh, Dhaka</div>
                    <div class="col-md-2 font-weight-bold">Dhaka</div>
                    <div class="col-md-2 font-weight-bold">01700000000</div>
                    <div class="col-md-2 font-weight-bold"></div>
                    <div class="col-12">
                        <hr class="mt-1 mx-5 mt-1">
                    </div>
                </div>
            </div>
            {{-- End Address Card --}}
            {{-- Start Order Card --}}
            <div class="card-body basic tab-pane active" id="order">

                <h5 class="card-title text-center">অর্ডার লিস্ট</h5>
                <div class="row" style="overflow: scroll;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>আইডি</th>
                                <th>তারিখ</th>
                                <th>সর্বমোট</th>
                                <th>অর্ডার স্ট্যাটাস</th>
                                <th>ডিটেইলস</th>
                                {{-- <th>S. Charge</th>
                                <th>Payable</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                            @endphp
                            @if(isset($contact->Order))
                            @foreach ($contact->Order as $order)
                            <tr>
                                <td data-label="আইডি" scope="row">{{$order->code}}</td>
                                <td data-label="তারিখ">{{date('d F Y', strtotime($order->order_date))}}</td>
                                <td data-label="সর্বমোট">
                                    @if($currencySymbol)
                                    <span style="font-size: 14px;">{{ $currencySymbol->symbol }}</span>
                                    @endif
                                    {{$order->total_amount}}
                                </td>
                                <td data-label="অর্ডার স্ট্যাটাস">{{$order->status}}</td>
                                <td>
                                    <center>
                                        <a href="{{ route('order-details', ['id'=>$order->id]) }}" class="btn btn-info"
                                            style="background-color: #ff5c00;;margin-top:5px;padding:0.35em 1.2em;border:0.1em solid #FFFFFF;font-weight:300;color:#FFFFFF;text-align:center;font-weight:bold;"><i
                                                class="fa fa-eye font-size-18" aria-hidden="true"></i></a>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                             @endif
                        </tbody>
                    </table>
                </div>

            </div>
            {{-- End Order Card --}}
            {{-- Start Change Password Card --}}
            <div class="card-body basic tab-pane" id="change-password">
                <h5 class="card-title">পাসওয়ার্ড পরিবর্তন</h5>
                <hr class="mt-2">
                <form id="change-password-customer" action="{{ route('change-password-customer') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input name="oldpassword" id="oldpassword" type="password" class="form-control"
                                placeholder="পূর্বের পাসওয়ার্ড" required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <input name="newpassword" id="newpassword" type="password" class="form-control"
                                placeholder="নতুন পাসওয়ার্ড" required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <input name="password_confirmation" id="password_confirmation" type="password"
                                class="form-control" placeholder="কনফার্ম পাসওয়ার্ড" required />
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button type="submit"
                                    style="background-color: #ff5c00;;margin-top:5px;padding:0.35em 1.2em;border:0.1em solid #FFFFFF;font-weight:300;color:#FFFFFF;text-align:center;font-weight:bold;">Change</button>
                            </center>
                        </div>
                    </div>
                </form>
                <br>
            </div>
            {{-- End Change Password Card --}}
            {{-- Start Transaction Card --}}
            <div class="card-body basic tab-pane" id="transaction">
                <h5 class="card-title">Order</h5>
                <hr class="mt-2">
                <div class="row" style="overflow: scroll;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                            @endphp
                            @foreach ($contacts as $contact)
                            @foreach ($contact->Payment as $payment)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{$payment->date}}</td>
                                <td>@if($payment->PaymentMethod) {{$payment->PaymentMethod->name}} @endif</td>
                                <td>{{$payment->transaction_id}}</td>
                                <td>{{$payment->amount}}</td>
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- End Transaction Card --}}
</div>

{{-- End Card For Basic Information --}}
</div>
{{-- End Right Side --}}
</div>
{{-- End My Account --}}
</div>
</section>
<!-- checkout-area-end -->

</main>
<!-- end row -->

</div>

<script>
    $(document).ready(function(){
		$('#change-password-customer').ajaxForm({
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
    $(document).ready(function(){
		$('#edit-info-customer').ajaxForm({
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    // Start Image Image Preview
    $('#file-input').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

              $('#imagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

    });
    // End Image Preview
  $('#profile_photo_path').ajaxForm({
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
$( "#profile_photo_path" ).change(function() {
    $("#profile-submit-button").css("display", "block");
});
</script>
@endsection
