@extends('layouts.front_end')
@section('content')
<div>
    <x-slot name="title">
        Terms & Condition
    </x-slot>
    <x-slot name="header">
        Terms & Condition
    </x-slot>

    <!-- breadcrumb-area -->
    {{-- <section class="breadcrumb-area breadcrumb-bg" data-background="{{ URL::asset('venam/') }}/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2>Terms And Conditions</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Terms And Conditions</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- breadcrumb-area-end -->

    <!-- terms-and-conditions-area -->
    <section class="terms-and-conditions-area pt-20 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($companyInfo) {!! $companyInfo->terms_condition !!} @endif
                </div>
            </div>
        </div>
    </section>
    <!-- terms-and-conditions-area-end -->

</div>
@endsection
