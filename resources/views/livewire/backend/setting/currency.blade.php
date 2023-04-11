@push('css')

@endpush
<div>
    <x-slot name="title">
        CURRENCY INFO
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Currency Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="currencyInfoModal"><i class="mdi mdi-plus mr-1"></i>Currency Info</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="CurrencyInfoTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="currencyInfoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Currency Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="currencySave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Currency Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Vat Code">
                                     @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Currency Title</label>
                                    <input class="form-control" type="text" wire:model.lazy="title" placeholder="Enter Currency Title">
                                     @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Symbol</label>
                                    <input class="form-control" type="text" wire:model.lazy="symbol" placeholder="Enter Symbol">
                                     @error('symbol') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Symbol Position</label>
                                    <input class="form-control" type="text" wire:model.lazy="symbol_position" placeholder="Enter Symbol Position">
                                    @error('symbol_position') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Symbol Position</label>
                                    <select class="form-control" wire:model.lazy="symbol_position">
                                        <option>Select</option>
                                        <option value="Prefix">Prefix</option>
                                        <option value="Surfix">Surfix</option>
                                    </select>
                                     @error('symbol_position') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">In Word Prefix</label>
                                    <input class="form-control" type="text" wire:model.lazy="in_word_prefix" placeholder="Enter In Word Prefix">
                                    @error('in_word_prefix') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">In Word Surfix</label>
                                    <input class="form-control" type="text" wire:model.lazy="in_word_surfix" placeholder="Enter In Word Surfix">
                                    @error('in_word_surfix') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">In Word Prefix Position</label>
                                    <select class="form-control" wire:model.lazy="in_word_prefix_position">
                                        <option>Select Branch</option>
                                        <option value="Prefix">Prefix</option>
                                        <option value="Surfix">Surfix</option>
                                    </select>
                                     @error('in_word_prefix_position') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">In Word Surfix Position</label>
                                    <select class="form-control" wire:model.lazy="in_word_surfix_position">
                                        <option>Select Option</option>
                                        <option value="Prefix">Prefix</option>
                                        <option value="Surfix">Surfix</option>
                                    </select>
                                     @error('in_word_surfix_position') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Status</label>
                                    <select class="form-control" wire:model.lazy="is_active">
                                        {{-- <option>Select Status</option> --}}
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
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@push('scripts')
    <script>
    function callEdit(id) {
        @this.call('currencyEdit', id);
    }
    function callDelete(id) {
        @this.call('currencyDelete', id);
    }
        $(document).ready(function () {
            var datatable = $('#CurrencyInfoTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.currency_table')}}",
                columns: [
                    {
                    title: 'SL',
                    data: 'id'
                },
                {
                    title: 'Currency Code',
                    data: 'code',
                    name:'code'
                },
                {
                    title: 'Title',
                    data: 'title',
                    name:'title'
                },
                {
                    title: 'Symbol',
                    data: 'symbol',
                    name:'symbol'
                },
                {
                    title: 'Symbol Position',
                    data: 'symbol_position',
                    name:'symbol_position'
                },
                {
                        title: 'Status',
                        data:  'is_active',
                        name:  'is_active'
                },
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
    </script>
@endpush

