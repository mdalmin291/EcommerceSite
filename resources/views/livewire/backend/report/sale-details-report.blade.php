@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Sales Details Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Sales Details Reports</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="basicpill-firstname-input">From Date</label>
                                          <input type="date" class="form-control" wire:model.lazy="from_date"/>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="basicpill-firstname-input">To Date</label>
                                          <input type="date" class="form-control" wire:model.lazy="to_date"/>
                                      </div>
                                    </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Select Customer</label>
                                <select class="form-control" placeholder="Customer" wire:model.lazy="contact_id">
                                    <option>Select Customer</option>
                                    @foreach ($Customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
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
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>

                            </tr>
                            </thead>
                            <tbody>
                                @php $i=0;  $subtotal=0; @endphp
                                @foreach ($saleDetails as $saleDetail)

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a></td>
                                    <td>
                                        @if($saleDetail->SaleInvoice) {{ $saleDetail->SaleInvoice->sale_date }} @endif
                                    </td>
                                    <td>
                                        @if($saleDetail->SaleInvoice->Contact) {{ $saleDetail->SaleInvoice->Contact->first_name }} {{ $saleDetail->SaleInvoice->Contact->last_name }} @endif
                                    </td>
                                    <td>
                                        @if($saleDetail->Product) {{$saleDetail->Product->name}} @endif
                                    </td>

                                    <td>
                                        {{$saleDetail->quantity}}
                                    </td>
                                    <td>
                                        {{ $saleDetail->unit_price }}
                                    </td>
                                    <td>
                                        {{ $saleDetail->unit_price * $saleDetail->quantity }}
                                         @php $subtotal += $saleDetail->unit_price * $saleDetail->quantity @endphp
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="6"><center>Total</center></th>
                                    <th>{{ $subtotal }}</th>

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

