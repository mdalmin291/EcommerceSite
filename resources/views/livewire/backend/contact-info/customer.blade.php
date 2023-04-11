
@push('css')

@endpush
<div>
    <x-slot name="title">
        Customer INFO
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Customer Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="ContactModal"><i class="mdi mdi-plus mr-1"></i>Customer</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="ContactTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="ContactInfoSave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Contact Category</label>
                                    <select class="form-control" wire:model.lazy="contact_category_id">
                                        <option value="">Select Contact Category</option>
                                        @foreach($customerCategories as $customerCategory)
                                            <option value="{{$customerCategory->id}}">{{$customerCategory->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('contact_category_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">First Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="first_name" placeholder="First Name">
                                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Last Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="last_name" placeholder="Last Name">
                                    @error('last_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Address</label>
                                    <input class="form-control" type="text" wire:model.lazy="address" placeholder="Enter Address">
                                    @error('address') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Shipping Address</label>
                                    <input class="form-control" type="text" wire:model.lazy="shipping_address" placeholder="Enter Shipping address">
                                    @error('shipping_address') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Phone</label>
                                    <input class="form-control" type="text" wire:model.lazy="phone" placeholder="Enter Phone">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Mobile</label>
                                    <input class="form-control" type="text" wire:model.lazy="mobile" placeholder="Enter Mobile Number">
                                    @error('mobile') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Email</label>
                                    <input class="form-control" type="text" wire:model.lazy="email" placeholder="Enter email address">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Due date</label>
                                    <input class="form-control" type="date" wire:model.lazy="due_date" placeholder="Give Due date">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Birth Day</label>
                                    <input class="form-control" type="date" wire:model.lazy="birthday" placeholder="Enter birthdate">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">opening Balance</label>
                                    <input class="form-control" type="text" wire:model.lazy="opening_balance" placeholder="Enter opening balance">
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Add password</label>
                                    <input class="form-control" type="text" wire:model.lazy="opening_balance" placeholder="Add password">
                                    @error('opening_balance') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}

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
        @this.call('contactEdit', id);
        }
        function callDelete(id) {
        @this.call('contactDelete', id);
        }


        $(document).ready(function () {
            var datatable = $('#ContactTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.customer_table')}}",
                columns: [
                    {
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'First Name',
                        data:  'first_name',
                        name:  'first_name'
                    },
                    {
                        title: 'Last Name',
                        data:  'last_name',
                        name:  'last_name'
                    },
                    {
                        title: 'Address',
                        data:  'address',
                        name:  'address'
                    },
                    {
                        title: 'Shipping Address',
                        data:  'shipping_address',
                        name:  'shipping_address'
                    },
                    {
                        title: 'Mobile',
                        data:  'mobile',
                        name:  'mobile'
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
