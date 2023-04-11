@push('css')

@endpush
<div>
    <x-slot name="title">
        SUB-SUB CATEGORY INFO
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Sub-sub Category Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="ProductSubSubCategoryInfoModal"><i class="mdi mdi-plus mr-1"></i>Sub-sub Category</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="ProductSubSubCategoryInfoTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="ProductSubSubCategoryInfoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Sub-sub Category Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="saveSubSubCategory">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Code">
                                    @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Sub Category</label>
                                    <select class="form-control" wire:model.lazy="sub_category_id">
                                        <option value="">Select Sub-Category</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter sub sub category name">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Image (517.38*492 jpg)</label>
                                    <div class="custom-file">
                                        {{-- <input type="file" wire:model.lazy="image" class="custom-file-input" id="customFile"> --}}

                                        <input type="file" wire:model.lazy="image" x-ref="image">
                                        @if (!$image)
                                        @if($QueryUpdate)
                                        <img src="{{ asset('storage/photo')}}/{{ $QueryUpdate->image }}"  style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                        @endif
                                        @endif
                                        @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                        @endif
                                        {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                    </div>
                                </div>
                            </div>


                            {{-- previous description  --}}
                            {{-- <div class="col-lg-12">
                                <div  class="form-group">
                                    <label for="basicpill-lastname-input"> Description</label>
                                    <textarea class="form-control" id="description" rows="3"  wire:model.lazy="description" placeholder="Description"></textarea>
                                 </div>
                            </div> --}}



                            {{-- Summernote description --}}
                            <div class="col-lg-12">
                                <div wire:ignore class="form-group">
                                    <label for="basicpill-lastname-input"> Description</label>
                                    <textarea class="form-control" id="description" rows="3"  wire:model.lazy="description" placeholder="Description"></textarea>
                                 </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                        <label for="basicpill-lastname-input">Status</label>
                                        <select class="form-control" wire:model.lazy="is_active">
                                            {{-- <option value="">Select Status</option> --}}
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    @error('is_active') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:target="image" wire:loading.attr="disabled">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@push('scripts')
    <script>
 function callEdit(id) {
        @this.call('subSubCategoryEdit', id);
    }
    function callDelete(id) {
        @this.call('subSubCategoryDelete', id);
    }
        $(document).ready(function () {
            var datatable = $('#ProductSubSubCategoryInfoTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.sub_sub_category_table')}}",
                columns: [
                    {
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'Code',
                        data:  'code',
                        name:  'code'
                    },
                    {
                        title: 'Name',
                        data:  'name',
                        name:  'name'
                    },
                    {
                        title: 'Sub Category',
                        data:  'sub_category_id',
                        name:  'sub_category_id'
                    },
                    {
                        title: 'Status',
                        data:  'is_active',
                        name:  'is_active'
                    },
                    {
                        title: 'Image',
                        data:  'image',
                        name:  'image'
                    },
                    // {
                    //     title: 'Status',
                    //     data:  'status',
                    //     name:  'status'
                    // },
                    {
                        title: 'Action',
                        data: 'action',
                        name:'action'
                    },
                ]
            });

            window.livewire.on('success', message => {
                datatable.draw(true);
            });
        });

        $(document).ready(function () {
     if ($("#description").length > 0) {
    tinymce.init({
      selector: "textarea#description",
      height: 200,
	   forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('description', editor.getContent());
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

