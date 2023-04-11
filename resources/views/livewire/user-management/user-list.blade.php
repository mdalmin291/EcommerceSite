@push('css')
<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        USER LIST
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>User List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"
                                    wire:click="UserModal"><i class="mdi mdi-plus mr-1"></i> New User</button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div wire:ignore class="table-responsive">
                        <div wire:ignore class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="UserTable"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;"></table>
                        </div>
                    </div>
                    {{-- <div wire:ignore class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>User Code</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">1</a> </td>
                                    <td>#SK2540</td>
                                    <td>Neal Matthews</td>
                                    <td>
                                        $400
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">2</a> </td>
                                    <td>#SK2541</td>
                                    <td>Jamal Burnett</td>
                                    <td>
                                        $380
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-danger font-size-12">Chargeback</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">2</a> </td>
                                    <td>#SK2542</td>
                                    <td>Juan Mitchell</td>
                                    <td>
                                        $384
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">3</a> </td>
                                    <td>#SK2543</td>
                                    <td>Barry Dick</td>
                                    <td>
                                        $412
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">4</a> </td>
                                    <td>#SK2544</td>
                                    <td>Ronald Taylor</td>
                                    <td>
                                        $404
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-warning font-size-12">Refund</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">6</a> </td>
                                    <td>#SK2545</td>
                                    <td>Jacob Hunter</td>
                                    <td>
                                        $392
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">7</a> </td>
                                    <td>#SK2546</td>
                                    <td>William Cruz</td>
                                    <td>
                                        $374
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">9</a> </td>
                                    <td>#SK2548</td>
                                    <td>Dustin Moser</td>
                                    <td>
                                        $350
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">10</a> </td>
                                    <td>#SK2549</td>
                                    <td>Clark Benson</td>
                                    <td>
                                        $345
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-warning font-size-12">Refund</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="mr-3 text-success" data-toggle="modal" data-target=".UserPermission"><i class="bx bx-lock-alt font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="modal" data-target=".CustomerAccounts"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="sa-params"><i class="mdi mdi-close font-size-18"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!--  Modal content for the above example -->
    <div wire:ignore.self class="modal fade" id="UserPermission" tabindex="-1" role="dialog"
        aria-labelledby="userPermission" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="userPermission">User Permission List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Module Name</th>
                                            <th>Restictions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Sales</td>
                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> View
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Edit
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Delete
                                                    &nbsp;&nbsp;
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Purchase</td>
                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> View
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Edit
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Delete
                                                    &nbsp;&nbsp;
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>User Manager</td>
                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> View
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox2" value="option2"> Edit
                                                    &nbsp;&nbsp;
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox3" value="option3"> Delete
                                                    &nbsp;&nbsp;
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="UserModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="UserSave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="name"
                                        placeholder="Enter Name">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">Email</label>
                                        <input class="form-control" type="text" wire:model.lazy="email"
                                            placeholder="Enter Email">
                                        @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div> --}}

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Mobile</label>
                            <input class="form-control" type="text" wire:model.lazy="mobile" placeholder="Enter mobile">
                            @error('mobile') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="basicpill-firstname-input">Password</label>
                            <input class="form-control" type="password" wire:model.lazy="password"
                                placeholder="Enter Password">
                            @error('password') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="basicpill-firstname-input"> Type</label>
                            <select class="form-control" wire:model.lazy="type">
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="editor">Editor</option>
                                <option value="manager">Manager</option>
                                <option value="user">User</option>
                            </select>
                            @error('type') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="state.password">Password</label>
                                        <input type="password" class="form-control" id="state.password" wire:model="state.password" placeholder="Password"/>
                                        @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="state.password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="state.password_confirmation"
                    wire:model="state.password_confirmation" placeholder="Confirm Password" />
                @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div> --}}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<!-- /.modal -->

</div>
@push('scripts')
<script>
    function callPermission(id) {
        @this.call('UserPermission', id);
    }
    function callEdit(id) {
        @this.call('UserEdit', id);
    }
    function callDelete(id) {
        @this.call('UserDelete', id);
    }

    $(document).ready(function () {

        var datatable = $('#UserTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('data.user_table')}}",
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
