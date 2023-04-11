@extends('layouts.front_end')
@section('content')
<div>
{{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .btn:hover {
            color: #b3c1ce;
            text-decoration: none;
        }
    </style>


    <x-slot name="title">
        Product Views
    </x-slot>
    <x-slot name="header">
        Product View
    </x-slot>
    <!-- main-area -->
    <main>

        <!-- shop-details-area -->
        <section class="shop-details-area pt-40 pb-20">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-xl-7 col-lg-6">
                        <div class="shop-details-nav-wrap">
                            <div class="shop-details-nav">
                                @foreach ($productDetails->ProductImages as $productImage)
                                <div class="shop-nav-item">
                                    <img src="{{ asset('storage/photo/'.$productImage->image) }}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="shop-details-img-wrap">
                            <div class="shop-details-active">
                                @foreach ($productDetails->ProductImages as $productImage)
                                <div class="shop-details-img">
                                    <a href="{{ asset('storage/photo/'.$productImage->image) }}"
                                        class="popup-image"><img
                                            src="{{ asset('storage/photo/'.$productImage->image) }}" alt=""></a>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="shop-details-content">
                            <h2 style="font-size: 18px;">{{ $productDetails->name }}</h2>
                            <div class="shop-details-price mt-2">
                                <h2 class="m-0 p-0">
                                    @if($productDetails->special_price)
                                    @if($currencySymbol)
                                    <span style="color: #ff0000;"><span
                                            style="font-size: 14px;">{{$currencySymbol->symbol
                                            }}</span>{{$productDetails->special_price}}</span>
                                    @else
                                    <span style="color: #ff0000;">{{$productDetails->special_price}}</span>
                                    @endif
                                    <span style="font-size: 10px;">
                                        <del class="text-danger">
                                            @if($currencySymbol)
                                            <span class="text-dark">
                                                <span style="font-size: 14px;">{{ $currencySymbol->symbol
                                                    }}</span>{{$productDetails->regular_price}}
                                            </span>
                                            @else
                                            <span class="text-dark">
                                                {{$productDetails->regular_price}}
                                            </span>
                                            @endif
                                        </del>
                                    </span>
                                    @else
                                    <span style="font-size: 18px;">
                                        <span class="text-danger">
                                            @if($currencySymbol)
                                            <span class="text-dark">
                                                <span style="font-size: 14px;">{{ $currencySymbol->symbol
                                                    }}</span>{{$productDetails->regular_price}}
                                            </span>
                                            @else
                                            <span class="text-dark">
                                                {{$productDetails->regular_price}}
                                            </span>
                                            @endif
                                        </span>
                                    </span>
                                    @endif
                                    &nbsp;
                                    @if(intval($productDetails->discount)>0)
                                    <span style="font-size: 16px;color: #ff0000;">{ {{ intval($productDetails->discount)
                                        }}%
                                        @if (isset($language->discount))
                                        {{$language->discount}}
                                        @else
                                        discount
                                        @endif
                                        }</span>
                                    @endif
                                </h2>
                                <div>
                                    <div class="mt-1">
                                        <span style="color: black;">Minimum Order: </span>
                                        <span class="badge badge-light"
                                            style="color: red;font-weight: bold;font-size: 12px;">{{$productDetails->min_order_qty}}
                                            &nbsp;
                                            @if (isset($language->unit))
                                            {{$language->unit}}
                                            @else
                                            unit
                                            @endif
                                        </span>

                                        <span class="stock-info m-0 mt-3 ml-2">{{ $productDetails->in_stock }}</span>
                                    </div>
                                </div>
                            </div>
                            <p>@if($productDetails->ProductInfo) {!!$productDetails->ProductInfo->long_description !!}
                                @endif</p>
                            @if($productDetails->in_stock!="Out of Stock")
                            <div class="perched-info mb-0">
                                <div class="cart-plus">
                                    <form action="#">
                                        <div class="cart-plus-minus" data-product-id="{{ $productDetails->id }}"
                                            data-device="desktop">
                                            @php
                                            $productQuantity =
                                            isset($cardBadge['data']['products'][$productDetails->id]['quantity']) ?
                                            $cardBadge['data']['products'][$productDetails->id]['quantity'] : 0;
                                            @endphp
                                            <input type="text" class="product_quantity"
                                                id="product_quantity_{{ $productDetails->id }}"
                                                data-minimum-quantity="{{ $productDetails->min_order_qty }}"
                                                value="{{ $productQuantity ? $productQuantity : $productDetails->min_order_qty }}">
                                        </div>
                                    </form>
                                </div>
                                <a href="javascript:void(0)" class="add-to-card buy-now buy-now-button cartModal"
                                    data-product-id="{{ $productDetails->id }}" style="color: #ff5c00;">
                                    @if($productDetails->in_stock=="Out of Stock")
                                    @if($language->sold_out_button_text)
                                    {{$language->sold_out_button_text}}
                                    @else
                                    Sold Out
                                    @endif
                                    @else
                                    @if (isset($language->sell_button_text))
                                    {{$language->sell_button_text}}
                                    @else
                                    Buy Now
                                    @endif
                                    @endif
                                </a>
                                @php
                                $minimumQuantity = $productDetails->min_order_qty;
                                $orderQuantity = 0;
                                if(isset($cardBadge['data']['products'][$productDetails->id])) {
                                $minimumQuantity =
                                $cardBadge['data']['products'][$productDetails->id]['minimum_order_quantity'];
                                $orderQuantity = $cardBadge['data']['products'][$productDetails->id]['quantity'];
                                }
                                @endphp
                                <a href="javascript:void(0)" class="buy-now buy-now-button cartModal1 btn-mobile-modal"
                                    data-product-id="{{ $productDetails->id }}"
                                    data-product-name="{{ $productDetails->name }}"
                                    data-product-price="{{ $productDetails->special_price }}" {{--
                                    data-product-color="{{$color['color']}}" data-product-size="{{$size['color']}}" --}}
                                    data-product-price="{{ $productDetails->special_price }}"
                                    data-product-color="data-adr" {{-- data-product-size="{{$size['color']}}" --}}
                                    data-product-quantity="{{ $orderQuantity ? $orderQuantity : $minimumQuantity }}"
                                    data-product-minimum-quantity="{{ $minimumQuantity }}"
                                    @if($productDetails->ProductImageFirst)
                                    data-product-image="{{
                                    asset('storage/photo/'.$productDetails->ProductImageFirst->image) }}"
                                    @endif
                                    data-toggle="modal" data-target=".bd-example-modal-sm" style="color: #ff5c00;">
                                    @if($productDetails->in_stock=="Out of Stock")
                                    @if($language->sold_out_button_text)
                                    {{$language->sold_out_button_text}}
                                    @else
                                    Sold Out
                                    @endif
                                    @else
                                    @if (isset($language->sell_button_text))
                                    {{$language->sell_button_text}}
                                    @else
                                    Buy Now
                                    @endif
                                    @endif
                                </a>
                            </div>
                            @endif
                            <div class="shop-details-bottom">

                                <div>
                                    <p class="m-0">
                                        <span class="text-dark">Category : </span>
                                        <span
                                            style="color: #ff0000; font-weight:bold;">@if($productDetails->Category){{$productDetails->Category->name}}@endif</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-dark">Brand:</span>
                                        <span style="color: #ff0000; font-weight:bold;">@if($productDetails->Brand)
                                            {{$productDetails->Brand->name}} @endif</span>
                                    </p>
                                    @if($productDetails->color)
                                    <p class="m-0">
                                        {{-- <label for="color">Color</label>
                                        <select class="select" name="color" id="colors" onchange="myFunction(this)">
                                            <option disabled selected>Choose Color</option>
                                            @foreach ($color as $color)
                                            <option data-adr="{{$color}}" value="id1">{{$color}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" id="myText" type="text" value="-">
                                        <script>
                                            function myFunction(e) {
                                               document.getElementById("myText").value = e.options[e.selectedIndex].getAttribute("data-adr");
                                             }
                                        </script> --}}
                                        <span class="text-dark">Color:</span>
                                        <span style="color: #ff0000; font-weight:bold;
                                               display: flex; margin-left:5px;">
                                            @foreach ($color as $color)
                                            <button style=" position: relative;
                                            display: -webkit-box;
                                            margin-right:7px;
                                            -webkit-box-align: center;
                                            align-items: center;
                                            -webkit-box-pack: center;
                                            justify-content: center;
                                            text-align: center;
                                            color: var(--thm-base);
                                            background-color: #fff;
                                            border-radius: 50%;
                                            font-size: 13px;
                                            height: 45px;
                                            width: 55px;
                                            color:red;
                                            transform: rotate(0);
                                            -webkit-transition: all 500ms ease;
                                            transition: all 500ms ease;
                                            z-index: 1;">{{ $color}}
                                            </button>
                                            @endforeach
                                        </span>
                                    </p>
                                    @endif
                                    @if($productDetails->size)
                                        <span class="text-dark">Size:</span>
                                        <span style="color: #ff0000; font-weight:bold; display: flex; margin-left:5px;">
                                            @foreach ($size as $size)
                                                <button style=" position: relative;
                                                    display: -webkit-box;
                                                    -webkit-box-align: center;
                                                    align-items: center;
                                                    margin-right:7px;
                                                    -webkit-box-pack: center;
                                                    justify-content: center;
                                                    text-align: center;
                                                    color: var(--thm-base);
                                                    background-color: #fff;
                                                    border-radius: 50%;
                                                    font-size: 13px;
                                                    height: 45px;
                                                    width: 45px;
                                                    color:red;
                                                    transform: rotate(0);
                                                    -webkit-transition: all 500ms ease;
                                                    transition: all 500ms ease;
                                                    z-index: 1;">{{ $size}}
                                                </button>
                                            @endforeach
                                        </span>
                                    </p>
                                    
                                    @endif
                                    <div class="social-links pt-2">
                                        <a href="{{$companyInfo->facebook_link}}"><span class="fab fa-facebook-square"
                                                style="font-size: 20px;"></span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{{$companyInfo->youtube_link}}"><span
                                                class="fab fa-youtube" style="font-size: 20px;color: red;"></span></a>
                                    </div>
                                    <p class="m-0">
                                        @if(isset($productDetails->ProductInfo->youtube_link))
                                        <span><i class="fab fa-youtube text-danger"></i></span>
                                        <a href="{{$productDetails->ProductInfo->youtube_link}}">Youtube Link</a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-desc-wrap mb-20">
                            <ul class="nav nav-tabs mb-25" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details"
                                        role="tab" aria-controls="details" aria-selected="true">Product Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="val-tab" data-toggle="tab" href="#val" role="tab"
                                        aria-controls="val" aria-selected="false">Return Policy</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="details" role="tabpanel"
                                    aria-labelledby="details-tab">
                                    <div class="product-desc-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>@if(isset($productDetails->ProductInfo->short_description))
                                                    {!!$productDetails->ProductInfo->short_description!!} @endif</p>
                                                <p>@if(isset($productDetails->ProductInfo->long_description))
                                                    {!!$productDetails->ProductInfo->long_description!!} @endif</p>
                                                <p>@if(isset($productDetails->ProductInfo->meta_description))
                                                    {!!$productDetails->ProductInfo->meta_description!!} @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="val" role="tabpanel" aria-labelledby="val-tab">
                                    <div class="product-desc-content">
                                        <h4 class="title text-center">Return Policy</h4>
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12">

                                                <ul class="product-desc-list">
                                                    <li> {!! $companyInfo->return_policy !!}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="looks" role="tabpanel" aria-labelledby="looks-tab">
                                    <div class="product-desc-content">
                                        <h4 class="title text-center">Product Details</h4>
                                        <div class="row">
                                            <div class="col-xl-3 col-md-4">
                                                <div class="product-desc-img">
                                                    <img src="{{ URL::asset('venam/') }}/img/product/desc_img.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-md-8">
                                                <h5 class="small-title">The Christina Fashion</h5>
                                                <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but also the
                                                    leap into electronic typesetting,
                                                    remaining Lorem
                                                    Ipsum is simply dummy text of the printing and typesetting industry.
                                                    Lorem Ipsum has been the
                                                    industry's standard dummy
                                                    text ever since the 1500s, when an unknown printer took a galley of
                                                    type and scrambled it to make a
                                                    type specimen book.</p>
                                                <ul class="product-desc-list">
                                                    <li>65% poly, 35% rayon</li>
                                                    <li>Hand wash cold</li>
                                                    <li>Partially lined</li>
                                                    <li>Hidden front button closure with keyhole accents</li>
                                                    <li>Button cuff sleeves</li>
                                                    <li>Made in USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="product-desc-content">
                                        <h4 class="title">Product Details</h4>
                                        <div class="row">
                                            <div class="col-xl-3 col-md-4">
                                                <div class="product-desc-img">
                                                    <img src="{{ URL::asset('venam/') }}/img/product/desc_img.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-md-8">
                                                <h5 class="small-title">The Christina Fashion</h5>
                                                <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but also the
                                                    leap into electronic typesetting,
                                                    remaining Lorem
                                                    Ipsum is simply dummy text of the printing and typesetting industry.
                                                    Lorem Ipsum has been the
                                                    industry's standard dummy
                                                    text ever since the 1500s, when an unknown printer took a galley of
                                                    type and scrambled it to make a
                                                    type specimen book.</p>
                                                <ul class="product-desc-list">
                                                    <li>65% poly, 35% rayon</li>
                                                    <li>Hand wash cold</li>
                                                    <li>Partially lined</li>
                                                    <li>Hidden front button closure with keyhole accents</li>
                                                    <li>Button cuff sleeves</li>
                                                    <li>Made in USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="qa" role="tabpanel" aria-labelledby="qa-tab">
                                    <div class="product-desc-content">
                                        <h4 class="title">Product Details</h4>
                                        <div class="row">
                                            <div class="col-xl-3 col-md-4">
                                                <div class="product-desc-img">
                                                    <img src="{{ URL::asset('venam/') }}/img/product/desc_img.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-xl-9 col-md-8">
                                                <h5 class="small-title">The Christina Fashion</h5>
                                                <p>Cramond Leopard & Pythong Print Anorak Jacket In Beige but also the
                                                    leap into electronic typesetting,
                                                    remaining Lorem
                                                    Ipsum is simply dummy text of the printing and typesetting industry.
                                                    Lorem Ipsum has been the
                                                    industry's standard dummy
                                                    text ever since the 1500s, when an unknown printer took a galley of
                                                    type and scrambled it to make a
                                                    type specimen book.</p>
                                                <ul class="product-desc-list">
                                                    <li>65% poly, 35% rayon</li>
                                                    <li>Hand wash cold</li>
                                                    <li>Partially lined</li>
                                                    <li>Hidden front button closure with keyhole accents</li>
                                                    <li>Button cuff sleeves</li>
                                                    <li>Made in USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="related-product-wrap pb-20">
                            <div class="deal-day-top">
                                <div class="deal-day-title">
                                    <h4 class="title">Similar Product</h4>
                                </div>
                                <div class="related-slider-nav">
                                    <div class="slider-nav"></div>
                                </div>
                            </div>
                            <div class="row ">
                                {{-- Start Similar Product --}}
                                @foreach ($data['products'] as $product)
                                <div class="col-xl-2 col-md-2 col-6">
                                    <div class="exclusive-item exclusive-item-three text-center mb-40">
                                        <div class="exclusive-item-thumb">
                                            <a href="{{route('product-details',['id'=>$product['id']])}}">
                                                <img @if($product['product_image_first'])
                                                    src="{{ asset('storage/photo/'.$product['product_image_first']['image']) }}"
                                                    @else src="{{ asset('image-not-available.jpg')}}" @endif
                                                    style="width: 100%;height: auto;" alt="{{$product['name']}}">

                                            </a>
                                            @if($product['special_price'])
                                            @if($product['discount'])
                                            <span class="sd-meta">{{ intval($product['discount']) }}%
                                                @if (isset($language->discount))
                                                {{$language->discount}}
                                                @else
                                                discount
                                                @endif
                                            </span>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="exclusive-item-content">
                                            <h5>
                                                <a href="{{route('product-details',['id'=>$product['id']])}}"
                                                    style="text-transform: capitalize; font-size: 14px;">

                                                    @if(strlen($product['name'])>50)
                                                    {{ substr($product['name'], 0,49).'...' }}
                                                    @else
                                                    {{ $product['name'] }}
                                                    @endif
                                                </a>
                                            </h5>
                                            <div class="exclusive--item--price pb-10">
                                                @if($product['special_price'])
                                                <span class="new-price">
                                                    @if($currencySymbol){{ $currencySymbol->symbol }}@endif{{
                                                    $product['special_price'] }}
                                                </span>
                                                <del class="old-price">
                                                    @if($currencySymbol){{ $currencySymbol->symbol }}@endif{{
                                                    $product['regular_price'] }}
                                                </del>
                                                @else
                                                <span class="old-price">
                                                    @if($currencySymbol){{ $currencySymbol->symbol}}@endif{{
                                                    $product['regular_price'] }}
                                                </span>
                                                @endif
                                            </div>

                                            @php
                                            $minimumQuantity = $product['min_order_qty'];
                                            $orderQuantity = 0;
                                            if(isset($cardBadge['data']['products'][$product['id']])) {
                                            $minimumQuantity =
                                            $cardBadge['data']['products'][$product['id']]['minimum_order_quantity'];
                                            $orderQuantity = $cardBadge['data']['products'][$product['id']]['quantity'];
                                            }
                                            @endphp
                                            <input type="hidden" class="product_quantity"
                                                id="product_quantity_{{ $product['id'] }}"
                                                data-minimum-quantity="{{ $minimumQuantity }}"
                                                value="{{ $orderQuantity ? $orderQuantity : $minimumQuantity }}">
                                            <a href="javascript:void(0)"
                                                class="add-to-card buy-now buy-now-button cartModal"
                                                data-product-id="{{ $product['id'] }}"
                                                @if($product['in_stock']=="Out of Stock" ) style="pointer-events: none;"
                                                @endif style="color: #ff5c00;">
                                                @if($product['in_stock']=="Out of Stock")
                                                @if(isset($language->sold_out_button_text))
                                                {{$language->sold_out_button_text}}
                                                @else
                                                Sold Out
                                                @endif
                                                @else
                                                @if (isset($language->sell_button_text))
                                                {{$language->sell_button_text}}
                                                @else
                                                Buy Now
                                                @endif
                                                @endif
                                            </a>
                                            <a href="javascript:void(0)"
                                                class=" buy-now buy-now-button cartModal1 btn-mobile-modal"
                                                data-product-id="{{ $product['id'] }}"
                                                data-product-name="{{ $product['name'] }}"
                                                data-product-price="{{ $product['special_price'] }}"
                                                data-product-quantity="{{ $orderQuantity ? $orderQuantity : $minimumQuantity }}"
                                                data-product-minimum-quantity="{{ $minimumQuantity }}"
                                                @if($product['product_image_first'])
                                                data-product-image="{{ asset('storage/photo/'.$product['product_image_first']['image']) }}"
                                                @endif data-toggle="modal" data-target=".bd-example-modal-sm"
                                                @if($product['in_stock']=="Out of Stock" ) style="pointer-events: none;"
                                                @endif style="color: #ff5c00;">
                                                @if($product['in_stock']=="Out of Stock")
                                                @if(isset($language->sold_out_button_text))
                                                {{$language->sold_out_button_text}}
                                                @else
                                                Sold Out
                                                @endif
                                                @else
                                                @if (isset($language->sell_button_text))
                                                {{$language->sell_button_text}}
                                                @else
                                                Buy Now
                                                @endif
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{-- End Similar Product --}}
                                <div class="col-md-12">
                                    <center>
                                        @if(isset($product['category_id']))
                                        <a class="btn text-center" style="background: #ff6000;color:white;"
                                            href="{{route('search-category-wise',['id'=>$product['category_id']])}}">
                                            @if($language)
                                            {{$language->more_products}}
                                            @else
                                            See More Products
                                            @endif
                                        </a>
                                        @endif
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="product-reviews-wrap">
                            <div class="deal-day-top">
                                <div class="deal-day-title">
                                    <h4 class="title">Product Reviews</h4>
                                </div>
                            </div>
                            <div class="reviews-count-title">
                                <h5 class="title">{{$total_review}} review for {{$productDetails->name}}</h5>
                            </div>
                            <div class="row">
                                @foreach ($RatingReviews as $RatingReview)
                                <div class="col-lg-6">
                                    <div class="product-review-list blog-comment">
                                        <ul>
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        {{-- <img src="{{ asset($RatingReview->attachment) }}"
                                                            style="height: 10px; width: 10px;" alt="img"> --}}
                                                        <img src="{{ URL::asset('assets/images/avater_logo/avater-logo.png') }}"
                                                            style="height: 30px; width: 30px; margin-top:12px;"
                                                            alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <h5> @if(auth()->user()) {{auth()->user()->name}} @endif
                                                                <span class="comment-date">
                                                                    -{{$RatingReview->created_at->format('d M Y')}}
                                                                </span>
                                                            </h5>
                                                            <div class="rating"
                                                                style="margin-top: 9px; margin-left: 3px;">
                                                                @for($i=1; $i<=$RatingReview->rating; $i++)
                                                                    <i class="fas fa-star"></i>
                                                                    @endfor
                                                            </div>
                                                        </div>
                                                        <p>{{$RatingReview->comments}}</p>
                                                        @if($RatingReview->attachment)
                                                        <img src="{{ asset($RatingReview->attachment) }}"
                                                            style="height: 150px; width: 150px;" alt="img"
                                                            class="img-thumbnail">
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                <br /><br />
                                <div class="pagination-wrapper mt-2">
                                    {{ $RatingReviews->links() }}
                                </div>
                                <div class="col-lg-12">
                                    <div class="product-review-form">
                                        @if(session()->has('message'))
                                        <div class="col-xl-12">
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        </div>
                                        @endif

                                        <form id="messages" method="POST" enctype="multipart/form-data"
                                            action="{{ route('send-review') }}">
                                            @csrf
                                            {{-- <div class="rising-star mb-40">
                                                <h5>Your Rating</h5>
                                                <div class="rising-rating"></div>
                                                <input type="hidden" id="custId" name="rating" value="">
                                            </div> --}}

                                            <div class="col-sm-6">
                                                <label for="message"
                                                    style="margin-top: 13px; font-weight: bolder; font-size: 19px;">YOUR
                                                    REVIEW</label>
                                                <div class="rate" style="padding-left: 0px;">
                                                    <input type="radio" id="star5" class="rate" name="rating"
                                                        value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" checked id="star4" class="rate" name="rating"
                                                        value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" class="rate" name="rating"
                                                        value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" class="rate" name="rating"
                                                        value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                            </div>

                                            <div class="form-grp">
                                                <textarea name="comments" id="message"
                                                    style="height: 124px;"></textarea>
                                            </div>

                                            <input type="hidden" id="custId" name="product_id"
                                                value="{{$productDetails->id}}">

                                            <div class="form-grp">
                                                <label for="message">Attachment</label>
                                                <input type="file" name="attachment" id="fileToUpload">
                                            </div>

                                            <button class="btn">SUBMIT</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-details-area-end -->
    </main>
    <!-- main-area-end dddd -->
</div>
@endsection
@push('script')
<script>

</script>
@endpush
