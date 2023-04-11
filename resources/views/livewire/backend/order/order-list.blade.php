@push('css')
    <style>
        .table-responsive-stack tr {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
        }


        .table-responsive-stack td,
        .table-responsive-stack th {
            display: block;
            /*
       flex-grow | flex-shrink | flex-basis   */
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
        }

        .table-responsive-stack .table-responsive-stack-thead {
            font-weight: bold;
        }

        @media screen and (max-width: 768px) {
            .table-responsive-stack tr {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                border-bottom: 3px solid #ccc;
                display: block;

            }

            /*  IE9 FIX   */
            .table-responsive-stack td {
                float: left\9;
                width: 100%;
            }
        }
    </style>
@endpush
<div>
    <x-slot name="title">
        Order List
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Order List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <a href="{{ route('inventory.sale') }}">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                                            class="mdi mdi-plus mr-1"></i>New Order
                                    </button>
                                </a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">From Date</label>
                                <input type="date" class="form-control" wire:model.debounce.150ms="from_date" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">To Date</label>
                                <input type="date" class="form-control" wire:model.debounce.150ms="to_date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Select Supplier</label>
                                <select class="form-control" placeholder="Customer" wire:model.lazy="order_status">
                                    <option value="">Status</option>
                                    <option value="processing">Processing
                                    </option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="returned">Returned</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Search Order</label>
                                <input type="text" class="form-control" wire:model.debounce.150ms="search_order"
                                    placeholder="Search Order" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 table-nowrap table-responsive-stack"
                                        id="tableOne">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Shop Name</th>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Order Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp

                                            @foreach ($this->dateFilter($orders) as $order)
                                                <tr>
                                                    <td>
                                                        <a href="javascript: void(0);"
                                                            class="text-body font-weight-bold">{{ ++$i }}</a>
                                                    </td>
                                                    <td>
                                                        @if ($order->Contact)
                                                            {{ $order->Contact->business_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->Contact)
                                                            {{ $order->Contact->first_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->Contact)
                                                            {{ $order->Contact->shipping_address }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ date('d F Y', strtotime($order->order_date)) }}<br>
                                                        {{ date('h:i A', strtotime($order->order_date)) }}
                                                    </td>
                                                    <td>
                                                        {{ $order->payable_amount }}
                                                    </td>
                                                    <td>
                                                        {{ $order->status }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm btn-block mb-1"
                                                            href="{{ route('order.order-invoice', ['id' => $order->id]) }}"><i
                                                                class="fas fa-eye font-size-18"></i></a>
                                                        <div wire:ignore>
                                                            {{-- @can('edit all_order') --}}
                                                                @if ($order->status != 'delivered')
                                                                    <select class="form-control"
                                                                        style="border-radius: 15px;background-color:rgb(229, 240, 219);"
                                                                        wire:model.lazy="status" wire:change="OrderStatus">
                                                                        <option value="">Status</option>
                                                                        <option value="processing {{ $order->id }}">
                                                                            Processing
                                                                        </option>
                                                                        <option value="shipped {{ $order->id }}">Shipped
                                                                        </option>
                                                                        <option value="delivered {{ $order->id }}">
                                                                            Delivered</option>
                                                                        <option value="returned {{ $order->id }}">
                                                                            Returned</option>
                                                                        <option value="cancelled {{ $order->id }}">
                                                                            Cancelled</option>
                                                                    </select>
                                                                @endif
                                                            {{-- @endcan --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $orders->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function() {


                    // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
                    $('.table-responsive-stack').each(function(i) {
                        var id = $(this).attr('id');
                        //alert(id);
                        $(this).find("th").each(function(i) {
                            $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend(
                                '<span class="table-responsive-stack-thead">' + $(this).text() +
                                ':</span> ');
                            $('.table-responsive-stack-thead').hide();

                        });
                    });
                    $('.table-responsive-stack').each(function() {
                        var thCount = $(this).find("th").length;
                        var rowGrow = 100 / thCount + '%';
                        //console.log(rowGrow);
                        $(this).find("th, td").css('flex-basis', rowGrow);
                    });




                    function flexTable() {
                        if ($(window).width() < 768) {

                            $(".table-responsive-stack").each(function(i) {
                                $(this).find(".table-responsive-stack-thead").show();
                                $(this).find('thead').hide();
                            });


                            // window is less than 768px
                        } else {


                            $(".table-responsive-stack").each(function(i) {
                                $(this).find(".table-responsive-stack-thead").hide();
                                $(this).find('thead').show();
                            });



                        }
                        // flextable
                    }

                    flexTable();

                    window.onresize = function(event) {
                        flexTable();
                    };

                });
            </script>
            <script>
                $(document).ready(function() {


                    // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
                    $('.table-responsive-stack').each(function(i) {
                        var id = $(this).attr('id');
                        //alert(id);
                        $(this).find("th").each(function(i) {
                            $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend(
                                '<span class="table-responsive-stack-thead">' + $(this).text() +
                                ':</span> ');
                            $('.table-responsive-stack-thead').hide();

                        });



                    });





                    $('.table-responsive-stack').each(function() {
                        var thCount = $(this).find("th").length;
                        var rowGrow = 100 / thCount + '%';
                        //console.log(rowGrow);
                        $(this).find("th, td").css('flex-basis', rowGrow);
                    });




                    function flexTable() {
                        if ($(window).width() < 768) {

                            $(".table-responsive-stack").each(function(i) {
                                $(this).find(".table-responsive-stack-thead").show();
                                $(this).find('thead').hide();
                            });


                            // window is less than 768px
                        } else {


                            $(".table-responsive-stack").each(function(i) {
                                $(this).find(".table-responsive-stack-thead").hide();
                                $(this).find('thead').show();
                            });



                        }
                        // flextable
                    }

                    flexTable();

                    window.onresize = function(event) {
                        flexTable();
                    };

                });
            @endpush
