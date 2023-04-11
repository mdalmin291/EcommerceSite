@extends('layouts.front_end')
@section('content')
    <!-- main-area -->
    <main>
        <!-- CSS here -->
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/animate.min.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/magnific-popup.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/jquery-ui.min.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/flaticon.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/odometer.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/aos.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/slick.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/default.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/style.css">
        <link rel="stylesheet" href="{{ URL::asset('venam/') }}/css/responsive.css">

        <!-- exclusive-collection-area -->
        <section class="exclusive-collection pt-100 pb-60">
            <div class="container">
                <div class="row exclusive-active">
                    @foreach ($subCategories_search as $subCategory)
                    <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two cat-three">
                        <div class="exclusive-item exclusive-item-two mb-40">
                            <div class="exclusive-item-thumb">
                                <a href="{{ route('search-subCategory-wise',['id'=>$subCategory->id]) }}">
                                    <img src="{{ asset('storage/photo/'.$subCategory->image) }}" style="height: 250px;" alt="">
                                    <img class="overlay-product-thumb" src="{{ asset('storage/photo/'.$subCategory->image) }}" style="height: 250px;" alt="">
                                </a>
                            </div>
                            <div class="exclusive-item-content">
                                <div class="exclusive--content--top">
                                    <div class="tag">
                                        <a href="{{ route('search-subCategory-wise',['id'=>$subCategory->id]) }}">
                                            {{$subCategory->name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- exclusive-collection-area-end -->

        <!-- JS here -->
        {{-- <script src="{{ URL::asset('venam/') }}/js/vendor/jquery-3.5.0.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/popper.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/isotope.pkgd.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/imagesloaded.pkgd.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/jquery.magnific-popup.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/owl.carousel.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/jquery.odometer.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/jquery.countdown.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/jquery.appear.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/slick.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/ajax-form.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/wow.min.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/aos.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/plugins.js"></script>
        <script src="{{ URL::asset('venam/') }}/js/main.js"></script> --}}
    </main>
    <!-- main-area-end -->
@endsection
