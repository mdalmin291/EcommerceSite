@push('css')

@endpush
<div>
    <x-slot name="title">
       CHART OF ACCOUNT
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Chart Of Account</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="ChartOfAccountModal"><i class="mdi mdi-plus mr-1"></i>Chart of Account Info</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="ChartOfAccountTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="ChartOfAccountModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Chart Of Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="ChartOfAccountSave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Code</label>
                                    <input class="form-control" type="text" wire:model.lazy="code" placeholder="Code">
                                    @error('code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Name">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="form-group" wire:ignore>
                                    <label class="control-label">Chart of Group</label>
                                    <select class="form-control" wire:model.lazy="chart_of_group_id" id="select2-dropdown1">
                                        <option value="">Select</option>
                                        @foreach ($chartofgroup as $chartofgroup)
                                        <option value="{{ $chartofgroup->id }}">{{ $chartofgroup->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('chart_of_group_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Balance Type</label>
                                    <select class="form-control" wire:model.lazy="balance_type">
                                        <option value="">Select</option>
                                        <option value="Debit">Debit</option>
                                        <option value="Credit">Credit</option>
                                    </select>
                                    @error('balance_type') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Opening Balance</label>
                                    <input class="form-control" type="text" wire:model.lazy="opening_balance" placeholder="opening Balance">
                                    @error('opening_balance') <span class="error">{{ $message }}</span> @enderror
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
        @this.call('chartOfAccountEdit', id);
        }
        function callDelete(id) {
        @this.call('chartOfAccountDelete', id);
        }

        $(document).ready(function () {
            var datatable = $('#ChartOfAccountTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.chart_Of_Account_table')}}",
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
                        title: 'Chart Of Group',
                        data:  'chart_of_group_id',
                        name:  'chart_of_group_id'
                    },

                    {
                        title: 'Balance Type',
                        data:  'balance_type',
                        name:  'balance_type'
                    },

                    {
                        title: 'Opening Balance',
                        data:  'opening_balance',
                        name:  'opening_balance'
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

