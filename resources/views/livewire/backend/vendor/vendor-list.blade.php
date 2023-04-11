@push('css')

@endpush
<div>
    <x-slot name="title">
        Vendor Pending
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Vendor Pending Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            {{-- <div class="text-sm-right">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" wire:click="branchInfoModal"><i class="mdi mdi-plus mr-1"></i>Branch Info</button>
                            </div> --}}
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="VendorTable" style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    function callApprove(id) {
        @this.call('vendorApprove', id);
    }
    function callCancel(id) {
        @this.call('vendorCancel', id);
    }
        $(document).ready(function () {
            var datatable = $('#VendorTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('data.vendor_table')}}",
                columns: [
                    {
                        title: 'SL',
                        data: 'id'
                    },
                    {
                        title: 'Name',
                        data:  'name',
                        name:  'name'
                    },
                    {
                        title: 'Business Name',
                        data:  'business_name',
                        name:  'business_name'
                    },
                    {
                        title: 'Trade License',
                        data:  'trade_license',
                        name:  'trade_license'
                    },
                    {
                        title: 'Email',
                        data:  'email',
                        name:  'email'
                    },
                    {
                        title: 'Mobile',
                        data:  'mobile',
                        name:  'mobile'
                    },
                    {
                        title: 'Account Type',
                        data:  'account_type',
                        name:  'account_type'
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

