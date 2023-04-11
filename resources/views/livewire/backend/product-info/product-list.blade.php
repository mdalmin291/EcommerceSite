@push('css')
<div>
    <style>
        .move {
            margin-left: 189px;
            margin-right: auto;
            width: 8em
        }

        .font {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</div>

@endpush
<div>
    <x-slot name="title">
        Product List
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Product List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">

                            </div>
                        </div><!-- end col-->
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>

                                            <tr>
                                                <th>Sr.</th>
                                                <th>Name</th>
                                                <th>image</th>
                                                <th>Category</th>
                                                <th>Regular Price</th>
                                                <th>Special Price</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @php
                                            $p=0;
                                            @endphp
                                            @foreach($products as $product)
                                            <tr>
                                                <td>{{ ++$p }}</td>
                                <td>
                                    @if(strlen($product->name)>40)
                                    {{ substr($product->name, 0,39).'...' }}
                                    @else
                                    {{ $product->name }}
                                    @endif
                                </td>
                                <td>
                                    <img @if($product->ProductImageFirst)
                                    src="{{ asset('storage/photo/'.$product->ProductImageFirst->image)}}"
                                    @endif style="height:100px;"/>
                                </td>
                                <td>
                                    @if($product->Category)
                                    @if($product->Category) {{ $product->Category->name }} @endif
                                    @endif
                                </td>
                                <td>{{ $product->regular_price }}</td>
                                <td>{{ $product->special_price }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm btn-block mb-1"
                                        wire:click="ProductDetails({{$product->id}})"><i
                                            class="fas fa-eye font-size-12"></i></a>
                                    <a href="{{ route('product.product', ['id'=>$product->id]) }}"
                                        class="btn btn-primary btn-sm"><i class="bx bx-edit font-size-12"></i></a>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="deleteProduct({{ $product->id }})"><i
                                            class="bx bx-window-close font-size-12"></i></button>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>

                                </table>

                            </div> --}}
                            <div wire:ignore class="table-responsive">
                                <div wire:ignore class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap" id="ProductTable"
                                        style="border-collapse: collapse; border-spacing: 0;"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Modal content for the above example -->
<div wire:ignore.self class="modal fade" id="productDetailModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group move">
                            <label for="basicpill-firstname-input">Image</label>
                            <div class="card" style="width: 15rem;">
                                <img @if($ProductDetail)
                                    src="{{ asset('storage/photo/'.$ProductDetail->ProductImageFirst->image)}}" @endif
                                    class="card-img-top" alt="...">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Name: @if($ProductDetail)
                                {{$ProductDetail->name}} @endif</label>
                        </div>
                    </div>
                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Category:
                                @if($ProductDetail)
                                @if($ProductDetail->Category)
                                {{$ProductDetail->Category->name}}
                                @endif
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Brand: @if($ProductDetail)
                                @if($ProductDetail->Brand)
                                {{$ProductDetail->Brand->name}}
                                @endif
                                @endif</label>
                        </div>
                    </div>
                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Regular price: @if($ProductDetail)
                                {{$ProductDetail->regular_price}} @endif</label>
                        </div>
                    </div>
                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Special price: @if($ProductDetail)
                                {{$ProductDetail->special_price}} @endif</label>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">wholesale_price: @if($ProductDetail)
                                {{$ProductDetail->wholesale_price}} @endif</label>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">purchase price: @if($ProductDetail)
                                {{$ProductDetail->purchase_price}} @endif</label>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">discount: @if($ProductDetail)
                                {{$ProductDetail->discount}}
                                @endif</label>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Low alert: @if($ProductDetail)
                                {{$ProductDetail->low_alert}}
                                @endif</label>
                        </div>
                    </div>

                    <div class="col-lg-6 font">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Minium Order Quantity: @if($ProductDetail)
                                {{$ProductDetail->min_order_qty}} @endif</label>
                        </div>
                    </div>
                    <div class="col-lg-6 font">n
                        <div class="form-group">
                            <label for="basicpill-firstname-input">
                                Status:
                                @if($ProductDetail)
                                @if($ProductDetail->is_active==1)
                                <span class="badge badge-info">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@push('scripts')
<script>
    function callDetail(id) {
        @this.call('ProductDetails', id);
    }
    function callDelete(id) {
        @this.call('deleteProduct', id);
    }
        $(document).ready(function () {
            var datatable = $('#ProductTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.product_table')}}",
                columns: [
                    {
                        title: 'SL',
                        data: 'id'
                    },


                    {
                        title: 'Bar Code',
                        data:   'code',
                        name:   'code'
                    },
                    {
                        title: 'Name',
                        data:  'name',
                        name:  'name'
                    },
                    {
                        title: 'Category',
                        data:  'category_id',
                        name:  'category_id'
                    },
                    {
                        title: 'Image',
                        data:  'product_id',
                        name:  'product_id'
                    },
                    {
                        title: 'Regular Price',
                        data:  'regular_price',
                        name:  'regular_price'
                    },
                    {
                        title: 'Special Price',
                        data:  'special_price',
                        name:  'special_price'
                    },

                    {
                        title: 'Color',
                        data:  'color',
                        name:  'color'
                    },

                    {
                        title: 'Size',
                        data:  'size',
                        name:  'size'
                    },

                    {
                        title: 'Status',
                        data:  'is_active',
                        name:  'is_active'
                    },
                    {
                        title: 'Action',
                        data:  'action',
                        name:  'action'
                    },
                ]
            });
            window.livewire.on('success', message => {
                datatable.draw(true);
            });
        });
</script>
@endpush
