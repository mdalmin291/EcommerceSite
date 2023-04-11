@extends('layouts.front_end')
@section('content')
<div>
    <style>
        #headerOneCheckOut,
        #sticky-header,
        #headerThreeCheckout,
        #footerOneCheckOut, #mobileResponsiveFooter {
            display: none;
        }
    </style>
    <x-slot name="title">
        Home
    </x-slot>
    <x-slot name="header">
        Home
    </x-slot>
    <main>


        <!-- order-complete-area -->
        <section class="order-complete-area pt-20 pb-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="order-complete-bg" data-background="img/bg/order_comp_bg.png"
                            style="background-color: rgb(241, 232, 232);">
                            <div class="order-complete-content">
                                <div style="color: black; font-weight: bold;"> Your order has been completed!</div>
                                <div class="pt-2" style="color: black;font-size: 15px;"><span class=""
                                        style="color: red; font-size: 25px;">*</span>Order No - <span
                                        style="color: red; font-weight: bold;">{{$orderCode}}</span></div>
                                <br><br>
                                <div style="color: black;font-weight: bold;">Thanks for your order!
                                </div>
                                <div class="py-0 my-0" style="color: black;">Your order status is processing,we will delivery your order as soon as possible.</div>
                                <a href="{{route('my-account')}}" class="btn" style="background-color: brown;">View Order</a>
                                <a href="{{route('home')}}" class="btn mt-2">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- order-complete-area-end -->
    </main>
</div>


@endsection
