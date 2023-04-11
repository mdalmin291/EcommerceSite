@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Purchase Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Purchase Report</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">From Date</label>
                                    <input type="date" class="form-control" wire:model.debounce.150ms="from_date"/>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">To Date</label>
                                    <input type="date" class="form-control" wire:model.debounce.150ms="to_date"/>
                                </div>
                              </div>
                              <div class="col-md-4">
                               <div class="form-group">
                                <label for="basicpill-firstname-input">Select Supplier</label>

                                <select class="form-control" placeholder="Customer" wire:model.lazy="contact_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-lastname-input">Branch</label>
                                <select class="form-control" wire:model.lazy="branch_id">
                                    <option value="">Select Branch</option>
                                   @foreach ($branches as $branch)
                                     <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                             </select>
                                @error('branch_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
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
                                    <th>Supplier Name</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Shipping Charge</th>
                                    <th>Payable Amount</th>
                                    <th>Paid</th>
                                    <th>Due</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; $subTotal=0; $discount=0; $shipping_charge=0; $grand_total=0;$paid_amount=0;$due=0; @endphp
                                @foreach ($this->dateFilter($purchasesInvoice) as $purchaseInvoice)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a></td>
                                    <td>{{ $purchaseInvoice->purchase_date }}</td>
                                    <td>@if($purchaseInvoice->Contact) {{ $purchaseInvoice->Contact->first_name }} {{ $purchaseInvoice->Contact->last_name }} @endif</td>
                                    <td>
                                        {{ $purchaseInvoice->total_amount }}
                                        @php $subTotal +=$purchaseInvoice->total_amount @endphp
                                    </td>
                                    <td>
                                        {{ $purchaseInvoice->discount }}
                                        @php $discount += $purchaseInvoice->discount @endphp
                                    </td>
                                    <td>
                                        {{ $purchaseInvoice->shipping_charge }}
                                        @php $shipping_charge += $purchaseInvoice->shipping_charge @endphp
                                    </td>
                                    <td>
                                        {{ $purchaseInvoice->payable_amount }}
                                        @php $grand_total += $purchaseInvoice->payable_amount @endphp

                                    </td>
                                    <td>
                                        {{ $purchaseInvoice->PurchasePayment->sum('total_amount') }}
                                        @php $paid_amount += $purchaseInvoice->PurchasePayment->sum('total_amount') @endphp

                                    </td>
                                    <td>
                                        {{ $purchaseInvoice->payable_amount - $purchaseInvoice->PurchasePayment->sum('total_amount')}}
                                        @php $due += $purchaseInvoice->payable_amount - $purchaseInvoice->PurchasePayment->sum('total_amount') @endphp
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"><center>Total</center></th>

                                    <th>{{ $subTotal }}</th>
                                    <th>{{ $discount }}</th>
                                    <th>{{ $shipping_charge }}</th>
                                    <th>{{ $grand_total }}</th>
                                    <th>{{ $paid_amount }}</th>
                                    <th>{{ $due }}</th>


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

