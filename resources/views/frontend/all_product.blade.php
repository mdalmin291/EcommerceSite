@extends('layouts.front_end')
@section('content')
<div>
    <style>
        .buy-now {
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 7px 22px;
            font-size: 16px;
            border-radius: 25px;
            cursor: pointer;
        }

        .buy-now-button:hover {
            background: black;
            color: white;
            font-weight: bold;
        }
    </style>
    <x-slot name="title">
        Product View
    </x-slot>
    <x-slot name="header">
        Product View
    </x-slot>
    <!-- main-area -->
    <!-- main-area -->
    <main>
        <!-- shop-area -->
        <div class="shop-area gray-bg pt-20 pb-0">
            <div class="custom-container-two">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8 order-2 order-lg-0">
                        <aside class="shop-sidebar">
                            <div class="widget shop-widget mb-30" id="productCategoryMobile">
                                <div class="shop-widget-title">
                                    <h6 class="title">Product Categories</h6>
                                </div>
                                <div class="shop-cat-list">
                                    <ul>
                                        @foreach ($categories as $category)

                                        <li><a
                                                href="{{ route('search-category-wise',['id'=>$category->id]) }}">{{$category->name}}</a><span>{{$category->SubCategory->count()}}</span>
                                        </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="widget shop-widget mb-30" id="productSearchMobile">
                                <div class="shop-widget-title">
                                    <h6 class="title">Filter By Price</h6>
                                </div>
                                <div class="price_filter">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                        <span>Price :</span>
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="card widget shop-widget mb-30" id="productNewProductMobile">
                                <div class="shop-widget-title">
                                    <h6 class="title">NEW PRODUCT</h6>
                                    <div class="slider-nav"></div>
                                </div>
                                <div class="sidebar-product-active">
                                    <div class="sidebar-product-list">
                                        <ul>
                                            @foreach ($newProducts as $newProduct)

                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="{{route('product-details',['id'=>$newProduct->id])}}"><img
                                                            @if($newProduct->ProductImageFirst)
                                                        src="{{
                                                        asset('storage/photo/'.$newProduct->ProductImageFirst->image)}}"
                                                        @endif style="width:30px;height:30px;" alt="Image"></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    {{-- <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div> --}}
                                                    <h5>
                                                        <a href="{{route('product-details',['id'=>$newProduct['id']])}}"
                                                            style="text-transform: capitalize;font-size: 12px;">
                                                            @if(strlen($newProduct->name)>20)
                                                            {{ substr($newProduct->name, 0,19).'...' }}
                                                            @else
                                                            {{ $newProduct->name }}
                                                            @endif
                                                        </a>
                                                    </h5>
                                                    <span>
                                                        @if($currencySymbol)
                                                        {{ $currencySymbol->symbol }}
                                                        @endif
                                                        {{ $newProduct->regular_price }}
                                                    </span>
                                                </div>
                                            </li>

                                            @endforeach

                                        </ul>
                                    </div>
                                    {{-- <div class="sidebar-product-list">
                                        <ul>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="shop-details.html"><img
                                                            src="img/product/sidebar_product01.jpg" alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="shop-details.html">Slim Fit Cotton</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="shop-details.html"><img
                                                            src="img/product/sidebar_product02.jpg" alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="shop-details.html">Slim Fit Cotton</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sidebar-product-thumb">
                                                    <a href="shop-details.html"><img
                                                            src="img/product/sidebar_product03.jpg" alt=""></a>
                                                </div>
                                                <div class="sidebar-product-content">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <h5><a href="shop-details.html">Slim Fit Cotton</a></h5>
                                                    <span>$ 39.00</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="widget shop-widget mb-30" id="productBrandMobile">
                                <div class="shop-widget-title">
                                    <h6 class="title">Product Brand</h6>
                                </div>
                                <div class="sidebar-brand-list">
                                    <ul>
                                        @foreach ($brands as $brand)
                                        <li><a
                                                href="{{ route('search-brand-wise',['id'=>$brand->id]) }}">{{$brand->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- <div class="shop-sidebar-size">
                                    <div class="shop-widget-title">
                                        <h6 class="title">Size</h6>
                                    </div>
                                    <div class="shop-size-list">
                                        <ul>
                                            <li><a href="#">S</a></li>
                                            <li><a href="#">M</a></li>
                                            <li><a href="#">L</a></li>
                                            <li><a href="#">XL</a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                                <div class="shop-sidebar-color">
                                    <div class="shop-widget-title">
                                        <h6 class="title">Filter Color</h6>
                                    </div>
                                    <div class="shop-size-list">
                                        <ul>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="shop-widget-banner special-offer-banner">
                                    {{-- <a href="shop-left-sidebar.html"><img src="img/product/sidebar_banner_ad.jpg"
                                            alt=""></a> --}}
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="shop-top-meta mb-40">
                            <p class="show-result">
                                <i class="fas fa-star"></i>
                                Showing Products
                                @if(count($data['products'])>=50)
                                {{count($data['products'])}}
                                @else
                                {{count($data['products'])}}
                                @endif
                                Of {{count($data['products'])}} Result
                            </p>
                            <div class="shop-meta-right" id="productSearchByCustomSelect">
                                <ul>
                                    <li class="active"><a href="#"><i class="flaticon-grid"></i></a></li>
                                    <li><a href="#"><i class="flaticon-list"></i></a></li>
                                </ul>
                                <form action="#">
                                    <select class="custom-select">
                                        <option selected="">Default Sorting</option>
                                        <option>Free Shipping</option>
                                        <option>Best Match</option>
                                        <option>Newest Item</option>
                                        <option>Size A - Z</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($data['products'] as $productId=>$product)
                            <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                                <div class="exclusive-item exclusive-item-three text-center mb-50">
                                    <div class="exclusive-item-thumb">
                                        <a href="{{route('product-details',['id'=>$product['id']])}}">
                                            <img @if(isset($product->ProductImageFirst))
                                            src="{{ asset('storage/photo/'.$product->ProductImageFirst->image)}}"
                                            @else src="{{ asset('image-not-available.jpg')}}" @endif
                                            style="width: 100%;height: auto;" alt="{{$product['name']}}">
                                            {{-- <img class="overlay-product-thumb" @if($product['product_image_last'])
                                                src="{{ asset('storage/photo/'.$product['product_image_last']['image']) }}"
                                                @endif style="height:200px;" alt="{{$product['name']}}"> --}}
                                        </a>
                                        @if($product['special_price'])
                                            @if($product['discount'])
                                                <span class="sd-meta">{{ intval($product['discount']) }}%
                                                    @if(isset($language->discount))
                                                    {{$language->discount}}
                                                    @else
                                                    discount
                                                    @endif
                                                </span>
                                            @endif
                                        @endif
                                        {{-- <ul class="action">
                                            <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                            <li><a href="javascript:void(0)" class="add-to-card"
                                                    data-product-id="{{ $product['id'] }}"><i
                                                        class="flaticon-supermarket"></i></a></li>
                                            <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                        </ul> --}}
                                    </div>
                                    <div class="exclusive-item-content">
                                        <h5>
                                            <a href="{{route('product-details',['id'=>$product['id']])}}"
                                                style="text-transform: capitalize; font-size: 12px;">
                                                @if(strlen($product['name'])>50)
                                                {{ substr($product['name'], 0,49).'...' }}
                                                @else
                                                {{ $product['name'] }}
                                                @endif
                                            </a>
                                        </h5>
                                        <div class="exclusive--item--price pb-10">
                                            @if($product['special_price'])
                        <span class="new-price" style="color:#ff0000;">
                            @if($currencySymbol)
                            <span style="font-size: 14px;">{{ $currencySymbol->symbol }}</span>
                            @endif
                            {{ $product['special_price'] }}
                        </span>
                        <del class="old-price">
                            @if(isset($product['regular_price']))
                            <span class="text-dark"><span style="font-size: 14px;">@if($currencySymbol) {{ $currencySymbol->symbol }} @endif</span> {{ $product['regular_price'] }} </span>
                            @endif
                        </del>
                        @else
                        @if($currencySymbol)
                        <span class="new-price" style="color:#ff0000;">
                            <span style="font-size: 14px;">{{ $currencySymbol->symbol }}
                            @endif
                            {{ $product['regular_price'] }}
                        </span>
                        @endif
                                        </div>
                                        {{-- <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div> --}}
                                        @php
                                        $minimumQuantity = $product['min_order_qty'];
                                        $orderQuantity = 0;
                                        if(isset($cardBadge['data']['products'][$product['id']])) {
                                        $minimumQuantity =
                                        $cardBadge['data']['products'][$product['id']]['minimum_order_quantity'];
                                        $orderQuantity = $cardBadge['data']['products'][$product['id']]['quantity'];
                                        }
                                        @endphp
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
                                            @if(isset($language->sell_button_text))
                                            {{$language->sell_button_text}}
                                            @else
                                            Buy Now
                                            @endif
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)"
                                            class=" buy-now buy-now-button cartModal1 btn-mobile-modal"
                                            data-product-id="{{ $product['id'] }}"
                                            data-product-name="{{ $product['name'] }}" @if(Auth::user())
                                            @if(Auth::user()->Contact->contact_type=='Wholesale')
                                            data-product-price="{{ $product['wholesale_price'] }}" @else
                                            data-product-price="{{ $product['regular_price'] }}" @endif @else
                                            data-product-price="{{ $product['regular_price'] }}" @endif
                                            data-product-quantity="{{ $orderQuantity ? $orderQuantity : $minimumQuantity
                                            }}"
                                            data-product-minimum-quantity="{{ $minimumQuantity }}"
                                            data-product-guarantee="{{ $product['guarantee'] }}"
                                            @if($product['product_image_first'])
                                            data-product-image="{{ asset('storage/photo/'.$product['product_image_first']['image']) }}"
                                            @endif data-toggle="modal" data-target=".bd-example-modal-sm"
                                            @if($product['in_stock']=="Out of Stock" )
                                            style="pointer-events: none;"
                                            @endif
                                            style="color: #ff5c00;">
                                            @if($product['in_stock']=="Out of Stock")
                                            @if(isset($language->sold_out_button_text))
                                            {{$language->sold_out_button_text}}
                                            @else
                                            Sold Out
                                            @endif
                                            @else
                                            @if(isset($language->sell_button_text))
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
                            <div class="col-12">
                                <center>
                                @if(isset($search_type) && isset($search_value))
                                  {{$data['products']->appends([$search_type => $search_value])->links('pagination::bootstrap-4')}}
                                @else
                                  {{$data['products']->links('pagination::bootstrap-4')}}
                                @endif
                                </center>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- shop-area-end -->

    </main>
    <!-- main-area-end -->
    <!-- main-area-end -->
</div>
@endsection
@push('scripts')

@endpush
