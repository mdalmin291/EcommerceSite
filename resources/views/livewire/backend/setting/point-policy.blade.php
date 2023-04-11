@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endpush
<div>
    <x-slot name="title">
       Point Policy
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="ProfileSave">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h4 class="card-title">Point Policy</h4>
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Profile Photo:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Profile Preview:</label>
                                    <div class="custom-file">
                                        <center><img class="rounded-circle header-profile-user" src="{{URL::asset('public/assets/images/users/avatar-1.jpg')}}"
                                        alt="Header Avatar"></center>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Name:</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Name:">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">amount</label>
                                    <input class="form-control" type="number" wire:model.lazy="amount" placeholder="Amount" step="any">
                                    @error('amount') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">point value</label>
                                    <input class="form-control" type="number" wire:model.lazy="point_value" placeholder="point value" step="any">
                                    @error('point_value') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">point amount</label>
                                    <input class="form-control" type="number" wire:model.lazy="point_amount" placeholder="point amount" step="any">
                                    @error('point_amount') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- previous description --}}
                            {{-- <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control" wire:model.lazy="description" placeholder="Description"></textarea>
                                </div>
                            </div> --}}

                             {{-- summernote texteditor --}}
                             <div class=col-lg-12>
                                <div wire:ignore class="form-group">
                                    <label for="basicpill-lastname-input">Description</label>
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

                        <div class="col-lg-12">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-success w-lg waves-effect waves-light">Update</button></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
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

