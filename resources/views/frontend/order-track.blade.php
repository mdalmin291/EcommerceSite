@extends('layouts.front_end')
@section('content')
<div>
    <style>
        .track {
            padding-top: 50px;
        }

        body {
            background-color: #eeeeee;
            font-family: 'Georama', sans-serif;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            /* background-color: #ddd; */
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>


    <x-slot name="title">
        order Track
    </x-slot>
    <x-slot name="header">
        order Track
    </x-slot>
    <main>
        <div class="container">
            <form action="{{route('order-track-result')}}" method="get">
                <div class="track">
                    <div class="input-group">
                        <input name="code" class="form-control" placeholder="Search Code">
                        <button id="search-button" type="submit" class="btn btn-primary btn-sm" style="height: 38px;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
            <article class="card">
                @if (isset($orderstatus))
                <header class="card-header">My Orders / Tracking</header>
                <div class="card-body">
                    <h6>Order Code: @if ($orderstatus) {{ $orderstatus->code }} @endif</h6>
                    <article class="card" style="padding-top: 13px; padding-bottom: 5px;">

                        <div class="col"> <strong>Customer Name:</strong>
                            @if ($orderstatus)
                            {{ $orderstatus->Contact->first_name }}
                            {{ $orderstatus->Contact->last_name }}
                            @endif
                        </div>

                        <div class="col"> <strong>Shipping Address:</strong> @if ($orderstatus){{
                            $orderstatus->Contact->shipping_address }} @endif
                        </div>
                        <div class="col"><strong>Phone Number: </strong> @if ($orderstatus) {{
                            $orderstatus->Contact->mobile }}
                            @endif
                        </div>

                        <div class="col"><strong>Amount To Pay: </strong> @if ($orderstatus) {{
                            $orderstatus->payable_amount }}
                            @endif
                        </div>

                        <div class="col"> <strong>Status: </strong> @if ($orderstatus)
                            @if ($orderstatus->status== "processing")
                            <span class="badge badge-warning">{{ $orderstatus->status }}</span>
                            @endif

                            @if ($orderstatus->status== "pending")
                            <span class="badge badge-info">{{ $orderstatus->status }}</span>
                            @endif

                            @if ($orderstatus->status== "delivered")
                            <span class="badge badge-success">{{ $orderstatus->status }}</span>
                            @endif


                            @if ($orderstatus->status== "returned")
                            <span class="badge badge-secondary">{{ $orderstatus->status }}</span>
                            @endif

                            @if ($orderstatus->status== "cancelled")
                            <span class="badge badge-danger">{{ $orderstatus->status }}</span>
                            @endif

                            @endif
                            </strong>
                            <br>
                        </div>
                </div>
            </article>

            <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i>
                    </span> <span class="text">
                        @if ($orderstatus){{ $orderstatus->status }}@endif</span>
                </div>
            </div>
            @else
            <h6 class="ml-3" style="color: green;">Give order Id in the Seach area</h6>
            @endif
            <a href="{{ url('/') }}" class="btn btn-warning mb-10" data-abc="true"> <i class="fa fa-chevron-left"></i>
                Back to Home</a>
        </div>
    </main>
</div>
@endsection
