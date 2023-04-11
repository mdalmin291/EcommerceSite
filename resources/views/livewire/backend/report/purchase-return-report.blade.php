@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Purchase Return Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Purchase Return Reports</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Select Date</label>
                                <input type="text" name="daterange" id="daterange" class="form-control" placeholder="Enter Date">
                                @error('Date') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Supplier</label>
                                <select type="text" name="Supplier" class="form-control" placeholder="Supplier">
                                    <option value="">Select Supplier</option>
                                    @foreach($Suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name}}</option>
                                    @endforeach
                                </select>
                                @error('Supplier') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Branch</label>
                                <select class="form-control" wire:model.lazy="type">
                                    <option value="">Select Branch</option>
                                    <option value="All">All</option>
                                    <option value="Two Option">Two Option</option>
                                    <option value="Three Option">Three Option</option>
                                    <option value="Four Option">Four Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div wire:ignore class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Purchase Invoice</th>
                                <th>Supplier Name</th>
                                <th>Item Name</th>
                                <th>Qty</th>
                                <th>Purchase Price</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">1</a></td>
                                    <td>2021-Mar-04</td>
                                    <td>Md Suboj</td>
                                    <td>
                                        P5111168
                                    </td>
                                    <td>
                                        Product
                                    </td>
                                    <td>
                                        diadent gp
                                    </td>
                                    <td>
                                        30000
                                    </td>
                                    <td>
                                        400
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="5"><center>Total</center></th>
                                    <th>47600.00</th>
                                    <th>47600.00</th>
                                    <th>47600.00</th>
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

