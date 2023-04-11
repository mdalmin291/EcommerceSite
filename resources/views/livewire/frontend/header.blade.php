<header class="header-style-two header-style-three">
    <!-- header-top -->
    <div class="header-top-area">
        <div class="custom-container-two">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="header-top-left">
                        <ul>
                            <li>
                                <div class="ship-to">
                                    <span>Language</span>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <img src="img/icon/bng.png" alt=""> BANGLA
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"><img src="{{ URL::asset('venam/') }}/img/icon/bng.png" alt="">BANGLA</a>
                                            <a class="dropdown-item" href="#"><img src="{{ URL::asset('venam/') }}/img/icon/australia.png" alt="">ENGLISH</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="heder-top-guide">
                                    <div class="dropdown">
                                        <button
                                            aria-haspopup="true" aria-expanded="false">
                                            অর্ডার করার নিয়ম
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="heder-top-guide">
                                    <div class="dropdown">
                                        <button
                                            aria-haspopup="true" aria-expanded="false">
                                            অর্ডার ট্র্যাক করুন
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5">
                    <div class="header-top-right">
                        <ul>
                            <li>
                                <a href="{{route('sign-up')}}"><i class="flaticon-user"></i>প্রবেশ / নিবন্ধন</a>
                                <span>বা</span>
                                <a href="{{route('sign-in')}}">আমার একাউন্ট</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-end -->

    <!-- menu-area -->
    <div id="sticky-header" class="main-header menu-area">
        <div class="custom-container-two">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo">
                                <a href="{{url('/')}}"><img src="{{ URL::asset('venam/') }}/img/logo/logo_paikari_red.png" alt="Logo"></a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="active"><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="about">About Us</a></li>
                                    <li class="dropdown"><a href="#">PAGES</a>
                                        <ul class="submenu">
                                            <li><a href="sign-in">My Account</a></li>
                                            <li><a href="error">404 Page</a></li>
                                            <li><a href="terms-conditios">Terms and Conditions</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">SHOP</a>
                                        <ul class="submenu">
                                            <li><a href="category">Shop Left Sidebar</a></li>
                                            <li><a href="product-view">Shop Details</a></li>
                                            <li><a href="wish-list">Wishlist page</a></li>
                                            <li><a href="cart">Cart page</a></li>
                                            <li><a href="checkout">Checkout page</a></li>
                                            <li><a href="order-completed">Order completed</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">SPECIAL</a></li>
                                    <li><a href="{{route('contact-us')}}">contacts</a></li>
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li><a href="#"><i class="flaticon-two-arrows"></i></a></li>
                                    <li><a href="{{route('wish-list')}}"><i class="flaticon-heart"></i></a></li>
                                    <li class="header-shop-cart"><a href="#"><i class="flaticon-shopping-bag"></i><span class="cart-count">2</span></a>
                                        <span class="cart-total-price">$ 128.00</span>
                                        <ul class="minicart">
                                            <li class="d-flex align-items-start">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="{{ URL::asset('venam/') }}/img/product/cart_p01.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="cart-content">
                                                    <h4>
                                                        <a href="#">Charity Nike Brand Yellow T-Shirt</a>
                                                    </h4>
                                                    <div class="cart-price">
                                                        <span class="new">$229.9</span>
                                                        <span>
                                                            <del>$229.9</del>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="del-icon">
                                                    <a href="#">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-start">
                                                <div class="cart-img">
                                                    <a href="#">
                                                        <img src="{{ URL::asset('venam/') }}/img/product/cart_p02.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="cart-content">
                                                    <h4>
                                                        <a href="#">BackPack For School Student</a>
                                                    </h4>
                                                    <div class="cart-price">
                                                        <span class="new">$229.9</span>
                                                        <span>
                                                            <del>$229.9</del>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="del-icon">
                                                    <a href="#">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="total-price">
                                                    <span class="f-left">Total:</span>
                                                    <span class="f-right">$239.9</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkout-link">
                                                    <a href="{{route('cart')}}">Shopping Cart</a>
                                                    <a class="red-color" href="{{route('check-out')}}">Checkout</a>
                                                </div>
                                            </li>
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
                            <div class="nav-logo"><a href="index.html"><img src="{{ URL::asset('venam/') }}/img/logo/white_logo.png" alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
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
        <div class="custom-container-two">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="header-category d-none d-lg-block">
                        <a href="#" class="cat-toggle"><i class="flaticon-menu"></i>ALL DEPARTMENT</a>
                        <ul class="category-menu">
                        @foreach ($categories as $category)
                            <li class="has-dropdown"><a href="{{ route('all-product')}}"><div class="cat-menu-img"><img src="{{ asset('storage/photo/'.$category->image1) }}" alt="" style="width:35px;height:35px;"></div>{{$category->name}}</a>
                                <ul class="mega-menu">
                                    @foreach ($category->SubCategory as $subCategory)
                                    <li>
                                        <ul>
                                            <li class="dropdown-title">{{ $subCategory->name }}</li>
                                            @foreach ($subCategory->SubSubCategory as $subSubCategory)
                                            <li><a href="#">{{$subSubCategory->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                            <li>
                                <ul class="more_slide_open">
                                    <li><a href="#"><div class="cat-menu-img"><img src="{{ URL::asset('venam/') }}/img/product/category_menu_img01.png" alt=""></div> Western woman</a></li>
                                    <li><a href="#"><div class="cat-menu-img"><img src="{{ URL::asset('venam/') }}/img/product/category_menu_img02.png" alt=""></div> Health Product</a></li>
                                    <li><a href="#"><div class="cat-menu-img"><img src="{{ URL::asset('venam/') }}/img/product/category_menu_img03.png" alt=""></div> Industrial Product</a></li>
                                </ul>
                            </li>
                            <li class="more_categories">More Categories<i class="fas fa-angle-down"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <div class="header-search-wrap">
                            <form action="#">
                                <input type="text" placeholder="Search for your item's type.....">
                                <select class="custom-select">
                                    <option selected="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    <option>In All Categories</option>
                                </select>
                                <button><i class="flaticon-magnifying-glass-1"></i></button>
                            </form>
                        </div>
                        <div class="header-free-shopping">
                            <p>Free Shipping on Orders <span>$39+</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-search-area-end -->
</header>
