@push('css')

@endpush

<div>
    <x-slot name="title">
        Sale Add
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Sale Add</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <a href="{{route('product.product')}}"><button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"
                                        data-toggle="modal" data-target=".productModal"><i
                                            class="mdi mdi-plus mr-1"></i> New Product</button></a>
                                {{-- <a href="{{route('inventory.purchase-list')}}"><button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">Purchase
                                        List</button></a> --}}
                            </div>
                        </div><!-- end col-->
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Sale Code</label>
                                <input class="form-control" type="text" wire:model.lazy="code"
                                    placeholder="Purchase Code">
                                @error('code') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Date</label>
                                <input id="date" type="date" class="form-control" wire:model.lazy="date"
                                    placeholder="Date" required>
                                @error('date') <span class="error">{{ $message }}</span> @enderror
                            </div>

                        </div>
                        {{-- <div class="col-lg-2">
                            <div class="form-group">
                                <label class="control-label">Warehouse</label>
                                <select class="form-control" wire:model.lazy="warehouse_id" id="select2-dropdown">
                                    <option>Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                @error('warehouse_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Search Product</label>
                                <livewire:component.product-search-dropdown />
                                @error('ProductName') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Scan Barcode</label>
                                <input  class="form-control" wire:model.lazy="barcode"  id="labels" type="text" placeholder="Barcode Scan..."
                                wire:keydown.enter="barcodeScan($event.target.value)">
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
                                    {{-- <th>Unit</th> --}}
                                    {{-- <th>Vat</th> --}}
                                    <th>Sale Rate</th>
                                    {{-- <th>Discount</th> --}}

                                    <th>Amount</th>
                                    {{-- <th>Warehouse</th> --}}
                                    <th colspan="1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($orderProductList as $key => $product)
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        {{ $product['code'] }}
                                    </td>
                                    <td>
                                        {{ $product['name'] }}
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model.debounce.500ms="product_quantity.{{$key}}" style="width: 100px;"
                                            placeholder="Quantity" step="any">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                            wire:model.debounce.500ms="product_sale_price.{{$key}}" placeholder="Sale Rate">
                                    </td>
                                    {{-- <td>
                                        <input type="text" class="form-control"
                                            wire:model.debounce.500ms="product_discount.{{$key}}" @if($SaleInvoice)
                                            readonly @endif style="width: 100px;" placeholder="Discount">
                                    </td> --}}
                                    <td>
                                        {{$product_subtotal[$key]}}
                                    </td>
                                    {{-- <td>
                                        <div class="form-group">
                                            <select class="form-control" wire:model.lazy="warehouse_id.{{$key}}">
                                                <option value="">Select</option>
                                                @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('warehouse_id') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </td> --}}
                                    <td>
                                        <center><a class="btn btn-danger btn-sm"
                                                wire:click="removeProduct({{$key}},{{$product['id']}})"><i
                                                    class="fa fa-trash"></i></a>
                                        </center>
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-lg-4">
                            <div wire:ignore class="form-group">
                                <label class="control-label">Customer</label>
                                <select class="form-control" wire:model.lazy="contact_id" id="select2-dropdown">
                                    <option>Select Customer</option>
                                    @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->business_name }}-{{
                                        $contact->first_name }} {{ $contact->last_name
                                        }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
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
                                        <input type="number" step="any" class="form-control" name="BillTotal"
                                            style="width: 200px;" wire:model.debounce.500ms="subtotal"
                                            placeholder="Bill Total" readonly>
                                        @error('subtotal') <span class="error">{{ $message }}</span> @enderror

                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="Discount"
                                            style="width: 200px;" placeholder="Discount"
                                            wire:model.debounce.500ms="discount">
                                    </td>
                                    <td>
                                        <select class="form-control" wire:model.lazy="shipping_fee">
                                            <option value="">--Select--</option>
                                            @foreach ($shipping_charges as $shipping_charge)
                                            {{-- <input type="number" step="any" class="form-control" name="Discount"
                                                style="width: 200px;" placeholder="Discount"
                                                wire:model.debounce.500ms="discount"> --}}
                                            <option value="{{$shipping_charge->shipping_fee}}">
                                                {{$shipping_charge->title}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" step="any" class="form-control" name="ShippingCharge"
                                            style="width: 200px;" placeholder="Shipping Charge"
                                            wire:model.debounce.500ms="shipping_charge">
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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">

                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Payment Method</center>
                                        </th>
                                        <th>
                                            <center>Txn Id</center>
                                        </th>
                                        <th>
                                            <center>Amount</center>
                                        </th>
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                      $i = 0;
                                    @endphp
                                    @foreach ($paymentMethodList as $key => $item)
                                    <tr>
                                        <th scope="row">
                                            <center>{{$item['payment_method_name']}}</center>
                                        </th>
                                        <td>
                                            {{$item['transaction_id']}}
                                        </td>
                                        <td>
                                            {{$item['payment_amount']}}
                                        </td>

                                        <td>
                                            <center><button class="btn btn-danger btn-sm"
                                                    wire:click="removePaymentList({{$key}})"><i
                                                        class="fa fa-trash"></i></button></center>
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
                                        <input type="text" class="form-control" name="Amount" placeholder="Amount"
                                            wire:model.lazy="payment_amount">
                                        @error('payment_amount') <span class="error">{{ $message }}</span> @enderror

                                    </th>
                                </tr>
                                <tr>
                                    <td>Transaction Id</td>
                                    <th>
                                        <input type="text" class="form-control" placeholder="Transaction Id"
                                            wire:model.lazy="transaction_id">
                                    </th>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <th>
                                        <input type="text" class="form-control" placeholder="Code"
                                            wire:model.lazy="payment_code">
                                    </th>
                                </tr>

                            </tbody>
                        </table>
                        <button class="btn btn-warning" type="submit" wire:click="AddPaymentMethod()">Add
                            Payment</button>
                        <button type="submit" class="btn btn-primary float-right" wire:click="Submit"
                            style="width: 150px;">Submit</button>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>


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
</script>
{{-- End Print --}}

@endpush
