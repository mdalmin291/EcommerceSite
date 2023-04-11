@push('css')

<style>
    /* List */
    table.errorlist .counter {
        text-align: right;
    }

    table.errorlist .counter span {
        background-color: #eee;
        border-radius: 2px;
        padding: 1px 5px;
    }

    /* Summaries*/
    table.summaries td {
        padding-right: 40px;
    }

    table.summaries td.critical {
        color: #e6614f;
    }

    table.summaries div.value {
        font-size: 40px;
        margin-top: 10px;
    }

    /* Bar Chart */
    .barchart {
        font-size: 9px;
        line-height: 15px;
        table-layout: fixed;
        text-align: center;
        width: 100%;
        height: 226px;
    }

    .barchart tr:nth-child(1) td {
        vertical-align: bottom;
        height: 200px;
    }

    .barchart .bar {
        background: #0DA58E;
        padding: 0px 2px 0;
    }

    .barchart .bar1 {
        background: #0da547;
        padding: 0px 2px 0;
    }

    .barchart .bar2 {
        background: #e78568;
        padding: 0px 2px 0;
    }

    .barchart .label {
        background-color: black;
        margin-top: -30px;
        padding: 0 3px;
        color: white;
        border-radius: 4px;
    }

    /* Start PI Chart */
    #chartdiv {
        width: 100%;
        height: 245px;
    }

    /* End PI Chart */
</style>

