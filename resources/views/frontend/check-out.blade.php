@extends('layouts.front_end')
@section('content')
    <div>
        <style>
            #headerOneCheckOut,
            #sticky-header,
            #headerThreeCheckout,
            #footerOneCheckOut {
                display: none;
            }
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

            #mobileResponsiveFooter {
                display: none;
            }
        </style>
        <x-slot name="title">
            Category
        </x-slot>
        <x-slot name="header">
            Category
        </x-slot>

        <main>

            <form id="checkout" method="POST" action="{{ route('confirm-order') }}" enctype="multipart/form-data"
                class="checkout-form" accept-charset="utf-8">
                <!-- checkout-area -->
                <section class="checkout-area pb-20">
                    <div class="text-center py-2 rounded"
                        style="background-color: black;position: fixed;width: 100%;z-index: 2;">
                        <a href="{{ route('home') }}" class="float-left">
                            {{-- <i class="fas fa-backspace" style="color: rgb(0, 0, 0);font-size: 30px;"></i> --}}
                            <i class="fas fa-arrow-left pl-1" style="color: white;font-size: 20px;"></i>
                        </a>
                        <span class="mt-1" style="color: white;font-weight: bold; font-size: 20px;">
                            @if (isset($language->checkout_page_header_title))
                                {{ $language->checkout_page_header_title }}
                            @else
                                Quick Checkout
                            @endif
                        </span>
                    </div>
                    {{-- <hr class="mb-0 mt-3">
                <br>
                <br> --}}
                    <div class="container pt-40">

                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="checkout-wrap">
                                    <div class="row mt-4">
                                        @if (!Auth::user())
                                            <div class="col-sm-12">
                                                <div class="form-grp">
                                                    <label for="first_name">
                                                        @if (isset($language->your_name_label))
                                                            {{ $language->your_name_label }}
                                                        @else
                                                            Name
                                                        @endif
                                                        <span>*</span>
                                                    </label>
                                                    <input type="text" name="first_name" required
                                                        value="@if (Auth::user()) {{ Auth::user()->name }} @endif"
                                                        placeholder=" @if (isset($language->your_name_placeholder)) {{ $language->your_name_placeholder }} @else Name @endif">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-grp">
                                                    <label for="mobile">
                                                        @if (isset($language->mobile_number_label))
                                                            {{ $language->mobile_number_label }}
                                                        @else
                                                            Mobile Number
                                                        @endif
                                                        <span>*</span>
                                                    </label>
                                                    <input type="text" name="mobile" required
                                                        value="@if (Auth::user()) {{ Auth::user()->mobile }} @endif"
                                                        placeholder="@if (isset($language->your_mobile_number_placeholder)) {{ $language->your_mobile_number_placeholder }} @else Your Mobile Number @endif ">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-grp">
                                                    <label>
                                                        @if (isset($language->zilla_label))
                                                            {{ $language->zilla_label }}
                                                        @else
                                                            Zila
                                                        @endif
                                                        *
                                                    </label>
                                                    <select class="custom-select district" name="district_id" required>
                                                        <option value="">
                                                            @if (isset($language->select_zila_option_text))
                                                                --{{ $language->select_zila_option_text }}--
                                                            @else
                                                                --Select--
                                                            @endif
                                                        </option>
                                                        @foreach ($Districts as $zilla)
                                                            <option value="{{ $zilla->id }}"
                                                                class="district-items division_id_{{ $zilla->division_id }} "
                                                                @if ($zilla->name == 'Dhaka') selected @endif
                                                                style="color:black;">
                                                                {{ $zilla->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-grp">
                                                    <label for="shipping_address">
                                                        @if (isset($language->full_address_label))
                                                            {{ $language->full_address_label }}
                                                        @else
                                                            Full address
                                                        @endif
                                                        *
                                                    </label>

                                                    <textarea id="shipping_address" name="shipping_address"
                                                        placeholder="@if (isset($language->full_address_placeholder)) {{ $language->full_address_placeholder }} @else Full Address @endif"
                                                        required>
                                                         @if (Auth::user()){{ Auth::user()->address }}@endif
                                                    </textarea>
                                                </div>
                                            </div>
                                        @endif
                                        @if (Auth::user())
                                            <div class="col-12 mt-0 mb-0 pb-0 pt-3">
                                                <div class="form-grp mt-0 pt-0">
                                                    <label for="first_name" style="font-weight: bold;">
                                                        @if (isset($language->your_name_label))
                                                            {{ $language->your_name_label }}
                                                        @else
                                                            Your Name
                                                        @endif
                                                    </label>
                                                    <input type="text" name="first_name" required
                                                        value="@if (Auth::user()) @if (Auth::user()->Contact) {{ Auth::user()->Contact->first_name }} @endif @endif"
                                                        placeholder="@if (isset($language->your_name_placeholder)) {{ $language->your_name_placeholder }} @else Your Name @endif"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-0 mb-0 pb-0 pt-0">
                                                <div class="form-grp mt-0 pt-0">
                                                    <label for="district_id" style="font-weight: bold;">
                                                        @if (isset($language->zilla_label))
                                                            {{ $language->zilla_label }}
                                                        @else
                                                            Zilla
                                                        @endif
                                                    </label>
                                                    <select class="custom-select district" name="district_id" required>
                                                        <option value="">
                                                            @if (isset($language->select_zila_option_text))
                                                                --{{ $language->select_zila_option_text }}--
                                                            @else
                                                                --Select--
                                                            @endif
                                                        </option>
                                                        @foreach ($Districts as $zilla)
                                                            <option value="{{ $zilla->id }}"
                                                                class="district-items division_id_{{ $zilla->division_id }} "
                                                                @if (!Auth::user()->Contact->District) @if ($zilla->name == 'Dhaka')
                                                    selected @endif
                                                            @elseif($zilla->name == Auth::user()->Contact->District->name) selected @endif
                                                                style="color:black;">{{ $zilla->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-0 mb-0 pb-0 pt-0">
                                                <div class="form-grp mt-0 pt-0">
                                                    <label for="shipping_address" style="font-weight: bold;">
                                                        @if (isset($language->delivery_address_label))
                                                            {{ $language->delivery_address_label }}
                                                        @else
                                                            Delivery address
                                                        @endif
                                                    </label>
                                                    <textarea id="shipping_address" class="form-control" name="shipping_address"
                                                        placeholder="@if (isset($language->full_address_placeholder)) {{ $language->full_address_placeholder }} @else Full Address @endif"
                                                        required readonly style="background-color: white;">
@if (Auth::user()) @if (Auth::user()->Contact) {{ Auth::user()->Contact->shipping_address }} @endif @endif
</textarea>

                                                </div>
                                            </div>
                                            <div class="col-12 mt-0 pt-0">
                                                <div class="form-grp mt-0 pt-0">
                                                    <label for="mobile" style="font-weight: bold;">
                                                        @if (isset($language->mobile_number_label))
                                                            {{ $language->mobile_number_label }}
                                                        @else
                                                            Mobile
                                                        @endif
                                                    </label>
                                                    <input type="text" name="mobile" required
                                                        value="@if (Auth::user()) @if (Auth::user()->Contact) {{ Auth::user()->Contact->mobile }} @endif @endif"
                                                        placeholder="মোবাইল নাম্বার" readonly>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        {{-- Start Cart Product --}}
                        <h5 class="text-center" style="color: #ff5c00;">
                            @if (isset($language->ordered_product_title))
                                {{ $language->ordered_product_title }}
                            @else
                                Ordered Product
                            @endif
                        </h5>
                        <div class="table-responsive-xl">
                            @php $totalPrice = 0; @endphp
                            @if ($cardBadge['data']['products'])
                                @php $totalPrice = $cardBadge['data']['total_price'] @endphp
                                <table class="" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail"></th>
                                            <th scope="col" class="product-price" style="font-weight: bold;">Price</th>
                                            <th scope="col" class="product-quantity" style="font-weight: bold;">Quantity
                                            </th>
                                            <th scope="col" class="product-subtotal" style="font-weight: bold;">SUBTOTAL
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cardBadge['data']['products'] as $productId => $product)
                                            <tr id="row_{{ $productId }}" style="color: black;">
                                                <td class="product-thumbnail" style="border-style: none;">
                                                    <a href="javascript:void(0)" class="wishlist-remove"
                                                        data-product-id="{{ $productId }}"><i
                                                            class="flaticon-cancel-1 text-danger"
                                                            style="font-weight: bold;"></i></a>
                                                    <a href="{{ route('product-details', ['id' => $productId]) }}"
                                                        style="float:left;">
                                                        <img @if ($product['Info']['image'] != 'blank-product-image.png') src="{{ asset('storage/photo/' . $product['Info']['image']) }}" @else
                                                src="{{ asset('image-not-available.jpg') }}" @endif
                                                            style="height: 90px;width:103px;129px;" alt="">
                                                    </a>

                                                    <a href="{{ route('product-details', ['id' => $productId]) }}"
                                                        style="text-transform: capitalize;float: left;font-weight: bold;color: black;">
                                                        @if (strlen($product['Info']['product_name']) > 23)
                                                            {{ substr($product['Info']['product_name'], 0, 22) . '...' }}
                                                        @else
                                                            {{ $product['Info']['product_name'] }}
                                                        @endif
                                                    </a>

                                                </td>
                                                <td data-label="Price" class="product-price" style="border-style: none;">
                                                    @if ($currencySymbol)
                                                        {{ $currencySymbol->symbol }}
                                                    @endif
                                                    {{ $product['unit_price'] }}
                                                </td>
                                                <td data-label="Rate" class="product-quantity py-0 mt-3 pl-2"
                                                    style="height: 50px;color: black;">
                                                    <div class="cart-plus float-right">
                                                        <form action="#">
                                                            <div class="cart-plus-minus"
                                                                data-product-id="{{ $productId }}"
                                                                data-device="desktop">
                                                                <input type="text"
                                                                    class="product_quantity product-quantity-cart"
                                                                    id="product_quantity_{{ $productId }}"
                                                                    data-product-id="{{ $productId }}"
                                                                    data-minimum-quantity="{{ $product['minimum_order_quantity'] }}"
                                                                    value="{{ $product['quantity'] }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <br>
                                                </td>
                                                <td data-label="SUBTOTAL" class="product-subtotal"
                                                    id="product_subtotal_{{ $productId }}" style="font-weight: bold;">
                                                    <span>
                                                        @if ($currencySymbol)
                                                            {{ $currencySymbol->symbol }}
                                                        @endif
                                                        {{ $product['total_price'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning text-center">
                                    @if (isset($language->no_product_in_shopping_bag_alert_text))
                                        {{ $language->no_product_in_shopping_bag_alert_text }}
                                    @else
                                        There is no product added by you!
                                    @endif
                                </div>
                            @endif
                        </div>
                        {{-- End Cart Product --}}
                    </div>
                    <div class="row p-0 m-0" style="width:100%;">
                        <div class="col-12 pb-3">
                            <div class="shop-cart-widget py-0 my-0 pt-1">
                                <h6 class="title text-center">
                                    @if (isset($language->bill_total_title))
                                        {{ $language->bill_total_title }}
                                    @else
                                        Bill Total
                                    @endif
                                </h6>
                                <ul>
                                    <li class="cart-total-amount pt-2" style="color: black;font-weight: bold;">
                                        <center>
                                            <span id="subTotal">
                                                @if (isset($language->sub_total))
                                                    {{ $language->sub_total }} -
                                                @else
                                                    Subtotal -
                                                @endif
                                            </span>
                                            <span class="amount cart-total-price">
                                                @if ($currencySymbol)
                                                    {{ $currencySymbol->symbol }}
                                                @endif
                                                {{ $totalPrice }}
                                                <br>
                                                <br>
                                            </span>
                                        </center>
                                    </li>
                                    <input type="number" class="form-control" id="current_shipping_charge"
                                        name="current_shipping_charge" hidden>
                                    <li class="cart-total-amount py-1" style="color: black; ">
                                        <center>
                                            <table>
                                                <tbody>
                                                    <tr class="order-shipping">
                                                        <td class="text-left" colspan="2">
                                                            <h6 class="m-b-sm">
                                                                <center>
                                                                    @if (isset($language->shipping_charge_label))
                                                                        {{ $language->shipping_charge_label }}
                                                                    @else
                                                                        Shipping charge
                                                                    @endif
                                                                </center>
                                                            </h6>
                                                            @foreach ($shippingCharges as $shippingCharge)
                                                                <input type="number" class="form-control"
                                                                    id="shipping_charge_{{ $shippingCharge->id }}"
                                                                    data-shipping-id="{{ $shippingCharge->id }}"
                                                                    value="{{ $shippingCharge->shipping_fee }}"
                                                                    name="shipping_charge" hidden>
                                                                <div class="form-group form-group-custom-control">
                                                                    <div class="custom-control custom-radio d-flex">
                                                                        <input type="radio"
                                                                            class="shipping_charge form-control"
                                                                            id="shipping_charge"
                                                                            data-shipping-id="{{ $shippingCharge->id }}"
                                                                            name="radio"
                                                                            style="width: 15px; height: 15px;" required />
                                                                        <label class=""><span
                                                                                style="color:black;">{{ $shippingCharge->title }}</span>
                                                                            (<span
                                                                                style="color: #007bff; font-weight: bold;">৳{{ $shippingCharge->shipping_fee }}</span>)
                                                                        </label>
                                                                    </div>
                                                                    <!-- End .custom-checkbox -->
                                                                </div>
                                                                <!-- End .form-group -->
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <td>
                                                            <h4>
                                                                @if (isset($language->total))
                                                                    {{ $language->total }}
                                                                @else
                                                                    Total
                                                                @endif
                                                            </h4>
                                                        </td>
                                                        <td>
                                                            ৳
                                                            <b class="total-price" id="grandTotal">
                                                                @if (isset($product['total_price']))
                                                                    <span>{{ $cardBadge['data']['total_price'] }}</span>
                                                                @endif
                                                            </b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </center>
                                    </li>
                                </ul>
                                <div class="bank-transfer">
                                    <div class="form-group">
                                        <label for="basicpill-lastname-input" style="color: #ff5c00;;font-weight:bold;"><i
                                                class="fas fa-star" style=></i>Expected Delivery Date And Time</label>
                                        <textarea class="form-control" id="note" name="note" rows="3" wire:model.lazy="note"
                                            placeholder="Expected Delivery Date And Time"></textarea>
                                    </div>

                                </div>
                                <div class="payment-terms py-0 my-0" style="color: black; font-size: 12px;">
                                    * I have read and agree to the website
                                    <a href="{{ route('terms-conditios') }}">terms
                                        and conditions</a>
                                </div>
                                <button class="btn btn-submit mt-2 btn-hover" type="submit" id="orderFinishCheckout">
                                    @if (isset($language->checkout_page_order_done_button_text))
                                        {{ $language->checkout_page_order_done_button_text }}
                                    @else
                                        Place Order
                                    @endif
                                </button>
                                <br>
                                <br>
                            </div>
                            <button class="btn btn-submit btn-hover" type="submit"
                                style="position: fixed;bottom: 0px;right: 0px;width: 100%;background-color:red;z-index:2;"
                                id="orderFinishCheckoutMobile">
                                @if (isset($language->checkout_page_order_done_button_text))
                                    {{ $language->checkout_page_order_done_button_text }}
                                @else
                                    Place Order
                                @endif
                            </button>

                            </aside>
                        </div>
                    </div>
                </section>
                <!-- checkout-area-end -->
            </form>
        </main>
        <!-- end row -->

    </div>
@endsection
@section('script')
    <script>
        $('.shipping_charge').on('change', function() {
            var subTotal = '{{ $cardBadge['data']['total_price'] }}';
            var shippingId = $(this).attr('data-shipping-id');
            var shippingCharge = $('#shipping_charge_' + shippingId).val() || 0;
            document.getElementById('current_shipping_charge').value = shippingCharge;
            $('#shippingChargeShow').html(shippingCharge || 0);
            var totalwithShip = parseFloat(subTotal) + parseFloat(shippingCharge);
            $('#grandTotal').html(totalwithShip || 0);
        });
        $(document).ready(function() {
            $(document).on('change', '.division', function() {
                // console.log("It works");
                $('.district').prop('selectedIndex', 0);
                $('.upazila').prop('selectedIndex', 0);
                let Id = $(this).val();
                // console.log(Id);
                if (Id == 0) {
                    $(".district-items").show();
                } else {
                    $(".district-items").hide();
                    $(".division_id_" + Id).show();
                }
            });
            $(document).on('change', '.district', function() {
                $('.upazila').prop('selectedIndex', 0);
                let Id = $(this).val();
                if (Id == 0) {
                    $(".upazila-items").show();
                } else {
                    $(".upazila-items").hide();
                    $(".district_id_" + Id).show();
                }
            });

            $(document).on('change', '.upazila', function() {
                $('.union').prop('selectedIndex', 0);
                let Id = $(this).val();
                // if (Id == 0) {
                $(".upazila-items").show();
                // } else {
                // $(".union-items").hide();
                $(".upazila_id_" + Id).show();
                // }
            });

        });
    </script>
@endsection
