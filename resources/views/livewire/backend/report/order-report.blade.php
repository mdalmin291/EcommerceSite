@push('css')
<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Order Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Order Reports</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">From Date</label>
                                <input type="date" class="form-control" wire:model.lazy="from_date" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">To Date</label>
                                <input type="date" class="form-control" wire:model.lazy="to_date" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order Code</th>
                                    <th>Business Name</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                $total=0;
                                @endphp
                                @foreach ($this->dateFilter($orders) as $order)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a>
                                    </td>
                                    <td>
                                        {{ $order->code }}
                                    </td>
                                    <td>
                                        @if($order->Contact)
                                           {{ $order->Contact->business_name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{date('d F Y', strtotime($order->date))}}
                                    </td>
                                    <td>
                                        {{ $order->payable_amount }}
                                        @php
                                        $total += $order->payable_amount;
                                        @endphp
                                    </td>
                                    <td>
                                        {{ $order->status }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        <center>Total</center>
                                    </th>
                                    <th>{{$total}}</th>
                                    <th></th>
                                    {{--                                <th>47600.00</th>--}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
</script>
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
{{--    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>--}}
{{--    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>--}}

<!-- Init js-->
{{--    <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>--}}

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- Sweet alert init js -->
<script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush
