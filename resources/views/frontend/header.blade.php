@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
<header class="header-style-two header-style-three">
    <!-- header-top -->
    <style>
        .blue {
            background: #ffffff;
        }

        .news {
            /* box-shadow: inset 0 -15px 30px rgba(0,0,0,0.4), 0 5px 10px rgba(0,0,0,0.5); */
            /* width: 890px; */
            margin: 20px auto;
            overflow: hidden;
            border-radius: 4px;
            /* padding: 1px; */
            -webkit-user-select: none;
        }

        a,
        button {
            color: #1d1d1e;
            outline: medium none;
        }

        .news span {
            float: left;
            color: rgb(19, 10, 10);
            padding: 9px;
            position: relative;
            top: 1%;
            /* box-shadow: inset 0 -15px 30px rgba(0,0,0,0.4); */
            font: 16px 'Raleway', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -webkit-user-select: none;
            cursor: pointer;
        }

        @media (min-width: 768px) and (max-width: 1500px) {
            .menu-wrap {
                height: 70px;
            }
        }

        @media (max-width: 1020px) {
            .custom-container-two {
                max-width: 1428px;
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
        }

            .text1 {

                box-shadow: none !important;
                width: 92%;
            }

            .text2 {
                box-shadow: none !important;
                width: 80%;
            }




            .header-style-two .header-category>a {
                padding: 0 30px 0 20px;
                font-size: 14px;
                text-transform: uppercase;
                color: #fff;
                font-weight: 700;

                background-color: <?php if (isset($companyInfo)) {
                    echo $companyInfo->front_end_menu_color;
                }

                ?>;
                font-family: 'Josefin Sans',
                sans-serif;
                display: flex;
                align-items: center;
            }

            @media only screen and (min-width: 768px) {
                #breakingNews {
                    display: none;
                }

                #privacyPolicy,
                #termCondition,
                #aboutUs,
                #sign-in,
                #sign-up,
                #contact-us {
                    display: none;
                }
            }

            .btn-hover {
                background: #ff6000;
                color: white;
            }

            .header-action ul li a {
                color: white;
                font-size: 18px;
            }

            .header-style-two .header-search-wrap form button {
                border: none;
                color: #2d2d2d;
                height: 40px;
                line-height: 40px;
                border-radius: 0 30px 30px 0;

                background-color: <?php if (isset($companyInfo)) {
                    echo $companyInfo->front_end_menu_color;
                }

                ?>;
            }

            .btn-hover:hover {
                font-family: 'Nunito', sans-serif;
                /* font-size: 22px; */
                text-transform: uppercase;
                /* letter-spacing: 1.3px; */
                /* font-weight: 700; */
                color: #313133;
                background: #4FD1C5;
                background: linear-gradient(90deg, rgba(129, 230, 217, 1) 0%, rgba(79, 209, 197, 1) 100%);
                border: none;
                /* border-radius: 1000px; */
                box-shadow: 6px 6px 12px rgba(79, 209, 197, .64);
                transition: all 0.3s ease-in-out 0s;
                cursor: pointer;
                outline: none;
                position: relative;
                /* padding: 10px; */
            }

            /* .header-style-two .navbar-wrap ul li a{
            color: white;
        } */
    </style>
    <div class="header-top-area pb-0" id="headerOneCheckOut">
        <div class="custom-container-two" style="margin-top: -12px;">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="header-top-left">
                        <ul>
                            <li>
                                <div class="heder-top-guide">
                                    <div class="dropdown">
                                        <button aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-phone-alt" style="color: #ff5c00;font-size: 13px;"></i>
                                            <span class="pt-1"
                                                style="font-size: 14px;font-weight: bold;color: #ff5c00;">
                                                @if ($companyInfo)
                                                {{ $companyInfo->hotline }}
                                                @endif
                                            </span>
                                        </button>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5">
                    <div class="header-top-right" style="color: #1d1d1e;">
                        <ul>
                            <li>
                                <a href="@if (isset($profilesettings))
                                     {{ $profilesettings->name }}
                                @endif">
                            </li>
                            <li>
                                <a href="@if($companyInfo->facebook_link){{$companyInfo->facebook_link}}@endif"><span
                                        class="fab fa-facebook-square" style="font-size:15px; color: black;"></span></a>
                            </li>
                            <li>
                                <a href="@if($companyInfo->youtube_link){{$companyInfo->youtube_link}}@endif"><span
                                        class="fab fa-youtube"></span></a>
                            </li>

                            @if (Auth::user())

                            @else
                            <li id="signInSignOut" style="padding-right: 9px;">
                                <a href="{{route('register')}}"><i class="flaticon-user"></i>
                                    @if (isset($language->sign_up))
                                    {{ $language->sign_up }}
                                    @else
                                    Sign Up
                                    @endif
                                </a>
                                <span>Or</span>
                                <a href="{{route('sign-in')}}">
                                    @if (isset($language->sign_in))
                                    {{ $language->sign_in }}
                                    @else
                                    Sign In
                                    @endif
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-end -->

    <!-- menu-area -->
    <div id="sticky-header" class="main-header menu-area mb-0 pb-0 pt-2" style="margin-top: -8px;">
        <div class="custom-container-two">
            <div class="row">
                <div class="col-12 mx-0 px-0" id="responsive-header">
                    <div class="mobile-nav-toggler float-left mt-1 pl-2"><i class="fas fa-bars"></i>&nbsp;</div>
                    {{-- Start Mobile Responsive Search Box --}}
                    <form action="{{ route('product-search') }}" method="GET">
                        <center>
                            <div class="input-group pr-3" id="mobile-response-search-box" style="width: 80%;">
                                <input type="text" class="form-control mb-2" name="search_product_name"
                                    id="search_product_category" style="border-radius: 30px 0px 0px 30px;"
                                    aria-label="Text input with dropdown button"
                                    placeholder="@if (isset($language->product_search)) {{ $language->product_search }} @else Product Search... @endif">
                                <div class="input-group-append mb-2" style="width: 20px;">
                                    <button type="submit"
                                        style="border-radius: 0px 30px 30px 0px;background-color:rgb(27, 27, 29);"><i
                                            class="fa fa-search text-light px-1"></i></button>
                                </div>
                            </div>
                        </center>
                    </form>
                    {{-- End Mobile Responsive Search Box --}}
                    {{-- Start Breaking News --}}
                    <div id="breakingNews" class="news blue my-1 mx-0 px-0"
                        style="height: 38px;border-style: solid;border-color: brown">
                        <span class="pt-1 px-1" style="color: #FFF;background-color: brown;z-index:2;font-weight:bold;">
                            @if (isset($language->beaking_news))
                            {{ $language->beaking_news }}
                            @else
                            News
                            @endif
                        </span>
                        <span class="text2">
                            <marquee scrollamount="5">
                                @foreach ($BreakingNews as $news)
                                <i class="fas fa-star"></i><i class="fas fa-star"><a
                                        style="font-size: 14px;font-family: SolaimanLipi;">{{ $news->news }}</a>
                                    @endforeach
                            </marquee>
                        </span>
                    </div>
                    {{-- End Breaking News --}}
                    <div class="menu-wrap header-menu"
                        style="background-color: <?php if (isset($companyInfo)) {echo $companyInfo->front_end_top_header_color;}?>;">
                        <nav class="menu-nav show">
                            <div class="logo" id="paikaryLogo"
                                style="margin-left: 13px; width: 75px; margin-top: -10px;">
                                <a href="{{url('/')}}"><img
                                        src="@if($companyInfo) {{ asset('storage/photo/'.$companyInfo->logo) }} @endif"
                                        style="height:55.9px;background-image: cover;" alt="Logo"></a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex" style="margin-top: -5px;">
                                <ul class="navigation">
                                    @if (Auth::user())
                                    @if (Auth::user()->hasAnyRole('customer') && Auth::user()->mobile_verified_at)
                                    <li>
                                        <a href="{{ route('my-account') }}">
                                            @if (isset($language->my_account))
                                            {{ $language->my_account }}
                                            @else
                                            My Account
                                            @endif
                                        </a>
                                    </li>
                                    @endif
                                    @endif
                                    <li class="active">
                                        <a href="{{ url('/') }}">
                                            @if (isset($language->home))
                                            {{ $language->home }}
                                            @else
                                            Home
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('search-category-wise') }}">
                                            @if (isset($language->shop_page))
                                            {{ $language->shop_page }}
                                            @else
                                            Shop Page
                                            @endif
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('contact-us') }}">
                                            @if (isset($language->complain_or_opinion))
                                            {{ $language->complain_or_opinion }}
                                            @else
                                            Complain/Opinion
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact-us') }}" id="contact-us">
                                            @if (isset($language->communication))
                                            {{ $language->communication }}
                                            @else
                                            Contact
                                            @endif
                                        </a>
                                    </li>
                                    @if (!Auth::user())
                                    <li id="sign-in"><a href="{{ route('register') }}">Registration</a></li>
                                    <li id="sign-up"><a href="{{ route('sign-in') }}">Login</a></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('privacy-policy') }}" id="privacyPolicy">
                                            @if (isset($language->privacy_policy))
                                            {{ $language->privacy_policy }}
                                            @else
                                            Privacy Policy
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('terms-conditios') }}" id="termCondition">
                                            @if (isset($language->terms_and_condition))
                                            {{ $language->terms_and_condition }}
                                            @else
                                            Rules & Regulations
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}" id="aboutUs">
                                            @if (isset($language->mission_and_vision))
                                            {{ $language->mission_and_vision }}
                                            @else
                                            Mission & Vision
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block" style="margin-top: -7px;">
                                <ul>
                                    <li><a href="{{ route('wish-list') }}"><i class="flaticon-heart"></i></a></li>
                                    <li class="header-shop-cart"><a href="{{ route('cart') }}"><i
                                                class="flaticon-shopping-bag"></i><span class="cart-count"
                                                style="background: #B77032;">{{ $cardBadge['data']['number_of_product']
                                                }}</span></a>
                                        <span class="cart-total-price" style="width: 120px;">
                                            @if ($currencySymbol)
                                            {{ $currencySymbol->symbol }}
                                            @endif
                                            {{ $cardBadge['data']['total_price'] }}
                                        </span>
                                        <ul class="minicart" style="height: 300px;overflow-y: scroll;">
                                            @include('frontend.header-card-popup')

                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="menu-backdrop"></div>
                        <div class="close-btn"><i class="fas fa-times"></i></div>

                        <nav class="menu-box">
                            <div class="nav-logo">
                                <a href="{{ url('/') }}">
                                    <img src="@if ($companyInfo) {{ 'storage/photo/' . $companyInfo->logo }} @endif"
                                        style="height:46px;background-image: cover; width: 56px;" alt="Logo">
                                </a>
                            </div>
                            <div class="menu-outer">
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="{{$companyInfo->facebook_link}}" target="_blank"><span
                                                class="fab fa-facebook-square" style="font-size: 30px;"></span></a></li>
                                    <li><a href="{{$companyInfo->youtube_link}}" target="_blank"><span
                                                class="fab fa-youtube" style="font-size: 30px;"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- menu-area-end -->
    <!-- header-search-area -->
    <div class="header-search-area d-none d-md-block">
        <div class="custom-container-two" id="headerThreeCheckout">
            <div class="row align-items-center px-0" @if (isset($companyInfo)) {{$companyInfo->
                front_end_bottom_header_color}} @endif>
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="header-category d-none d-lg-block">
                        <a href="#" class="cat-toggle"><i class="flaticon-menu"></i>
                            @if (isset($language->menu))
                            {{ $language->menu }}
                            @else
                            Categories
                            @endif
                        </a>
                        <ul class="category-menu" style="z-index: 3;">
                            @foreach ($categories as $category)
                            <li class="has-dropdown">
                                {{-- <a href="{{ route('all-category', ['id' => $category->id]) }}"> --}}
                                    <div class="cat-menu-img"><img
                                            src="{{ asset('storage/photo/' . $category->image1) }}" alt=""
                                            style="width:35px;height:35px;"></div>
                                    {{ $category->name }}
                                {{-- </a> --}}
                                {{-- Start Sub Cat --}}
                                {{-- <div class="mega-menu">
                                    <div class="row">
                                        @foreach ($category->SubCategory as $subCategory)
                                        <div class="col-md-4">
                                            <a
                                                href="{{ route('search-subCategory-wise', ['id' => $subCategory->id]) }}">{{
                                                $subCategory->name }}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div> --}}
                                {{-- End Sub Cat --}}

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <div class="header-search-wrap">
                            <form action="{{ route('product-search') }}" method="GET">
                                <input type="text" name="search_product_name" id="search_product_name"
                                    placeholder="@if (isset($language->product_search)) {{ $language->product_search }} @else Product Search... @endif"
                                    style="width: 90%;">
                                <button type="submit" id="btn-product-search"><i
                                        class="flaticon-magnifying-glass-1"></i></button>
                            </form>

                            {{-- <div style="">
                                <center>
                                    <table class="table" style="width: 67%;
                                        z-index: 99999;
                                        position: absolute;
                                        /* left: 35%; */
                                        /* top: 50px; */
                                        background-color: #ddd;
                                        border-radius: 10px;">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </center>
                            </div> --}}
                        </div>
                        <div class="header-free-shopping">
                            <p style="visibility: hidden;">Free Shipping on Orders
                                @if ($currencySymbol)
                                {{ $currencySymbol->symbol }}
                                @endif
                                39
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Start Breaking News --}}
            <div id="breakingNews1" class="news blue my-1" style="height: 37px;border-style: solid;border-color: brown">
                <span class="pt-1 px-1" style="color: #FFF;background-color: brown;z-index:2;font-weight:bold;">
                    @if (isset($language->beaking_news))
                    {{$language->beaking_news}}
                    @else
                    Latest News
                    @endif
                </span>

                <span class="text1">
                    <marquee scrollamount="5">
                        @foreach ($BreakingNews as $news)
                        <i class="fas fa-star"></i><i class="fas fa-star"><a
                                style="font-size: 12px;font-family: SolaimanLipi;">{{$news->news}}</a>
                            @endforeach
                    </marquee>
                </span>
            </div>
            {{-- End Breaking News --}}
        </div>
    </div>
    <!-- header-search-area-end -->
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script> --}}
<script>
    //         $('#search').on('keyup', function(){
//     search();
// });
// search();
// function search(){
//     var keyword = $('#search').val();
//     $.post('{{ route("product-search") }}',
//     {
//         _token: $('meta[name="csrf-token"]').attr('content'),
//               keyword:keyword
//     },
//     function(data){
//         table_post_row(data);
//         // console.log(data);
//     });
// }
// // table row with ajax
// function table_post_row(res){
// let htmlView = '';
// if(res.product_searchess.length <= 0){
//     htmlView+= `
//     <tr>
//         <td colspan="4">Woops! Product Not Found.</td>
//     </tr>`;
// }else{
//     for(let i = 0; i < res.product_searchess.length; i++){
//   htmlView += `
//   <tr>
//     <td><a style="color: #000;" href="{{ route('product-details') }}/`+res.product_searchess[i].id+`">`+res.product_searchess[i].name+`</a></td>
//     <td><a href="{{ route('product-details') }}/`+res.product_searchess[i].id+`"><img src="`+res.product_searchess[i].image+`"/></a></td>
//   </tr>`;
// }
// }


// $('tbody').html(htmlView);
// }
    $(document).ready(function() {
        $('#btn-product-search').on('click', function() {

        });
    });
</script>