@endpush
<x-app-layout>
    <x-slot name="title">
        {{ __('DASHBOARD') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="rounded">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18 ml-2">Dashboard</h4>
                    <div class="page-title-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card" style="height: 130px;">
                    <div>
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h6>Welcome To</h6>
                                    <h5>@if($companyInfo) {{$companyInfo->name}} @endif</h5>
                                    <ul class="pl-3 mb-0">

                                    </ul>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img @if($companyInfo) src="{{ asset('storage/photo/'.$companyInfo->logo) }}" @endif
                                    style="height:125px;width:100%;background-image: cover;" alt=""
                                    class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card" style="height: 130px;">
                            <div class="card-body">
                                <a href="{{ route('order.order-processing') }}">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs mr-3">
                                            <span
                                                class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                                <i class="bx bx-copy-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Processing Orders</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h2>{{ $orders_count }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="height: 130px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span
                                            class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-archive-in"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Sale Amount(Current Month)</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4>@if($currencySymbol)
                                        <span style="font-size: 22px;">{{ $currencySymbol->symbol }}</span>@endif{{ intval($total_sale_amount) }} <i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card" style="height: 130px;">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span
                                            class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-purchase-tag-alt"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Purchase Amount(Current Month)</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4> @if($currencySymbol)
                                        <span style="font-size: 22px;">{{ $currencySymbol->symbol }}</span>@endif{{ intval($total_purchase_amount) }} <i class="mdi mdi-chevron-up ml-1 text-success"></i></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>

        <div class="row">
            {{-- <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Monthly Order</h4>
                        <div id="bar-charts" dir="ltr"></div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Month Wise Sales (<span style="color: #64979d;">Last 11 Months + Current Month</span>)</h4>
                        {{-- Start Chart --}}
                        <div class="email-container">
                            {{-- <h5>Month Wise Sales</h5> --}}
                            {{-- Start Month Number --}}
                              @php
                                  $transdate = date('m-d-Y', time());
                                  $month = intval(date('m', strtotime($transdate)));
                              @endphp

                            {{-- End Month Number --}}
                            <br />
                            <div class="minwidth">
                                <table class="barchart" cellpadding="1" cellspacing="0">
                                    <tr>
                                        <td title="{{$one}}">
                                            <span class="label">{{intval(($one*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($one*100)/$totalSale)}}%; @if($month == 12) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$two}}">
                                            <span class="label">{{intval(($two*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($two*100)/$totalSale)}}%; @if($month >= 11) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$three}}">
                                            <span class="label">{{intval(($three*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($three*100)/$totalSale)}}%; @if($month >= 10) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$four}}">
                                            <span class="label">{{intval(($four*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($four*100)/$totalSale)}}%; @if($month >= 9) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$five}}">
                                            <span class="label">{{intval(($five*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($five*100)/$totalSale)}}%; @if($month >= 8) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$six}}">
                                            <span class="label">{{intval(($six*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($six*100)/$totalSale)}}%;@if($month >= 7) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$seven}}">
                                            <span class="label">{{intval(($seven*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($seven*100)/$totalSale)}}%; @if($month >= 6) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$eight}}">
                                            <span class="label">{{intval(($eight*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($eight*100)/$totalSale)}}%; @if($month >= 5) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$nine}}">
                                            <span class="label">{{intval(($nine*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($nine*100)/$totalSale)}}%; @if($month >= 4) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$ten}}">
                                            <span class="label">{{intval(($ten*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($ten*100)/$totalSale)}}%; @if($month >= 3) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$eleven}}">
                                            <span class="label">{{intval(($eleven*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($eleven*100)/$totalSale)}}%; @if($month >= 2) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$twelve}}">
                                            <span class="label">{{intval(($twelve*100)/$totalSale)}}%</span>
                                            <div class="bar" style="height:{{intval(($twelve*100)/$totalSale)}}%; @if($month >= 1) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                    </tr>
                                    <tr>

                                        @php
                                            $i = 12;
                                        @endphp

                                        @while ($i > 0)
                                        @php
                                           $i--;
                                           $month1[$i] = date('m', strtotime("-$i month"));
                                           $month_name = date("F", mktime(0, 0, 0, $month1[$i] , 10));
                                        @endphp
                                           <td>{{ substr($month_name, 0, 3) }}</td>
                                        @endwhile

                                    </tr>
                                </table>
                            </div>

                        </div>
                        {{-- End Chart --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title mb-4">Month Wise Sales (<span style="color: #64979d;">Last 11 Months + Current Month</span>)</h4>
                        </div>
                        {{-- Start PI Chart --}}
                        <input id="one" value="{{(($one*100)/$totalSale)}}" hidden />
                        <input id="two" value="{{(($two*100)/$totalSale)}}" hidden />
                        <input id="three" value="{{(($three*100)/$totalSale)}}" hidden />
                        <input id="four" value="{{(($four*100)/$totalSale)}}" hidden />
                        <input id="five" value="{{(($five*100)/$totalSale)}}" hidden />
                        <input id="six" value="{{(($six*100)/$totalSale)}}" hidden />
                        <input id="seven" value="{{(($seven*100)/$totalSale)}}" hidden />
                        <input id="eight" value="{{(($eight*100)/$totalSale)}}" hidden />
                        <input id="nine" value="{{(($nine*100)/$totalSale)}}" hidden />
                        <input id="ten" value="{{(($ten*100)/$totalSale)}}" hidden />
                        <input id="eleven" value="{{(($eleven*100)/$totalSale)}}" hidden />
                        <input id="twelve" value="{{(($twelve*100)/$totalSale)}}" hidden />
                        <div id="chartdiv"></div>
                        {{-- End PI Chart --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Month Wise User Engaged (<span style="color: #64979d;">Last 11 Months + Current Month</span>)</h4>
                        {{-- Start Chart --}}
                        <div class="email-container">
                            {{-- <h5>Month Wise User Engaged</h5> --}}
                            <br />
                            <div class="minwidth">
                                <table class="barchart" cellpadding="1" cellspacing="0">
                                    <tr>
                                        <td title="{{$month_1}}">
                                            <span class="label">{{intval(($month_1*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_1*100)/$totalUser)}}%; @if($month >= 12) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_2}}">
                                            <span class="label">{{intval(($month_2*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_2*100)/$totalUser)}}%; @if($month >= 11) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_3}}">
                                            <span class="label">{{intval(($month_3*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_3*100)/$totalUser)}}%; @if($month >= 10) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_4}}">
                                            <span class="label">{{intval(($month_4*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_4*100)/$totalUser)}}%; @if($month >= 9) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_5}}">
                                            <span class="label">{{intval(($month_5*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_5*100)/$totalUser)}}%; @if($month >= 8) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_6}}">
                                            <span class="label">{{intval(($month_6*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_6*100)/$totalUser)}}%; @if($month >= 7) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_7}}">
                                            <span class="label">{{intval(($month_7*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_7*100)/$totalUser)}}%; @if($month >= 6) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_8}}">
                                            <span class="label">{{intval(($month_8*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_8*100)/$totalUser)}}%; @if($month >= 5) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_9}}">
                                            <span class="label">{{intval(($month_9*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_9*100)/$totalUser)}}%; @if($month >= 4) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_10}}">
                                            <span class="label">{{intval(($month_10*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_10*100)/$totalUser)}}%; @if($month >= 3) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_11}}">
                                            <span class="label">{{intval(($month_11*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_11*100)/$totalUser)}}%; @if($month >= 2) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                        <td title="{{$month_12}}">
                                            <span class="label">{{intval(($month_12*100)/$totalUser)}}%</span>
                                            <div class="bar1" style="height:{{intval(($month_12*100)/$totalUser)}}%; @if($month >= 1) background-color: #5D6D7E; @endif"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                        $i = 12;
                                    @endphp

                                    @while ($i > 0)
                                    @php
                                       $i--;
                                       $month1[$i] = date('m', strtotime("-$i month"));
                                       $month_name = date("F", mktime(0, 0, 0, $month1[$i] , 10));
                                    @endphp
                                       <td>{{ substr($month_name, 0, 3) }}</td>
                                    @endwhile
                                    </tr>
                                </table>
                            </div>

                        </div>
                        {{-- End Chart --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card" style="height: 94%;">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title mb-4">Month Wise Order (<span style="color: #64979d;">Last 11 Months + Current Month</span>)</h4>
                        </div>
                        {{-- Start PI Chart --}}
                        <br />
                        <div class="minwidth">
                            <table class="barchart" cellpadding="1" cellspacing="0">
                                <tr>
                                    <td title="{{$month_1_1}}">
                                        <span class="label">{{intval(($month_1_1*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_1_1*100)/$totalOrder)}}%; @if($month >= 12) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_2_2}}">
                                        <span class="label">{{intval(($month_2_2*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_2_2*100)/$totalOrder)}}%; @if($month >= 11) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_3_3}}">
                                        <span class="label">{{intval(($month_3_3*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_3_3*100)/$totalOrder)}}%; @if($month >= 10) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_4_4}}">
                                        <span class="label">{{intval(($month_4_4*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_4_4*100)/$totalOrder)}}%; @if($month >= 9) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_5_5}}">
                                        <span class="label">{{intval(($month_5_5*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_5_5*100)/$totalOrder)}}%; @if($month >= 8) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_6_6}}">
                                        <span class="label">{{intval(($month_6_6*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_6_6*100)/$totalOrder)}}%; @if($month >= 7) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_7_7}}">
                                        <span class="label">{{intval(($month_7_7*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_7_7*100)/$totalOrder)}}%; @if($month >= 6) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_8_8}}">
                                        <span class="label">{{intval(($month_8_8*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_8_8*100)/$totalOrder)}}%; @if($month >= 5) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_9_9}}">
                                        <span class="label">{{intval(($month_9_9*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_9_9*100)/$totalOrder)}}%; @if($month >= 4) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_10_10}}">
                                        <span class="label">{{intval(($month_10_10*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_10_10*100)/$totalOrder)}}%; @if($month >= 3) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_11_11}}">
                                        <span class="label">{{intval(($month_11_11*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_11_11*100)/$totalOrder)}}%; @if($month >= 2) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                    <td title="{{$month_12_12}}">
                                        <span class="label">{{intval(($month_12_12*100)/$totalOrder)}}%</span>
                                        <div class="bar2" style="height:{{intval(($month_12_12*100)/$totalOrder)}}%; @if($month >= 1) background-color: #5D6D7E; @endif"></div>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    $i = 12;
                                @endphp

                                @while ($i > 0)
                                @php
                                   $i--;
                                   $month1[$i] = date('m', strtotime("-$i month"));
                                   $month_name = date("F", mktime(0, 0, 0, $month1[$i] , 10));
                                @endphp
                                   <td>{{ substr($month_name, 0, 3) }}</td>
                                @endwhile
                                </tr>
                            </table>
                        </div>
                        {{-- End PI Chart --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title mb-4">Top Selling Product</h4>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-centered mb-0">
                                <tbody>
                                    @foreach ($best_Selling_products as $best_Selling_product)
                                    <tr>
                                        <td>
                                            <h5 class="font-size-14 mb-1">@if($best_Selling_product->Product)
                                                {{$best_Selling_product->Product->name}} @endif</h5>
                                            <p class="text-muted mb-0">@if($best_Selling_product->Product)
                                                {{$best_Selling_product->Product->featured}} @endif</p>
                                        </td>
                                        <td>
                                            <div id="radialchart-1" class="apex-charts"></div>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-1">Sales</p>
                                            <h5 class="mb-0">{{ intval(($best_Selling_product->quantity *
                                                100)/$total_quantity)}} %</h5>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Top Five Customer</h4>

                        <div class="mt-4">
                            <div data-simplebar>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered table-hover mb-0">
                                        <tbody>
                                            @foreach ($top_five_customers as $top_five_customer)

                                            <tr>
                                                <td>
                                                    <h5 class="font-size-14 mb-1">
                                                        @if(isset($top_five_customer->SaleInvoice->Contact))
                                                        {{$top_five_customer->SaleInvoice->Contact->first_name}} @endif
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        @if(isset($top_five_customer->SaleInvoice->Contact))
                                                        {{$top_five_customer->SaleInvoice->Contact->mobile}} @endif
                                                    </p>
                                                </td>

                                                <td>
                                                    <div id="radialchart-1" class="apex-charts"></div>
                                                </td>
                                                <td>
                                                    <p class="text-muted mb-1">Buy</p>
                                                    <h5 class="mb-0">{{ intval(($top_five_customer->quantity *
                                                        100)/$total_quantity)}} %</h5>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

        <!-- Chart code -->
        <script>
            am5.ready(function() {

// Create root element
var root = am5.Root.new("chartdiv");


// Set themes
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));

var one=document.getElementById("one").value;
var two=document.getElementById("two").value;
var three=document.getElementById("three").value;
var four=document.getElementById("four").value;
var five=document.getElementById("five").value;
var six=document.getElementById("six").value;
var seven=document.getElementById("seven").value;
var eight=document.getElementById("eight").value;
var nine=document.getElementById("nine").value;
var ten=document.getElementById("ten").value;
var eleven=document.getElementById("eleven").value;
var twelve=document.getElementById("twelve").value;

// Start Current Month
var monthName = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
var d = new Date();
d.setDate(1);
var all_months = [];
for (i=0; i<=11; i++) {
    all_months[i] = monthName[d.getMonth()];
    d.setMonth(d.getMonth() - 1);
}
// End Current Month
// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([
  { value: one, category: all_months[11] },
  { value: two, category: all_months[10] },
  { value: three, category: all_months[9] },
  { value: four, category: all_months[8] },
  { value: five, category: all_months[7] },
  { value: six, category: all_months[6] },
  { value: seven, category: all_months[5] },
  { value: eight, category: all_months[4] },
  { value: nine, category: all_months[3] },
  { value: ten, category: all_months[2] },
  { value: eleven, category: all_months[1] },
  { value: twelve, category: all_months[0] },
]);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);

}); // end am5.ready()
        </script>
    </div>
</x-app-layout>
@push('scripts')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
<!-- plugin js -->


@endpush
