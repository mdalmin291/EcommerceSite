@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Change Password
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <form wire:submit.prevent="changePassword" role="form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="offset-xl-4 col-lg-4">
                                        <label for="state.current_password">Current Password</label>
                                        <input type="password" class="form-control" id="state.current_password" wire:model="state.current_password" placeholder="Curren Password"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="offset-xl-4 col-lg-4">
                                        <label for="state.password">New Password</label>
                                        <input type="password" class="form-control" id="state.password" wire:model="state.password"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="offset-xl-4 col-lg-4">
                                        <label for="state.password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="state.password_confirmation" wire:model="state.password_confirmation"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="offset-xl-4 col-lg-4">
                                        <center><button type="submit" class="btn btn-success w-lg waves-effect waves-light">Change Password</button></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

@endpush

