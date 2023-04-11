@push('css')

@endpush
<div>
    <x-slot name="title">
        Invoice setting
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="invoiceSettingSave">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h4 class="card-title">Invoice setting</h4>
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
                                    <label for="basicpill-firstname-input">Type</label>
                                    <select class="form-control" wire:model.lazy="type">
                                        <option value="">Select Type</option>
                                        <option value="Invoice">Invoice</option>
                                        <option value="Receipt">Receipt</option>
                                    </select>
                                    @error('type') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Invice Header:</label>
                                    <input class="form-control" type="text" wire:model.lazy="invoice_header" placeholder="Invoice Header">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Logo  (517.38*492 jpg)
                                        @if (!$logo)
                                        @if($invoiceInfoDetails)
                                           <img src="{{ asset('storage/photo/'.$invoiceInfoDetails->logo)}}"  style="height:30px; weight:30px;" alt="Image2" class="img-circle img-fluid">
                                        @endif
                                       @endif

                                       @if ($logo)
                                            <img src="{{ $logo->temporaryUrl() }}" style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                        @endif
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" wire:model.lazy="logo" x-ref="logo">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Invoice Title:</label>
                                    <input class="form-control" type="text" wire:model.lazy="invoice_title" placeholder="Invoice Title:">
                                    {{-- @error('invoice_title') <span class="error">{{ $message }}</span> @enderror --}}
                                </div>
                            </div>

                            {{-- input footer --}}
                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Invoice Footer:</label>
                                    <input class="form-control" type="text" wire:model.lazy="invoice_footer" placeholder="Invoice Footer:">
                                </div>
                            </div> --}}


                             {{-- sumernote  texteditor --}}
                             <div class=col-lg-12>
                                <div wire:ignore class="form-group">
                                    <label for="basicpill-lastname-input">Invoice Footer</label>
                                    <textarea class="form-control" id="invoice_footer" rows="3"  wire:model.lazy="invoice_footer" placeholder="Footer Description"></textarea>
                                 </div>
                             </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Vat Registration Number:</label>
                                    <input class="form-control" type="text" wire:model.lazy="vat_reg_no" placeholder="Vat Registration Number">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Vat Area Code:</label>
                                    <input class="form-control" type="text" wire:model.lazy="vat_area_code" placeholder="Vat Area code">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Vat Text:</label>
                                    <input class="form-control" type="text" wire:model.lazy="vat_text" placeholder="Vat Text">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Web Site:</label>
                                    <input class="form-control" type="text" wire:model.lazy="website" placeholder="Website address">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Currency</label>
                                    <select class="form-control" wire:model.lazy="currency_id">
                                        <option value="">Select Currency</option>
                                        @foreach($Currencies as $Currency)
                                            <option value="{{$Currency->id}}">{{$Currency->symbol}}</option>
                                        @endforeach
                                    </select>
                                    @error('currency_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <option value="">Select Branch</option>
                                    <select class="form-control" wire:model.lazy="branch_id">
                                        <option value="">Select Branch</option>
                                                @foreach ($Branches as $Branch)
                                                    <option value="{{ $Branch->id }}">{{ $Branch->name }}</option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_paid_due_hide" type="checkbox"
                                           wire:model.lazy="is_paid_due_hide"@if ($is_paid_due_hide) checked @endif>
                                      <label class="form-check-label" for="flexCheckDefault">
                                         is_paid_due_hide
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_memo_no_hide" type="checkbox"
                                           wire:model.lazy="is_memo_no_hide"@if ($is_memo_no_hide) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        is_memo_no_hide
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_chalan_no_hide" type="checkbox"
                                           wire:model.lazy="is_chalan_no_hide"@if ($is_chalan_no_hide) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        is_chalan_no_hide
                                    </label>
                                </div>
                            </div>

                            {{--                            <div class="col-lg-4">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label for="basicpill-firstname-input">Status:</label>--}}
                            {{--                                    <input class="form-control" type="text" wire:model.lazy="city" placeholder="City">--}}
                            {{--                                    @error('city') <span class="error">{{ $message }}</span> @enderror--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-success w-lg waves-effect waves-light" style="margin-top: 39px;
                                  margin-right: 180px;" wire:target="logo" wire:loading.attr="disabled">Update</button></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
     $(document).ready(function () {
  if ($("#invoice_footer").length > 0) {
    tinymce.init({
      selector: "textarea#invoice_footer",
      height: 200,
	   forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
            @this.set('invoice_footer', editor.getContent());
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

