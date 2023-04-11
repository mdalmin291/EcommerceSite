@push('css')

@endpush
<div>
    <x-slot name="title">
        Shipping Charge INFO
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Shipping Charge Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="ShippingChargeModal"><i class="mdi mdi-plus mr-1"></i>Shipping Charge</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="ShippingChargeTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="ShippingChargeMOdal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Shipping Charge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="ShippingChargeSave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Code">
                                    @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Title</label>
                                    <input class="form-control" type="text" wire:model.lazy="title" placeholder="Enter Title">
                                    @error('title') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Type</label>
                                    <select class="form-control" wire:model.lazy="type">
                                        <option value="">Select Type</option>
                                        <option value="price">Price</option>
                                        <option value="weight">Weight</option>
                                    </select>
                                    @error('type') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">From</label>
                                    <input class="form-control" type="text" wire:model.lazy="from" placeholder="From">
                                    @error('from') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">To</label>
                                    <input class="form-control" type="text" wire:model.lazy="to" placeholder="To">
                                    @error('to') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Shipping Fee</label>
                                    <input class="form-control" type="number" wire:model.lazy="shipping_fee" placeholder="Shipping Fee">
                                    @error('shipping_fee') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Country</label>
                                    <select class="form-control" wire:model.lazy="country_id">
                                        <option value="">Select Country</option>
                                        <option value="1">Bangladesh</option>
                                        <option value="2">Pakistan</option>
                                    </select>
                                    @error('country_id') <span class="error">{{ $message }}</span> @enderror
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
        @this.call('ShippingChargeEdit', id);
        }
        function callDelete(id) {
        @this.call('ShippingChargeDelete', id);
        }


        $(document).ready(function () {
            var datatable = $('#ShippingChargeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.shipping_charge')}}",
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
                        title: 'Title',
                        data:  'title',
                        name:  'title'
                    },
                    {
                        title: 'Type',
                        data:  'type',
                        name:  'type'
                    },
                    {
                        title: 'From',
                        data:  'from',
                        name:  'from'
                    },
                    {
                        title: 'To',
                        data:  'to',
                        name:  'to'
                    },
                    {
                        title: 'Shipping Fee',
                        data:  'shipping_fee',
                        name:  'shipping_fee'
                    },
                    {
                        title: 'Country',
                        data:  'country_id',
                        name:  'country_id'
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

