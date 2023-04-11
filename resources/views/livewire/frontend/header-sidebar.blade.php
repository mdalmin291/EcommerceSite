<div>
    <div class="header-bottom hidden-compact">
        <div class="container">
            <div class="row">

                <div class="bottom1 menu-vertical col-lg-2 col-md-3 col-sm-3">
                    <div class="responsive so-megamenu megamenu-style-dev ">
                        <div class="so-vertical-menu ">
                            <nav class="navbar-default">

                                <div class="container-megamenu vertical">
                                    <div id="menuHeading">
                                        <div class="megamenuToogle-wrapper">
                                            <div class="megamenuToogle-pattern">
                                                <div class="container">
                                                    <div>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                    All Categories
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="navbar-header">
                                        <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                                            <i class="fa fa-bars"></i>
                                            <span>  All Categories1     </span>
                                        </button>
                                    </div>
                                    <div class="vertical-wrapper" >
                                        <span id="remove-verticalmenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div class="container-mega">
                                                <ul class="megamenu">
                                                    @foreach ($categories as $category)

                                                    <li class="item-vertical  with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="#" class="clearfix">
                                                            <img src="{{ asset('supermarke/') }}/image/catalog/menu/icons/ico10.png" alt="Image">
                                                            <span>{{ $category->name }}</span>
                                                            <b class="fa-angle-right"></b>
                                                        </a>
                                                        <div class="sub-menu" data-subwidth="60"  >
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="row">
                                                                            <div class="col-md-4 static-menu">
                                                                                <div class="menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a href="#"  class="main-menu">Apparel</a>
                                                                                            <ul>
                                                                                                @foreach ($category->SubCategory as $subCategory)
                                                                                                    <li><a href="#" >{{ $subCategory->name }}</a></li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    @endforeach
                                                    <li class="loadmore">
                                                        <i class="fa fa-plus-square-o"></i>
                                                        <span class="more-view">More Categories</span>
                                                    </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                        </div>
                    </div>

                </div>

                <!-- Main menu -->
                <div class="main-menu-w col-lg-10 col-md-9">
                    <div class="responsive so-megamenu megamenu-style-dev">
                        <nav class="navbar-default">
                            <div class=" container-megamenu  horizontal open ">
                                <div class="navbar-header">
                                    <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="megamenu-wrapper">
                                    <span id="remove-megamenu" class="fa fa-times"></span>
                                    <div class="megamenu-pattern">
                                        <div class="container-mega">
                                            <ul class="megamenu" data-transition="slide" data-animationtime="250">
                                                <li class="">
                                                    <a href="#" class="clearfix">
                                                        <strong>Home</strong>
                                                    </a>
                                                </li>
                                                <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="" class="clearfix">
                                                        <strong>Features</strong>
                                                        <img class="label-hot" src="" alt="icon items">
                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 100%; right: auto;">
                                                        <div class="content" >
                                                            <div class="row">
                                                                {{-- Start Category List --}}
                                                                <div class="col-md-3">
                                                                    <div class="column">
                                                                        <br>
                                                                        <a href="#" class="title-submenu">Category</a>
                                                                        <div>
                                                                            <ul class="row-list">
                                                                                @foreach($categories as $category)
                                                                                <li><a href="{{route('category_wise_product',['id'=>$category->id])}}">{{ $category->name }} </a></li>
                                                                                @endforeach
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- End Category List --}}
                                                                {{-- Start SubCategory List --}}
                                                                <div class="col-md-3">
                                                                    <div class="column">
                                                                        <a href="#" class="title-submenu">Sub Category</a>
                                                                        <div>
                                                                            <ul class="row-list">
                                                                                @foreach($subCategories as $subCategory)
                                                                                <li><a href="category.html">{{ $subCategory->name }} </a></li>
                                                                                @endforeach
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- End SubCategory List --}}
                                                                {{-- Start SubCategory List --}}
                                                                <div class="col-md-3">
                                                                    <div class="column">
                                                                        <a href="#" class="title-submenu">Sub-sub Category</a>
                                                                        <div>
                                                                            <ul class="row-list">
                                                                                @foreach($subSubCategories as $subSubCategory)
                                                                                <li><a href="category.html">{{ $subSubCategory->name }} </a></li>
                                                                                @endforeach
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- End SubCategory List --}}
                                                                {{-- Start Product List --}}
                                                                <div class="col-md-3">
                                                                    <div class="column">
                                                                        <br>
                                                                        <a href="#" class="title-submenu">Product</a>
                                                                        <div>
                                                                            <ul class="row-list">
                                                                                @foreach($products as $product)
                                                                                <li><a href="{{route('product_view',['id'=>$product->id])}}">{{ $product->name }} </a></li>
                                                                                @endforeach
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- End Product List --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Pages</strong>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 40%; ">
                                                        <div class="content" >
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <ul class="row-list">
                                                                        <li><a class="subcategory_item" href="faq.html">FAQ</a></li>

                                                                        <li><a class="subcategory_item" href="sitemap.html">Site Map</a></li>
                                                                        <li><a class="subcategory_item" href="contact.html">Contact us</a></li>
                                                                        <li><a class="subcategory_item" href="banner-effect.html">Banner Effect</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Categories</strong>
                                                        <img class="label-hot" src="{{ asset('supermarke/') }}/image/catalog/menu/hot-icon.png" alt="icon items">

                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 100%; display: none;">
                                                        <div class="content">
                                                            <div class="row">
                                                                @foreach ($categories as $category)

                                                                <div class="col-md-3">
                                                                    <a href="#"><img src="{{ asset('storage/photo/'.$category->image) }}" alt="banner1"></a>

                                                                    <a href="#" class="title-submenu">{{ $category->name }}</a>
                                                                    <div class="row">
                                                                        <div class="col-md-12 hover-menu">
                                                                            <div class="menu">
                                                                                <ul>
                                                                                    @foreach ($category->SubCategory as $subCategory)
                                                                                    <li><a href="#"  class="main-menu">{{ $subCategory->name  }}</a></li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Accessories</strong>

                                                    </a>

                                                </li>
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="blog-page.html" class="clearfix">
                                                        <strong>Blog</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>


                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- //end Main menu -->

                <div class="bottom3">
                    <div class="telephone hidden-xs hidden-sm hidden-md">
                        <ul class="blank">
                            <li><a href="#"><i class="fa fa-truck"></i>track your order</a></li>
                            <li><a href="#"><i class="fa fa-phone-square"></i>Hotline @if($companyInfo){{ $companyInfo->hotline}} @endif</a></li>
                        </ul>
                    </div>
                    <div class="signin-w hidden-md hidden-sm hidden-xs">
                        <ul class="signin-link blank">
                            <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" href="{{ route('customer_login') }}">Login </a> or <a href="{{ route('customer_register') }}">Register</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
