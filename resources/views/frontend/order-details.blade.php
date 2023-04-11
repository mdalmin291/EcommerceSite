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

        @media only screen and (min-width: 768px) {
            #cartForMobile {
                display: none;
            }
        }

        @media only screen and (max-width: 768px) {

            #cartForDeskTop,
            #headerOneCheckOut,
            #sticky-header,
            #headerThreeCheckout {
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

        #headerOneCheckOut,
        #sticky-header,
        #headerThreeCheckout,
        #footerOneCheckOut {
            display: none;
        }

        @media only screen and (min-width: 768px) {
            #cartForMobile {
                display: none;
            }
        }

        @media only screen and (max-width: 768px) {

            #cartForDeskTop,
            #headerOneCheckOut,
            #sticky-header,
            #headerThreeCheckout {
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

        /* #mobileResponsiveFooter {
            display: none;
        } */
    </style>
    <x-slot name="title">
        Cart
    </x-slot>
    <x-slot name="header">
        Cart
    </x-slot>
    <!-- main-area -->
    <main>



        <!-- shop-cart-area -->
        <section class="shop-cart-area wishlist-area">
            <div class="text-center py-2 rounded"
                style="background-color: black;position:fixed;width: 100%; z-index:2;">
                <a href="{{ route('home') }}" class="float-left">
                    {{-- <i class="fas fa-backspace"
                        style="color: rgb(0, 0, 0);font-size: 30px;"></i> --}}
                    <i class="fas fa-arrow-left pl-1" style="color: white;font-size: 20px;"></i>
                </a>
                <span class="mt-1" style="color: white;font-weight: bold;font-size: 20px;">Order Details</span>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="@if($InvoiceSetting) {{ asset('storage/photo/'.$InvoiceSetting->logo)}}@endif"
                                            alt="logo" style="height:40px;float: left;" />
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="float-right font-size-16 mt-4 mt-md-0">
                                            অর্ডার আইডি # {{$order->code}}<br>
                                            তারিখ: {{date('d F Y', strtotime($order->order_date))}}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0 pt-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address style="font-size: 15px;">
                                        {{-- <strong>Billed To:</strong><br>
                                        {{$order->Contact->business_name}}<br>
                                        {{$order->Contact->shipping_address}},@if($order->Contact->District){{($order->Contact->District->name)}}@endif<br>
                                        {{$order->Contact->mobile}}<br> --}}
                                        <div class="font-weight:bold;" style="color: black;">অর্ডার স্ট্যাটাস: <span
                                                style="text-transform: capitalize;font-weight: bold; color: red; font-size: 16px;">{{$order->status}}</span>
                                        </div>
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-right">
                                    <address class="" style="font-size: 15px;">
                                        <strong>ডেলিভারি এড্রেস :</strong><br>
                                        {{$order->Contact->business_name}}<br>
                                        {{$order->Contact->shipping_address}},@if($order->Contact->District){{($order->Contact->District->name)}}@endif<br>
                                        {{$order->Contact->mobile}}<br>
                                    </address>
                                </div>
                            </div>
                            <table class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">SL.</th> --}}
                                        {{-- <th scope="col">Order No.</th> --}}
                                        {{-- <th scope="col">Date</th> --}}
                                        <th scope="col">প্রডাক্ট</th>
                                        <th scope="col">পিকচার</th>
                                        <th scope="col">সংখ্যা</th>
                                        <th scope="col">প্রাইস</th>
                                        <th scope="col">সাবটোটাল</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;$sum=0;
                                    @endphp
                                    @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        {{-- <th scope="row">{{++$i}}</th> --}}
                                        {{-- <td>
                                    {{date('d F Y', strtotime($order->order_date))}}
                                        </td> --}}
                                        <td class="text-center" style="font-weight: bold;color: black;">
                                            @if($orderDetail->Product)
                                            {{$orderDetail->Product->name}}
                                            @endif
                                        </td>
                                        <td>
                                            <center>
                                                <img class="rounded" @if($orderDetail->Product->ProductImageFirst)
                                                src="{{ asset('storage/photo/'.$orderDetail->Product->ProductImageFirst->image)}}"
                                                @endif style="height:100px; weight:100px;" alt="Image2" class="img-circle
                                                img-fluid">
                                            </center>
                                        </td>
                                        <td data-label="সংখ্যা">
                                            {{$orderDetail->quantity}}
                                        </td>
                                        <td data-label="প্রাইস">
                                            @if($currencySymbol)
                                            {{$currencySymbol->symbol}}
                                            @endif
                                            {{$orderDetail->unit_price}}
                                            @php
                                            $sum += ($orderDetail->quantity* $orderDetail->unit_price);
                                            @endphp
                                        </td>
                                        <td data-label="সাবটোটাল" style="color: red;font-weight: bold;">
                                            @if($currencySymbol)
                                            {{$currencySymbol->symbol}}
                                            @endif
                                            {{$orderDetail->quantity * $orderDetail->unit_price}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="float-right mr-5"
                                        style="font-size: 18px;font-weight: bold; color: black;">সর্বমোট বিল:
                                        @if($currencySymbol)
                                        {{$currencySymbol->symbol}}
                                        @endif
                                        {{$sum}}
                                    </span>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-cart-area-end -->

    </main>
    @endsection
    <!-- main-area-end -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            });
    </script>
</div>
@push('scripts')

@endpush
