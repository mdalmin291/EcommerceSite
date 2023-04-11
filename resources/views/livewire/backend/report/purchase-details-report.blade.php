@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Purchase Detail Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Purchase Detail Report</h4>
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
                                <label for="basicpill-firstname-input">Select Supplier</label>
                                <select class="form-control" placeholder="Customer" wire:model.lazy="contact_id">
                                    <option>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
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
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>

                            </tr>
                            </thead>
                            <tbody>
                                @php $i=0;  $subtotal=0; @endphp
                                @foreach ($purchaseDetails as $purchaseDetail)

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a></td>
                                    <td>
                                        @if($purchaseDetail->PurchaseInvoice) {{ $purchaseDetail->PurchaseInvoice->purchase_date }} @endif
                                    </td>
                                    <td>
                                        @if($purchaseDetail->PurchaseInvoice->Contact) {{ $purchaseDetail->PurchaseInvoice->Contact->first_name }} {{ $purchaseDetail->PurchaseInvoice->Contact->last_name }} @endif
                                    </td>
                                    <td>
                                        @if($purchaseDetail->Product) {{$purchaseDetail->Product->name}} @endif
                                    </td>

                                    <td>
                                        {{$purchaseDetail->quantity}}
                                    </td>
                                    <td>
                                        {{ $purchaseDetail->unit_price }}
                                    </td>
                                    <td>
                                        {{ $purchaseDetail->unit_price * $purchaseDetail->quantity }}
                                         @php $subtotal += $purchaseDetail->unit_price * $purchaseDetail->quantity @endphp
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

