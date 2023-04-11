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

        #mobileResponsiveFooter {
            display: none;
        }
    </style>
    <x-slot name="title">
        Cart
    </x-slot>
    <x-slot name="header">
        Cart
    </x-slot>
    <!-- main-area -->
    <form action="{{ route('check-out') }}">
        <main>

            <!-- breadcrumb-area -->
            {{-- <section class="breadcrumb-area breadcrumb-bg py-2" data-background="{{ URL::asset('venam/') }}/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Shopping Cart</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            </section> --}}
            <!-- breadcrumb-area-end -->

            <!-- shop-cart-area -->
            <section class="shop-cart-area wishlist-area">
                <div class="text-center py-2 rounded"
                    style="background-color: black;position:fixed;width: 100%; z-index:2;">
                    <a href="{{ route('home') }}" class="float-left">
                        {{-- <i class="fas fa-backspace"
                        style="color: rgb(0, 0, 0);font-size: 30px;"></i> --}}
                        <i class="fas fa-arrow-left pl-1" style="color: white;font-size: 20px;"></i>
                    </a>
                    <span class="mt-1" style="color: white;font-weight: bold;font-size: 20px;">
                        @if (isset($language->cart_page_header_title))
                        {{$language->cart_page_header_title}}
                        @else
                        Shopping Bag
                        @endif
                    </span>
                </div>
                <div class="container pt-50">
                    <div class="row justify-content-center">
                        {{-- For Block In Mobile id="cartForDeskTop" --}}
                        {{-- Start Cart --}}
                        <div class="col-lg-8 mb-1" id="">
                            {{-- <h6 class="text-center" style="color: #ff5c00;">শপিং ব্যাগ</h6> --}}
                            <div class="table-responsive-xl">
                                @php $totalPrice = 0; @endphp
                                @if($cardBadge['data']['products'])
                                @php $totalPrice = $cardBadge['data']['total_price'] @endphp
                                <table class="">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail"></th>
                                            {{-- <th scope="col" class="product-name" style="font-weight: bold;">পণ্য</th> --}}
                                            <th scope="col" class="product-price" style="font-weight: bold;">Price</th>
                                            <th scope="col" class="product-quantity" style="font-weight: bold;">Quantity
                                            </th>
                                            <th scope="col" class="product-subtotal" style="font-weight: bold;">SUBTOTAL
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cardBadge['data']['products'] as $productId => $product)
                                        <tr id="row_{{ $productId }}" style="color: black;">
                                            <td class="product-thumbnail" style="border-style: none;">
                                                <a href="javascript:void(0)" class="wishlist-remove"
                                                    data-product-id="{{ $productId }}"><i
                                                        class="flaticon-cancel-1 text-danger"
                                                        style="font-weight: bold;"></i></a>
                                                <a href="{{ route('product-details',['id'=>$productId]) }}"
                                                    style="float:left;">
                                                    <img @if($product['Info']['image']!='blank-product-image.png' )
                                                        src="{{ asset('storage/photo/'.$product['Info']['image']) }}"
                                                        @else src="{{ asset('image-not-available.jpg') }}" @endif
                                                        style="height: 90px;width:103px;129px;" alt="">
                                                </a>
                                                {{-- </td>
                                                <td class="product-name">
                                                    <h4> --}}
                                                <a href="{{ route('product-details',['id'=>$productId]) }}"
                                                    style="text-transform: capitalize;float: left;color: black;font-weight: bold;">
                                                    @if(strlen($product['Info']['product_name'])>23)
                                                    {{ substr($product['Info']['product_name'], 0,22).'...' }}
                                                    @else
                                                    {{ $product['Info']['product_name'] }}
                                                    @endif
                                                </a>

                                                {{-- </h4> --}}
                                                {{-- <p>Cramond Leopard & Pythong Anorak</p>
                                                    <span>65% poly, 35% rayon</span> --}}
                                            </td>
                                            <td data-label="মূল্য" class="product-price"
                                                style="border-style: none;color: black;">
                                                @if($currencySymbol)
                                                {{ $currencySymbol->symbol }}
                                                @endif
                                                {{ $product['unit_price'] }}
                                            </td>
                                            <td data-label="সংখ্যা" class="product-quantity" style="color: black;">
                                                <div class="cart-plus float-right">
                                                    <form action="#">
                                                        <div class="cart-plus-minus" data-product-id="{{ $productId }}"
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
                                                id="product_subtotal_{{ $productId }}" style="color: black;">
                                                <span style="color: black;">
                                                    @if($currencySymbol)
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
                                    @if(isset($language->no_product_in_shopping_bag_alert_text))
                                    {{$language->no_product_in_shopping_bag_alert_text}}
                                    @else
                                    There is no product added by you!
                                    @endif
                                </div>
                                @endif
                            </div>
                            {{-- <div class="shop-cart-bottom mt-20">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="cart-coupon">
                                            <form action="#">
                                                <input type="text" placeholder="Enter Coupon Code...">
                                                <button class="btn">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="continue-shopping">
                                            <a href="{{route('search-category-wise')}}" class="btn">Continue
                            Shopping</a>
                        </div>
                    </div>
                </div>
</div> --}}
</div>
{{-- End Cart --}}
<div class="col-lg-4 col-md-8">
    <aside class="shop-cart-sidebar pt-3">
        <div class="shop-cart-widget py-0 my-0 pt-1">
            <h6 class="title text-center pt-3" style="font-size: 14px;">
                @if (isset($language->bill_total_title))
                {{$language->bill_total_title}}
                @else
                Bill Total
                @endif
            </h6>
            <ul>
                <li style="color: black;">
                    <span>
                        @if (isset($language->sub_total))
                        {{$language->sub_total}}
                        @else
                        SUBTOTAL
                        @endif
                        :
                    </span>
                    <span class="cart-total-price">
                        @if($currencySymbol)
                        {{ $currencySymbol->symbol }}
                        @endif
                        {{ $totalPrice }}
                    </span>
                </li>
                <li class="py-1" style="color: black;">
                    <span>
                        @if (isset($language->discount))
                        {{$language->discount}}
                        @else
                        Discount
                        @endif
                        :
                    </span>
                    <span class="">
                        @if($currencySymbol)
                        {{ $currencySymbol->symbol }}
                        @endif
                        0
                    </span>
                </li>
                <li class="cart-total-amount pt-2" style="color: black;font-weight: bold;">
                    <span>
                        @if (isset($language->total))
                        {{$language->total}}
                        @else
                        Total
                        @endif
                        :
                    </span>
                    <span class="amount cart-total-price">
                        @if($currencySymbol)
                        {{ $currencySymbol->symbol }}
                        @endif
                        {{ $totalPrice }}
                        <br>
                        <br>
                    </span>
                </li>
            </ul>
            <button class="btn mb-3 btn-hover" id="orderFinishMobile">
                @if (isset($language->cart_page_order_finish_button_text))
                {{$language->cart_page_order_finish_button_text}}
                @else
                Finish Order
                @endif
            </button>
        </div>
    </aside>
</div>
</div>
</div>
</section>
<!-- shop-cart-area-end -->
<button class="btn btn-hover" style="position: fixed;bottom: 0px;right: 0px;width: 100%;background-color:red;"
    id="orderFinish">
    @if (isset($language->cart_page_order_finish_button_text))
      {{$language->cart_page_order_finish_button_text}}
    @else
    Finish Order
    @endif
</button>
</main>
</form>
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
