@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <style>
            .stylefortable {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .styleforth {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .stylefortd {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .customer-payment-modal {
                position: relative;
                left: 87px;
            }
        </style>
@endpush
<div>
    <x-slot name="title">
        Receive
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Receive</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <a href="{{route('transaction.customer-payment-report')}}"><button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">Payment Report</button></a>
                            </div>
                        </div><!-- end col-->
                    </div><hr>
                    <form wire:submit.prevent="ReceiveSave">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Code</label>
                                <input class="form-control" type="text" wire:model.lazy="code" placeholder="Payment Code">
                                 @error('code') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Date</label>
                                <input id="date" type="date" class="form-control" wire:model.lazy="date" placeholder="Date">
                                @error('date') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Transaction ID</label>
                                <input class="form-control" type="text" wire:model.lazy="transaction_id" placeholder="Transaction ID">
                                 @error('transaction_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Payment Method</label>
                                <select class="form-control" wire:model.lazy="payment_method_id" id="select2-dropdown">
                                    <option>Payment Method</option>
                                   @foreach ($payment_methods as $payment_method)
                                       <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                   @endforeach
                                </select>
                                @error('payment_method_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        {{-- <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label"> Type</label>
                                <select class="form-control" wire:model.lazy="type">
                                    <option value="">Select</option>
                                    <option value="Payment">Payment</option>
                                    <option value="Receive">Receive</option>
                                </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Staff</label>
                                <select class="form-control" wire:model.lazy="contact_id" id="select2-dropdown">
                                    <option>Select Staff</option>
                                   @foreach ($contacts as $contact)
                                       <option value="{{ $contact->id }}">{{ $contact->first_name }} {{ $contact->last_name }}</option>
                                   @endforeach
                                </select>
                                @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Chart of Account</label>
                                <select class="form-control" wire:model.lazy="chart_of_account_id" id="select2-dropdown">
                                    <option>Select</option>
                                   @foreach ($chart_of_account as $chart_of_account)
                                       <option value="{{ $chart_of_account->id }}">{{ $chart_of_account->name }}</option>
                                   @endforeach
                                </select>
                                @error('chart_of_account_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Amount</label>
                                <input class="form-control" type="text" wire:model.lazy="amount" placeholder="Amount">
                                 @error('total_amount') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Receipt No</label>
                                <input class="form-control" type="text" wire:model.lazy="receipt_no" placeholder="Receipt No">
                                 {{-- @error('receipt_no') <span class="error">{{ $message }}</span> @enderror --}}
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Note</label>
                                <input class="form-control" type="text" wire:model.lazy="note" placeholder="Note">
                                 {{-- @error('receipt_no') <span class="error">{{ $message }}</span> @enderror --}}
                            </div>
                        </div>



                        {{-- <div class="col-lg-12">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Comments/Narration</label>
                                <input class="form-control" type="text" wire:model.lazy="Comments/Narration" placeholder="Comments/Narration">
                                 @error('Comments/Narration') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-primary">Submit</button></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div wire:ignore class="table-responsive">
                        <table class="display table table-striped table-bordered" id="ReceiveTable"
                            style="width:100%"></table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Code</th>
                                <th>Purpose</th>
                                <th>Payment Method</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($receive as $receive)

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a> </td>
                                    <td>{{$receive->code}}</td>
                                    <td>{{$receive->ChartOfAccount->name}}</td>
                                    <td>{{$receive->PaymentMethod->name}}</td>
                                    <td>{{$receive->Contact->first_name}} {{$receive->Contact->last_name}}</td>
                                    <td>
                                        {{$receive->date}}
                                    </td>
                                    <td>
                                        {{$receive->amount}}
                                    </td>
                                    <td>
                                        <button class="btn btn-info text-primary p-1"><i class="bx bx-printer font-size-18"></i></button>
                                        <button class="btn btn-dark text-primary p-1" wire:click="ReceiveEdit({{$receive->id}})"><i class="mdi mdi-pencil font-size-18"></i></button>
                                        <button class="btn btn-primary text-danger p-1" wire:click="ReceiveDelete({{$receive->id}})"><i class="mdi mdi-close font-size-18"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
      {{-- Start Invoice Modal --}}
      <div wire:ignore.self class="modal fade" id="InvoiceModal" tabindex="-1" role="dialog"
           aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($transaction)
                        <div>
                            <x-slot name="title">Receive RECEIPT</x-slot>
                            <x-slot name="header">Receive RECEIPT</x-slot>

                            <center>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width: 40px;height:50px;vertical-align: super;"
                                            class="customer-payment-modal" style="padding: 0px;margin: 0px;">
                                            <img src="@if ($companyInfo){{ asset('storage/photo/' . $companyInfo->logo) }}@endif"
                                                style="width: 40px;height: 40px;padding: 0px;margin: 0px;vertical-align: super;"
                                                alt="PaikariApp">
                                        </td>
                                        <td>
                                            <h3 style="text-align:center;margin:0px;">
                                                @if (isset($companyInfo)){{ $companyInfo->name }}@endif
                                            </h3>
                                            <p style="text-align:center;margin:0px;">Mobile:
                                                @if (isset($companyInfo)){{ $companyInfo->mobile }}@endif
                                            </p>
                                            <p style="text-align:center;margin:0px;">Telephone:
                                                @if (isset($companyInfo)){{ $companyInfo->phone }}@endif
                                            </p>
                                            <p style="text-align:center;margin:0px;">

                                            </p>
                                            <h4 style="text-align:center;">Receive Voucher</h4>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                            <center>
                                <table style="width:80%;">
                                    <tr>
                                        <td>
                                            <p style="margin-top: 20px; font-weight:bold;">No. :@if($transaction) {{$transaction->code}} @endif
                                            <p style="font-weight:bold;">Dated :@if($transaction){{$transaction->date}}@endif</p>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>

                                <table class="payment stylefortable" style="width:80%;">
                                    <tr>
                                        <th class="styleforth">Particulars</th>
                                        <th class="styleforth">Amount</th>
                                    </tr>
                                    {{-- <tr>
                                        <td class="stylefortd font-weight-bold">Account : </td>
                                        <td class="stylefortd">0</td>
                                    </tr> --}}
                                    <tr>
                                        <td class="stylefortd"> @if($transaction->Contact) {{$transaction->Contact->first_name}} {{$transaction->Contact->last_name}}  @endif
                                            Cr
                                            {{-- <p class="ml-5">Agst Ref <strong>@if(isset($transaction->Invoice))
                                                    {{$transaction->Invoice->code}}
                                                    {{$transaction->amount}} Dr @endif</strong></p> --}}

                                                    <p class="ml-5">Agst Ref<strong>@if(isset($transaction)) ({{$transaction->transaction_id}}) @endif
                                                    @if(isset($transaction)) {{$transaction->amount}} Dr @endif
                                                    </strong>
                                            </p>
                                        </td>
                                        <td class="stylefortd">
                                            @if(isset($transaction->amount)){{$transaction->amount}}@endif
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <td class="stylefortd font-weight-bold">Amounts (In Words):</td>
                                        <td class="stylefortd">

                                        </td>
                                    </tr> --}}

                                    {{-- <tr>
                                        <td class="stylefortd ml-5">
                                            {{$total}}
                                        </td>
                                        <td>AED: {{$transaction->Invoice->amount_to_pay}}</td>
                                    </tr> --}}
                                </table>
                                {{--
                                <table style="width:80%; margin-top:40px;">
                                    <tr>
                                        <td>Receiver’s Signature</td>
                                        <td style="float: right;">Authorised Signatory</td>
                                    </tr>
                                </table> --}}
                            </center>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($transaction)
                            <button type="submit" class="btn btn-dark"  wire:click="InvoicePrint({{$transaction->id}})">
                                Print
                            </button>
                        @endif
                    </div>
                </div>
            </div>
  </div>
  {{-- End Invoice Modal --}}
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

        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>

        <script>
            function callInvoice(id) {
                    @this.call('InvoiceModal', id);
                }
                function callEdit(id) {
                    @this.call('ReceiveEdit', id);
                }
                function callDelete(id) {
                    @this.call('PaymentDelete', id);
                }

           $(document).ready(function() {
            var datatable = $('#ReceiveTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.receive-table') }}",
                columns: [{
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'Code',
                        data: 'code',
                        name: 'code'
                    },
                    {
                        title: 'Purpose',
                        data: 'chart_of_account_id',
                        name: 'chart_of_account_id'
                    },
                    {
                        title: 'Payment Method',
                        data: 'payment_method_id',
                        name: 'payment_method_id'
                    },

                    {
                        title: 'Amount',
                        data: 'amount',
                        name: 'amount'
                    },

                    {
                        title: 'Staff',
                        data: 'contact_id',
                        name: 'contact_id'
                    },

                    {
                        title: 'Date',
                        data: 'date',
                        name: 'date'
                    },
                    {
                        title: 'Amount',
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        title: 'Note',
                        data: 'note',
                        name: 'note'
                    },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            window.livewire.on('success', message => {
                datatable.draw(true);
          });
        });
    </script>
@endpush

