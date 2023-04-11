@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
       Coupons Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div wire:ignore class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap" style="border-collapse:collapse; border-spacing:0; width:100%;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="search-box mr-2 mb-2 d-inline-block">
                                        <div class="position-relative">
                                            <h4 class="title">Coupons Report</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="basicpill-firstname-input">Start Date</label>
                                            <input id="daterange" type="date" class="form-control" wire:model.lazy="start_date">
                                            @error('Date') <span class="error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="basicpill-firstname-input">End Date</label>
                                            <input id="daterange" type="date" class="form-control" wire:model.lazy="end_date">
                                            @error('Date') <span class="error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="basicpill-firstname-input">Order Status</label>
                                            <select type="text" name="Order" class="form-control" placeholder="Order">
                                            <option value="">All Order</option>
                                            @foreach($orders as $order)
                                            <option value="{{ $order->id }}">{{ $order->name }}</option>
                                            @endforeach
                                            </select>
                                            @error('Order') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="basicpill-firstname-input">Coupon Code</label>
                                            <input class="form-control" wire:model.lazy="type">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                    <h4 style="text-align:center">Coupons Report</h4>
                                    <h5 style="text-align:center">-----------to-----------</h5>
                        

                    </div>
                </div>
            </div>
            <div class="col-xl-12">
               <div class="card">
                    <div class="card-body">
                        <div wire:ignore class="table-responsive">
                            <thead>
                                <tr>
                                    <th>Coupon Name</th>
                                    <th>Coupon Code</th>
                                    <th>Orders</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </div>

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
        <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Init js-->
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush

