@push('css')
<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        .top {
            position: relative;
            top: 33px;
            right: 11px;
        }

        .profile {
            position: relative;
            left: 20px;
            font-family: "Times New Roman", Times, serif;
        }

        .quotation {
            position: relative;
            top: 30px;
        }

        .amount {
            position: relative;
            top: 30px;
        }

        .small {
            position: relative;
            top: 31px;
            left: 245px;
        }

        .in_word {
            position: relative;
            top: 48px;
            right: 0px;
            margin-left: 10px;
        }
    </style>
    <x-slot name="title">
        CUSTOMER PAYMENT
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Customer Payment</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <a href="{{route('transaction.customer-payment-report')}}"><button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">Payment
                                        Report</button></a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <hr>
                    <form wire:submit.prevent="paymentSave">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code"
                                        placeholder="Payment Code">
                                    @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Date</label>
                                    <input id="date" type="date" class="form-control" wire:model.lazy="date"
                                        placeholder="Date">
                                    @error('date') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Transaction ID</label>
                                    <input class="form-control" type="text" wire:model.lazy="transaction_id"
                                        placeholder="Transaction ID">
                                    @error('transaction_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Payment Method</label>
                                    <select class="form-control" wire:model.lazy="payment_method_id"
                                        id="select2-dropdown">
                                        <option>Payment Method</option>
                                        @foreach ($payment_methods as $payment_method)
                                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('payment_method_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Customer</label>
                                    <select class="form-control" wire:model.lazy="contact_id" id="select2-dropdown">
                                        <option>Select Customer</option>
                                        @foreach ($contacts as $contact)
                                        <option value="{{ $contact->id }}">{{ $contact->first_name }} {{
                                            $contact->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Business Name</label>
                                    <select class="form-control" wire:model.lazy="contact_id" id="select2-dropdown">
                                        <option>Select Business Name</option>
                                        @foreach ($contacts as $contact)
                                        <option value="{{ $contact->id }}">{{ $contact->business_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Search Sale Code</label>
                                    <livewire:component.sale-invoice-search-dropdown />
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Amount</label>
                                    <input class="form-control" type="text" wire:model.lazy="total_amount"
                                        placeholder="Amount">
                                    @error('total_amount') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Receipt No</label>
                                    <input class="form-control" type="text" wire:model.lazy="receipt_no"
                                        placeholder="Receipt No">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Note</label>
                                    <input class="form-control" type="text" wire:model.lazy="note" placeholder="Note">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <center><button type="submit" class="btn btn-primary">Submit</button></center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Branch</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($payments as $payment)

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a>
                                    </td>
                                    <td>{{$payment->code}}</td>
                                    <td>
                                        @if(isset($payment->Contact->first_name))
                                        {{$payment->Contact->first_name}} {{$payment->Contact->last_name}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$payment->date}}
                                    </td>
                                    <td>
                                        {{$payment->total_amount}}
                                    </td>
                                    <td>
                                        @if($payment->Branch)
                                        {{$payment->Branch->name}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$payment->note}}
                                    </td>
                                    <td>
                                        <button class="btn btn-info text-primary p-1"
                                            wire:click="moneyReceiptModal({{ $payment->id }})"><i
                                                class="bx bx-printer font-size-18"></i></button>
                                        <button class="btn btn-dark text-primary p-1"
                                            wire:click="editPayment({{$payment->id}})"><i
                                                class="mdi mdi-pencil font-size-18"></i></button>
                                        <button class="btn btn-primary text-danger p-1"
                                            wire:click="deletePayment({{$payment->id}})"><i
                                                class="mdi mdi-close font-size-18"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $payments->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Start Modal --}}
    <div class="modal fade bd-example-modal-lg" id="moneyReceipt" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Money Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="moneyReceipt1">
                    <div class="row">
                        <div class="col-3">
                            <img src="@if ($companyInfo){{ asset('storage/photo/' . $companyInfo->logo) }} @endif"
                                class="rounded-circle" alt="Logo" style="height:80px;width:80px;" /><br />
                            <span>RN:
                                <span class="font-weight-bold">
                                    {{ $receipt_no }}
                                </span>
                            </span><br>

                            <span>Date:
                                <span class="font-weight-bold">
                                    @php
                                    $date = date('d-m-Y');
                                    @endphp
                                    {{ $date }}
                                </span>
                            </span>
                            <br />

                            <span>
                                <span class="font-weight-bold">
                                    Invoice No: @if (isset($Receipt->SaleInvoice)) {{ $Receipt->SaleInvoice->id }} @endif
                                </span>
                            </span>
                            <br />

                            <span>
                                <span class="font-weight-bold">
                                    Payment Method: @if (isset($Receipt->PaymentMethod))
                                    {{ $Receipt->PaymentMethod->name }}
                                    @endif
                                </span>
                            </span>
                        </div>


                        <div class="col-5 profile">
                            <h5>Company Name: @if (isset($companyInfo)) {{ $companyInfo->name }} @endif</h5>
                            <h5>Email: @if (isset($companyInfo)) {{ $companyInfo->email }} @endif </h5>
                            <h5>Phone: @if (isset($companyInfo)) {{ $companyInfo->phone }} @endif </h5>
                        </div>


                        <div class="col-4">
                            <h4 class="top">Cash Receipt</h4>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-12 quotation">
                            <p>Received from <u class="font-weight-bold">
                                    @if (isset($Receipt->Contact->first_name))
                                    {{ $Receipt->Contact->first_name}}
                                    @endif
                                </u> the amount tk
                                <u class="font-weight-bold" style="width: 150px;">
                                    @if (isset($Receipt->total_amount))
                                    {{$Receipt->total_amount}}
                                    @endif
                                </u>
                                of For
                                <u class="font-weight-bold" style="width: 150px;">
                                    @if (isset($Receipt->type))
                                    {{ $Receipt->type }}
                                    @endif
                                </u>
                            </p>
                        </div>
                        <table style="width:80%; margin-left: 13px;" class="amount">
                            <tr style="border: 1px solid black;">
                                <th style="border: 1px solid black;">Description</th>
                                <th style="border: 1px solid black;">Contact Name</th>
                                <th style="border: 1px solid black;">Amount</th>
                            </tr>
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;">
                                    @if (isset($Receipt))
                                    {{ $Receipt->note }}
                                    @endif
                                </td>
                                <td style="border: 1px solid black;">
                                    @if (isset($Receipt->Contact->first_name))
                                    {{ $payment->Contact->first_name }}
                                    @endif
                                </td>
                                <td style="border: 1px solid black;">
                                    @if (isset($Receipt->total_amount))
                                    {{$Receipt->total_amount}}
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <div class="in_word">
                            <p>In Word: {{ $total }} </p>
                        </div>
                        <div class="col-12">
                            <table style="width: 50%" class="amount small">
                                <tr style="border: 1px solid black;">
                                    <th style="border: 1px solid black;">Current Balance:</th>
                                    <th style="border: 1px solid black;">
                                        @if (isset($Receipt->total_amount))
                                        {{ $Receipt->total_amount }}
                                        @endif
                                    </th>
                                </tr>
                                <tr style="border: 1px solid black;">
                                    <th style="border: 1px solid black;">Payable Amount:</th>
                                    <th style="border: 1px solid black;">
                                        @if (isset($Receipt->SaleInvoice->payable_amount))
                                        {{ $Receipt->SaleInvoice->payable_amount }}
                                        @endif
                                    </th>
                                </tr>
                                <tr style="border: 1px solid black;">
                                    <th style="border: 1px solid black;">Balance Due:</th>
                                    <th style="border: 1px solid black;">
                                        @if (isset($Receipt))
                                        {{ $Receipt->SaleInvoice->payable_amount - $Receipt->total_amount }}
                                        @endif
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark"
                        onclick="printMoneyReceipt('moneyReceipt1')">Print</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
  <!-- Modal -->
  {{-- <div class="modal fade bd-example-modal-lg" id="moneyReceipt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Money Receipt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="moneyReceipt1">
            <div class="row">
                <div class="col-3">
                    <img src="@if ($companyInfo){{ asset('storage/photo/' . $companyInfo->logo) }} @endif"
                        class="rounded-circle" alt="Logo" style="height:80px;width:80px;" /><br />
                    <span>RN:
                        <span class="font-weight-bold">
                            {{ $receipt_no }}
                        </span>
                    </span><br>

                    <span>Date:
                        <span class="font-weight-bold">
                            @php
                            $date = date('d-m-Y');
                            @endphp
                            {{ $date }}
                        </span>
                    </span>
                    <br />

                    <span>
                        <span class="font-weight-bold">
                            Invoice No: @if ($payments->SaleInvoice) {{ $payments->SaleInvoice->id }} @endif
                        </span>
                    </span>
                    <br />

                    <span>
                        <span class="font-weight-bold">
                            Payment Method: @if ($payments->PaymentMethod)
                            {{ $payments->PaymentMethod->name }}
                            @endif
                        </span>
                    </span>
                </div>


                <div class="col-5 profile">
                    <h5>Company Name: @if ($companyInfo) {{ $companyInfo->name }} @endif</h5>
                    <h5>Email: @if ($companyInfo) {{ $companyInfo->email }} @endif </h5>
                    <h5>Phone: @if ($companyInfo) {{ $companyInfo->phone }} @endif </h5>
                </div>


                <div class="col-4">
                    <h4 class="top">Cash Receipt</h4>
                </div>
                <br>
                <br>
                <br>
                <div class="col-12 quotation">
                    <p>Received from <u class="font-weight-bold">
                            @if (isset($Receipt->Contact->first_name))
                            {{ $Receipt->Contact->first_name}}
                            @endif
                        </u> the amount tk
                        <u class="font-weight-bold" style="width: 150px;">
                            @if (isset($Receipt->total_amount))
                            {{$Receipt->total_amount}}
                            @endif
                        </u>
                        of For
                        <u class="font-weight-bold" style="width: 150px;">
                            @if (isset($Receipt->type))
                            {{ $Receipt->type }}
                            @endif
                        </u>
                    </p>
                </div>
                <table style="width:80%; margin-left: 13px;" class="amount">
                    <tr style="border: 1px solid black;">
                        <th style="border: 1px solid black;">Description</th>
                        <th style="border: 1px solid black;">Contact Name</th>
                        <th style="border: 1px solid black;">Amount</th>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;">
                            @if (isset($Receipt))
                            {{ $Receipt->note }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if (isset($Receipt->Contact->first_name))
                            {{ $payments->Contact->first_name }}
                            @endif
                        </td>
                        <td style="border: 1px solid black;">
                            @if (isset($Receipt->total_amount))
                            {{$Receipt->total_amount}}
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="in_word">
                    <p>In Word: {{ $total }} </p>
                </div>
                <div class="col-12">
                    <table style="width: 50%" class="amount small">
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;">Current Balance:</th>
                            <th style="border: 1px solid black;">
                                @if (isset($Receipt->total_amount))
                                {{ $Receipt->total_amount }}
                                @endif
                            </th>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;">Payable Amount:</th>
                            <th style="border: 1px solid black;">
                                @if (isset($Receipt->SaleInvoice->payable_amount))
                                {{ $Receipt->SaleInvoice->payable_amount }}
                                @endif
                            </th>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;">Balance Due:</th>
                            <th style="border: 1px solid black;">
                                @if ($Receipt)
                                {{ $Receipt->SaleInvoice->payable_amount - $Receipt->total_amount }}
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="printMoneyReceipt('moneyReceipt1')">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}

</div>

<!-- Print Money Receipt  -->
<script>
    function printMoneyReceipt(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            // @this->call('paymentModal');
        }
</script>
@push('scripts')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

<!-- Init js-->
<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js -->
<script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush
