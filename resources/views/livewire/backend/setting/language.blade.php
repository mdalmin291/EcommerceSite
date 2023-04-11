@push('css')
@endpush
<div>
    <style>
        /* The container */
        .container-checkbox {
            display: block;
            position: relative;
            /* padding-left: 35px; */
            margin-top: 5px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 18px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
             user-select: none;
        }
    </style>
    <x-slot name="title">
        Languages
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Language List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"
                                    wire:click="languageModal"><i class="mdi mdi-plus mr-1"></i>Language</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="languageTable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="languageModal" tabindex="-1" role="dialog"
        aria-labelledby="languageModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="languageModal">Language</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="languageSave">
                    <div class="modal-body">
                        {{-- Start Language Input --}}
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control" wire:model.lazy="language">
                                    <option value="">Choose a Language</option>
                                    <option value="AF">Afrikaans</option>
                                    <option value="SQ">Albanian</option>
                                    <option value="AR">Arabic</option>
                                    <option value="HY">Armenian</option>
                                    <option value="EU">Basque</option>
                                    <option value="BN">Bengali</option>
                                    <option value="BG">Bulgarian</option>
                                    <option value="CA">Catalan</option>
                                    <option value="KM">Cambodian</option>
                                    <option value="ZH">Chinese (Mandarin)</option>
                                    <option value="HR">Croatian</option>
                                    <option value="CS">Czech</option>
                                    <option value="DA">Danish</option>
                                    <option value="NL">Dutch</option>
                                    <option value="EN">English</option>
                                    <option value="ET">Estonian</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finnish</option>
                                    <option value="FR">French</option>
                                    <option value="KA">Georgian</option>
                                    <option value="DE">German</option>
                                    <option value="EL">Greek</option>
                                    <option value="GU">Gujarati</option>
                                    <option value="HE">Hebrew</option>
                                    <option value="HI">Hindi</option>
                                    <option value="HU">Hungarian</option>
                                    <option value="IS">Icelandic</option>
                                    <option value="ID">Indonesian</option>
                                    <option value="GA">Irish</option>
                                    <option value="IT">Italian</option>
                                    <option value="JA">Japanese</option>
                                    <option value="JW">Javanese</option>
                                    <option value="KO">Korean</option>
                                    <option value="LA">Latin</option>
                                    <option value="LV">Latvian</option>
                                    <option value="LT">Lithuanian</option>
                                    <option value="MK">Macedonian</option>
                                    <option value="MS">Malay</option>
                                    <option value="ML">Malayalam</option>
                                    <option value="MT">Maltese</option>
                                    <option value="MI">Maori</option>
                                    <option value="MR">Marathi</option>
                                    <option value="MN">Mongolian</option>
                                    <option value="NE">Nepali</option>
                                    <option value="NO">Norwegian</option>
                                    <option value="FA">Persian</option>
                                    <option value="PL">Polish</option>
                                    <option value="PT">Portuguese</option>
                                    <option value="PA">Punjabi</option>
                                    <option value="QU">Quechua</option>
                                    <option value="RO">Romanian</option>
                                    <option value="RU">Russian</option>
                                    <option value="SM">Samoan</option>
                                    <option value="SR">Serbian</option>
                                    <option value="SK">Slovak</option>
                                    <option value="SL">Slovenian</option>
                                    <option value="ES">Spanish</option>
                                    <option value="SW">Swahili</option>
                                    <option value="SV">Swedish </option>
                                    <option value="TA">Tamil</option>
                                    <option value="TT">Tatar</option>
                                    <option value="TE">Telugu</option>
                                    <option value="TH">Thai</option>
                                    <option value="BO">Tibetan</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TR">Turkish</option>
                                    <option value="UK">Ukrainian</option>
                                    <option value="UR">Urdu</option>
                                    <option value="UZ">Uzbek</option>
                                    <option value="VI">Vietnamese</option>
                                    <option value="CY">Welsh</option>
                                    <option value="XH">Xhosa</option>
                                </select>
                                @error('language') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <input type="checkbox" name="is_default" wire:model.lazy="is_default">
                                    <label>Is Default?</label> --}}
                                    <label class="container-checkbox">
                                        <input type="checkbox" wire:model.lazy="is_default">
                                        <span class="checkmark">Is Default</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- Start Language Input --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@push('scripts')
<script>
    function callEdit(id) {
        @this.call('languageEdit', id);
    }
    function callDelete(id) {
        @this.call('languageDelete', id);
    }
        $(document).ready(function () {
            var datatable = $('#languageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.language_list')}}",
                columns: [
{
title: 'SL',
data: 'id'
},
{
title: 'Language',
data: 'language',
name: 'language'
},
{
title: 'Is Default',
data: 'is_default',
name: 'is_default'
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
