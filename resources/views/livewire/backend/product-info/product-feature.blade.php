@push('css')

@endpush
<div>
    <x-slot name="title">
        FEATURE PRODUCT INFO
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Feature Product Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="featureProductInfoModal"><i class="mdi mdi-plus mr-1"></i>Feature Product Info</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="featureProductInfoTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="featureProductInfoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Feature Product Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="FeautureProductSave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Enter Unit Code">
                                    @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input"> Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Enter Unit Name">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Position</label>
                                    <input class="form-control" type="number" step="any" wire:model.lazy="position" placeholder="Enter  Position">
                                    @error('position') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Status</label>
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
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        {{-- Start Delete Modal --}}
        <div class="modal fade" id="DeletePopup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this records?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" wire:click="ConfirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}


</div>
@push('scripts')
    <script>
 function callEdit(id) {
        @this.call('FeatureProductEdit', id);
    }
    function callDelete(id) {
        @this.call('FeatureProductDelete', id);
    }
        $(document).ready(function () {
            var datatable = $('#featureProductInfoTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.feature_product_table')}}",
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
                        title: 'Position',
                        data:  'position',
                        name:  'position'
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

