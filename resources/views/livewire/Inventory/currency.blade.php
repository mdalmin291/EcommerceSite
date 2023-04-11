@push('css')
    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush

<div>
    <x-slot name="title">
        Currency
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Currency Details</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"
                                        wire:click="CurrencyModel"><i class="mdi mdi-plus mr-1"></i>Add Currency Details</button>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="CategoryTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="CurrencyModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Currency details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="CurrencySave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Select Currency Title
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">BD Taka</a></li>
                                        <li><a href="#">USA Doller</a></li>
                                        <li><a href="#">Indian Rupi</a></li>
                                    </ul>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="basicpill-firstname-input">Category Code</label>--}}
{{--                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Cost code">--}}
{{--                                    @error('code') <span class="error">{{ $message }}</span> @enderror--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Currency Rate</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter Currency rate">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Prefix</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter prefix">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Suffix</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter Suffix">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Symbol</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter Symbol">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Status</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter Status">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label">Image (517.38*492 jpg)</label>--}}
{{--                                    <div class="custom-file">--}}
{{--                                        --}}{{-- <input type="file" wire:model.lazy="image" class="custom-file-input" id="customFile"> --}}

{{--                                        <input type="file" wire:model.lazy="image" x-ref="image">--}}

{{--                                        --}}{{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
{{--                                        @error('image') <span class="error">{{ $message }}</span> @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="basicpill-lastname-input">Branch</label>--}}
{{--                                    <select class="form-control" wire:model.lazy="branch_id">--}}
{{--                                        <option value="">Select Branch</option>--}}
{{--                                        <option value="1">Branch One</option>--}}
{{--                                        <option value="2">Branch Two</option>--}}

{{--                                    </select>--}}
{{--                                    @error('branch_id') <span class="error">{{ $message }}</span> @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

@push('scripts')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js -->
    <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush

