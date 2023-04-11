@push('css')

@endpush
<div>
    <x-slot name="title">
        STOCK ADJUSTMENT
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h4>Stock Adjustment</h4>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Date</label>
                                <input class="form-control" type="date" wire:model.lazy="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Type</label>
                                <select class="form-control" wire:model.lazy="type">
                                    <option value="">Select Type</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Increase">Increase</option>
                                    <option value="Decrease">Decrease</option>
                                </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Contact</label>
                                <select class="form-control" wire:model.lazy="contact_id">
                                    <option value="">Select Contact</option>
                                    @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->first_name }}
                                        {{ $contact->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">From Branch</label>
                                <select class="form-control" wire:model.lazy="from_branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @error('from_branch_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">To Branch</label>
                                <select class="form-control" wire:model.lazy="to_branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @error('to_branch_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">From Warehouse</label>
                                <select class="form-control" wire:model.lazy="from_warehouse_id">
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                @error('from_warehouse_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">To Warehouse</label>
                                <select class="form-control" wire:model.lazy="to_warehouse_id">
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                @error('to_warehouse_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        {{-- previous note
                        <div class="col-md-12">
                            <textarea placeholder="Note" class="form-control" wire:model.lazy="note"></textarea>
                        </div> --}}



                        <div wire.ignore class="col-md-12">
                            <textarea placeholder="Note" class="form-control" id="note"
                                wire:model.lazy="note"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <livewire:component.product-search-dropdown />
                                @error('ProductName') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Sale Price</th>
                                            <th colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderProductList as $key => $product)

                                        <tr>
                                            <td>
                                                {{ $product['code'] }}
                                            </td>
                                            <td>
                                                {{ $product['name'] }}
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.debounce.500ms="product_quantity.{{$key}}"
                                                    style="width: 100px;" placeholder="Quantity" step="any">
                                            </td>
                                            <td>
                                                @if(isset($product['regular_price']))
                                                <input type="text" class="form-control"
                                                    value="{{ $product['regular_price'] }}" placeholder="Sale Rate">
                                                    @endif
                                            </td>

                                            <td>
                                                <center><a href="#" class="btn btn-danger btn-sm"
                                                        wire:click="removeProduct({{$key}})"><i
                                                            class="fa fa-trash">Delete</i></a></center>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button class="btn btn-success btn-lg mt-2"
                                    wire:click="saveStockAdjustment">Submit</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">

                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Contact</th>
                                        <th>From Branch</th>
                                        <th>To Branch</th>
                                        <th>From Warehouse</th>
                                        <th>To Warehouse</th>
                                        <th colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach ($stockAdjustments as $stockAdjustment)

                                    <tr>
                                        <td>
                                            <a href="javascript: void(0);"
                                                class="text-body font-weight-bold">{{ ++$i }}</a>
                                        </td>
                                        <td>
                                            {{ $stockAdjustment->date }}
                                        </td>
                                        <td>
                                            {{ $stockAdjustment->type }}
                                        </td>
                                        <td>
                                            @if($stockAdjustment)
                                            {{ $stockAdjustment->Contact['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($stockAdjustment)
                                            {{ $stockAdjustment->FromBranch['name']}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($stockAdjustment)
                                            {{ $stockAdjustment->ToBranch['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($stockAdjustment)
                                            {{ $stockAdjustment->FromWarehouse['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($stockAdjustment)
                                            {{ $stockAdjustment->ToWarehouse['name'] }}
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" wire:click="editStockAdjustment({{$stockAdjustment->id}})"><i
                                                class="bx bx-edit font-size-18"></i></button>
                                            <button class="btn btn-danger btn-sm"
                                                wire:click="deleteStockAdjustment({{$stockAdjustment->id}})"><i
                                                    class="bx bx-window-close font-size-18"></i></button>
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
    </div>

</div>
@push('scripts')
<script>
    $(document).ready(function () {
  if ($("#note").length > 0) {
    tinymce.init({
      selector: "textarea#note",
      height: 200,
	   forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('note', editor.getContent());
            });
        },
      plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "save table contextmenu directionality emoticons template paste textcolor"],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
      style_formats: [{
        title: 'Bold text',
        inline: 'b'
      }, {
        title: 'Red text',
        inline: 'span',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Red header',
        block: 'h1',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Example 1',
        inline: 'span',
        classes: 'example1'
      }, {
        title: 'Example 2',
        inline: 'span',
        classes: 'example2'
      }, {
        title: 'Table styles'
      }, {
        title: 'Table row 1',
        selector: 'tr',
        classes: 'tablerow1'
      }]
    });

  }
  $('.summernote').summernote({
    height: 300,
    // set editor height
    minHeight: null,
    // set minimum height of editor
    maxHeight: null,
    // set maximum height of editor
    focus: true // set focus to editable area after initializing summernote

  });
});

</script>

@endpush
