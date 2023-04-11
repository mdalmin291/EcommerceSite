<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> {{$title ?? ''}} | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @livewireStyles

    @include('layouts.head-scripts')

    @livewireScripts

</head>

<body data-sidebar="dark">
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
     {{$slot}}
    <!-- END layout-wrapper -->
    <!-- JAVASCRIPT -->
    @include('layouts.footer-scripts')
</body>
</html>
