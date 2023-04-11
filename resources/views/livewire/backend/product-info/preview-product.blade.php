@push('css')
<div>
    <style>
        .move {
            margin-left: 189px;
            margin-right: auto;
            width: 8em
        }
        .font{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</div>

@endpush
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Product Details</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group move">
                                <label for="basicpill-firstname-input">Image</label>
                                <div class="card" style="width: 15rem;">
                                    <img src="{{ asset('storage/photo/'.$ProductPreview->image)}}
                                        class="card-img-top" alt="...">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Name: {{$ProductPreview->name}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Category: {{$ProductPreview->Category['name']}} </label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Sub Category: {{$ProductPreview->SubCategory['name']}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Sub Sub Category: {{$ProductPreview->SubSubCategory['name']}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Brand: {{$ProductPreview->Brand['name']}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Regular price: {{$ProductPreview->regular_price}}</label>
                            </div>
                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Special price: {{$ProductPreview->special_price}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">wholesale_price: {{$ProductPreview->wholesale_price}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">purchase price: {{$ProductPreview->purchase_price}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">discount: {{$ProductPreview->discount}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Low alert: {{$ProductPreview->low_alert}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Minium Order Quantity: {{$ProductPreview->min_order_qty}}</label>
                            </div>
                        </div>

                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">VaT Rate: {{$ProductPreview->Vat['name']}}</label>
                            </div>

                        </div>
                        <div class="col-lg-6 font">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Branch: {{$ProductPreview->Branch['name']}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
