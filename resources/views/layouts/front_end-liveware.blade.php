<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @if($companyInfo) {{ $companyInfo->name }} @endif</title>
        <meta name="keywords" content="html5 template, best html5 template, best html template, html5 basic template, multipurpose html5 template, multipurpose html template, creative html templates, creative html5 templates" />
        <meta name="description" content="SuperMarket is a powerful Multi-purpose HTML5 Template with clean and user friendly design. It is definite a great starter for any eCommerce web project." />
        <meta name="author" content="Magentech">
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('venam/') }}/img/favicon.png">
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
    </head>
    <body>
        <!-- preloader  -->
        <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <span data-text-preloader="V" class="letters-loading">
                            V
                        </span>
                        <span data-text-preloader="E" class="letters-loading">
                            E
                        </span>
                        <span data-text-preloader="N" class="letters-loading">
                            N
                        </span>
                        <span data-text-preloader="A" class="letters-loading">
                            A
                        </span>
                        <span data-text-preloader="M" class="letters-loading">
                            M
                        </span>
                    </div>
                </div>
                <div class="loader">
                    <div class="row">
                        <div class="col-3 loader-section section-left">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-left">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-right">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-right">
                            <div class="bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- preloader end -->


		<!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->

        <!-- header-area -->
        @include('livewire.frontend.header')
        <!-- header-area-end -->

        <!-- main-area -->
        {{$slot}}
        <!-- main-area-end -->

        <!-- footer-area -->
        @include('livewire.frontend.footer')
        <!-- footer-area-end -->
		<!-- JS here -->
        <script src="{{ URL::asset('venam/') }}/js/vendor/jquery-3.5.0.min.js"></script>
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
        <script src="{{ URL::asset('venam/') }}/js/main.js"></script>
    </body>
</html>
