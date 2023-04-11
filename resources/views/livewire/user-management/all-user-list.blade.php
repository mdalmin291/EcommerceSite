<div>
    <x-slot name="title">
        Active User List
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Active User List</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div wire:ignore class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="AllUserTable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {

        var datatable = $('#AllUserTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('data.all_user_table')}}",
            columns: [
                {
                    title: 'SL',
                    data: 'id'
                },
                {
                    title: 'Name',
                    data: 'name',
                    name:'name'
                },
                // {
                //     title: 'Email',
                //     data: 'email',
                //     name:'email'
                // },
                {
                    title: 'Mobile',
                    data: 'mobile',
                    name:'mobile'
                },
                {
                    title: 'Type',
                    data: 'type',
                    name:'type'
                },
            ]
        });

        window.livewire.on('success', message => {
            datatable.draw(true);
        });
    });
</script>

@endpush


