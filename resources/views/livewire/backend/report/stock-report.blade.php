@push('css')
    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Stock Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Stock Reports</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Category</label>
                                <Select class="form-control" wire:model.lazy="category_id">

                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </Select>
                                @error('Category') <span class="error">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Brand</label>
                                <select class="form-control" wire:model.lazy="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('Brand') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="basicpill-lastname-input">Product</label>
                                <select class="form-control" wire:model.lazy="product_id">
                                <option value="">Select Product</option>
                                @foreach($product as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                </select>
                                @error('Product') <span class="error">{{ $message }}</span> @enderror
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
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Stock In Inventory</th>

                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($products as $product)

                                <tr>

                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{++$i}}</a> </td>
                                    <td>
                                        {{$product->code}}
                                    </td>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        @if($product->Category)
                                          {{$product->Category->name}}
                                        @endif
                                    </td>
                                    <td>
                                       @if($product->Brand) {{$product->Brand->name}} @endif
                                    </td>
                                    <td>
                                        {{$product->PurchaseInvoiceDetail->sum('quantity')-$product->SaleInvoiceDetail->sum('quantity')}}
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
                            <thead>
                                {{-- <tr>
                                    <th colspan="4"><center>Total</center></th>
                                    <th>47600.00</th>
                                    <th>47600.00</th>

                                </tr> --}}
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

