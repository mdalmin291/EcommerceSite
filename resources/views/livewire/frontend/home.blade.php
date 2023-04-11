@push('css')

@endpush
<div>
    <x-slot name="title">
        Home
    </x-slot>
    <x-slot name="header">
        Home
    </x-slot>
    <main>
        <!-- slider-area -->
        <section class="third-slider-area" data-background="{{ URL::asset('venam/') }}/img/slider/slider_bg.jpg">
            <div class="custom-container-two">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-active">
                            <div class="single-slider slider-bg" data-background="{{ URL::asset('venam/') }}/img/slider/t_slider_bg01.jpg">
                                <div class="slider-content">
                                    <h5 data-animation="fadeInUp" data-delay=".3s">top deal !</h5>
                                    <h2 data-animation="fadeInUp" data-delay=".6s">stylish top <span>handbag</span></h2>
                                    <p data-animation="fadeInUp" data-delay=".9s">Get up to <span>50%</span> off Today Only</p>
                                    <a href="shop-left-sidebar.html" class="btn yellow-btn" data-animation="fadeInUp" data-delay="1s">Shop Now</a>
                                </div>
                                <div class="slider-img" data-animation="fadeInRight" data-delay="1.2s">
                                    <img src="img/slider/t_slider_img01.png" alt="">
                                </div>
                            </div>
                            <div class="single-slider slider-bg" data-background="{{ URL::asset('venam/') }}/img/slider/t_slider_bg02.jpg">
                                <div class="slider-content">
                                    <h5 data-animation="fadeInUp" data-delay=".3s">top deal !</h5>
                                    <h2 data-animation="fadeInUp" data-delay=".6s">stylish <span>headphone</span></h2>
                                    <p data-animation="fadeInUp" data-delay=".9s">Get up to <span>50%</span> off Today Only</p>
                                    <a href="shop-left-sidebar.html" class="btn yellow-btn" data-animation="fadeInUp" data-delay="1s">Shop Now</a>
                                </div>
                                <div class="slider-img" data-animation="fadeInRight" data-delay="1.2s">
                                    <img src="{{ URL::asset('venam/') }}/img/slider/t_slider_img02.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner01.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner02.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner03.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner03.jpg" alt=""></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner03.jpg" alt=""></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/images/top_cat_banner03.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider-area-end -->
        <section class="exclusive-collection pt-100 pb-55">
            <div class="custom-container-two">
                 <!-- exclusive-collection-area -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-60">
                            <span class="sub-title">exclusive collection</span>
                            <h2 class="title">নতুন ইলেকট্রনিক্স পণ্য</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/td_product_img04.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Woman Lathers Jacket</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product02.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Luxury Fashion Bag</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$29.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product03.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/td_product_img05.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Woman Lathers Jacket</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- exclusive-collection-area-end -->
                <!-- testimonial-area -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-60">
                            <h2 class="title">সর্বাধিক বিক্রিত পণ্য</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Farfetch Mulberry Belted</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Farfetch Mulberry Belted</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Farfetch Mulberry Belted</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Farfetch Mulberry Belted</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img01.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/t_exclusive_product01.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Farfetch Mulberry Belted</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$58.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-6">
                        <div class="exclusive-item exclusive-item-three text-center mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="shop-details.html">
                                    <img src="{{ URL::asset('venam/') }}/img/product/td_product_img02.jpg" alt="">
                                    <img class="overlay-product-thumb" src="{{ URL::asset('venam/') }}/img/product/td_product_img05.jpg" alt="">
                                </a>
                                <ul class="action">
                                    <li><a href="#"><i class="flaticon-shuffle-1"></i></a></li>
                                    <li><a href="#"><i class="flaticon-supermarket"></i></a></li>
                                    <li><a href="#"><i class="flaticon-witness"></i></a></li>
                                </ul>
                            </div>
                            <div class="exclusive-item-content">
                                <h5><a href="shop-details.html">Luxury Fashion Bag</a></h5>
                                <div class="exclusive--item--price">
                                    <del class="old-price">$69.00</del>
                                    <span class="new-price">$29.00</span>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- testimonial-area-end -->
            </div>
        </section>
        <!-- furniture-cat-banner -->
        <div class="furniture-cat-banner-area">
            <div class="custom-container-three">
                <div class="row">
                    <div class="col-12">
                        <div class="deal-day-top">
                            <div class="deal-day-title">
                                <h4 class="title">মূল্যপরিশোধ পদ্ধতি</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/payment_method/bkash.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/payment_method/nagad.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/payment_method/rocket.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="top-cat-banner-item mt-30">
                            <a href="shop-left-sidebar.html"><img src="{{ URL::asset('venam/') }}/img/payment_method/shiurcash.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- furniture-cat-banner-end -->
        <!-- core-features -->
        <section class="core-features-area core-features-style-two" id="footerTopMenu">
            <div class="container">
                <div class="core-features-border">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="{{ URL::asset('venam/') }}/img/icon/core_features01.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Free Shipping On Over $ 50</h6>
                                    <span>Agricultural mean crops livestock</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="{{ URL::asset('venam/') }}/img/icon/core_features02.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Membership Discount</h6>
                                    <span>Only MemberAgricultural livestock</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="{{ URL::asset('venam/') }}/img/icon/core_features03.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>Money Return</h6>
                                    <span>30 days money back guarantee</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="core-features-item mb-50">
                                <div class="core-features-icon">
                                    <img src="{{ URL::asset('venam/') }}/img/icon/core_features04.png" alt="">
                                </div>
                                <div class="core-features-content">
                                    <h6>24/7 Support !</h6>
                                    <span>Saving Every Moments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- core-features-end -->
    </main>
</div>
@push('scripts')

@endpush
