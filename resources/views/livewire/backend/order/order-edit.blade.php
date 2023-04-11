@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endpush

<div>
    <x-slot name="title">
        Order Edit
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="search-box mr-2 mb-2 d-inline-block"> --}}
                                {{-- <div class="position-relative"> --}}
                                    <h4 class="card-title text-center">Ecommerce Order Edit</h4>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                        <div class="col-sm-8">

                        </div><!-- end col-->
                            <div class="col-md-6">
                                Order Id: <span class="font-weight-bold">{{ $Order->code }}</span>
                            </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Order Date</label>
                                <h4>
                                    {{date('d F Y', strtotime($Order->order_date))}}<br>
                                    {{date('h:i A', strtotime($Order->order_date))}}
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Search Product</label>
                                <livewire:component.product-search-dropdown/>
                                @error('ProductName') <span class="error">{{ $message }}</span> @enderror
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
                        <table class="table table-centered mb-0 table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Sale Rate</th>
                                    <th>Amount</th>
                                    {{-- <th>Warehouse</th> --}}
                                    <th colspan="1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($orderProductList as $key => $product)
                                <tr>
                                    <td>
                                        {{$i++}}
                                    </td>
                                    <td>
                                        {{ $product['code'] }}
                                    </td>
                                    <td>
                                        {{ $product['name'] }}
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" wire:model.debounce.500ms="product_quantity.{{$key}}" style="width: 100px;" placeholder="Quantity" step="any">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"  wire:model.debounce.500ms="product_rate.{{$key}}" placeholder="Sale Rate">
                                    </td>
                                    <td>
                                        {{$product_subtotal[$key]}}
                                    </td>
                                    <td>
                                        <center><a class="btn btn-danger btn-sm" wire:click="removeProduct({{$key}},{{$product['id']}})"><i class="fa fa-trash"></i></a></center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            @if(isset($Order->Contact))
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 font-weight-bold">
                            <center>
                               Customer Name: {{$Order->Contact->business_name}}
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered mb-0 table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Bill Total</th>
                                    <th>Discount</th>
                                    <th>Shipping Charge</th>
                                    <th>Shipping Charge</th>
                                    <th>Amt to Pay</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="BillTotal"  style="width: 200px;"  wire:model.debounce.500ms="subtotal" placeholder="Bill Total" readonly>
                                        @error('subtotal') <span class="error">{{ $message }}</span> @enderror

                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="Discount" style="width: 200px;" placeholder="Discount" wire:model.debounce.500ms="discount">
                                    </td>
                                    <td>
                                        <select class="form-control" wire:model.lazy="shipping_fee">
                                           <option value="">--Select--</option>
                                        @foreach ($shipping_charges as $shipping_charge)
                                           <option value="{{$shipping_charge->shipping_fee}}">{{$shipping_charge->title}}</option>
                                        @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="ShippingCharge" style="width: 200px;" placeholder="Shipping Charge" wire:model.debounce.500ms="shipping_charge">
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="AmttoPay"
                                            wire:model.debounce.500ms="grand_total" style="width: 200px;"
                                            placeholder="Amt to Pay" readonly>
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="PaidAmount"
                                            placeholder="Paid Amount" wire:model.debounce.500ms="paid_amount" readonly>
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="Due"
                                            placeholder="Due" wire:model.debounce.500ms="due" style="width:80px;"
                                            readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                 {{-- Start Payment --}}
                 <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">

                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th><center>Payment Method</center></th>
                                                <th><center>Txn Id</center></th>
                                                <th><center>Amount</center></th>
                                                <th><center>Action</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($paymentMethodList as $key => $item)
                                            <tr>
                                                <th scope="row"><center>{{$item['payment_method_name']}}</center></th>
                                                <td>
                                                    {{$item['transaction_id']}}
                                                </td>
                                                <td>
                                                   {{$item['payment_amount']}}
                                                </td>

                                                <td>
                                                    <center><button class="btn btn-danger btn-sm" wire:click="removePaymentList({{$key}})"><i class="fa fa-trash"></i></button></center>
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
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Add Payment</h4>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Payment Date</td>
                                            <th>
                                                <input type="date" class="form-control" wire:model.lazy="sale_payment_date">
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <th>
                                                <select class="form-control" wire:model.lazy="payment_method_id">
                                                    <option>Select Method</option>
                                                    @foreach ($payments as $payment)
                                                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                                    @endforeach
                                                </select>
                                               @error('payment_method_id') <span class="error">{{ $message }}</span> @enderror
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <th>
                                                <input type="text" class="form-control" name="Amount" placeholder="Amount" wire:model.lazy="payment_amount">
                                               @error('payment_amount') <span class="error">{{ $message }}</span> @enderror

                                            </th>
                                        </tr>
                                        <tr>
                                            <td>Transaction Id</td>
                                            <th>
                                                <input type="text" class="form-control" placeholder="Transaction Id" wire:model.lazy="transaction_id">
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>Code</td>
                                            <th>
                                                <input type="text" class="form-control" placeholder="Code" wire:model.lazy="payment_code">
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                    <button class="btn btn-warning" type="submit" wire:click="AddPaymentMethod()">Add Payment</button>
                                    <button type="submit" class="btn btn-primary float-right" wire:click="ConfirmEdit" style="width:150px;">Submit</button>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                {{-- End Payment --}}
        {{-- <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                  <button type="submit" class="btn btn-primary float-right" wire:click="Submit">Submit</button>
                </div>
            </div>
        </div> --}}
    </div>

        {{-- Start Delete Modal --}}
        <div class="modal fade" id="EditPopup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to edit this record?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" wire:click="Edit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}

    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="OrderEditPopup" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Order Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                           <div class="col-md-6">
                               <center>
                                   <a href="{{ route('order.order-invoice',['id'=>$OrderId]) }}" class="btn btn-info btn-block">Invoice</a>
                               </center>
                           </div>
                           <div class="col-md-6">
                             <center>
                                <select class="form-control" wire:model.lazy="status">
                                <option value="">Status</option>
                                <option value="delivered">Delivered</option>
                            </select>
                             </center>
                           </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



</div>

@push('scripts')

{{-- Start Print --}}
<script>

$(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
            @this.set('contact_id', data);
           });
        });

    }
</script>
{{-- End Print --}}

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

@endpush

