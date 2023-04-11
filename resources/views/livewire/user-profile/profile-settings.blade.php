@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endpush
<div>
    <x-slot name="title">
       Profile Setting
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="ProfileSave">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h4 class="card-title">Profile Setting</h4>
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Business Name:</label>
                                    <input class="form-control" type="text" wire:model.lazy="business_name" placeholder="Business Name:">
                                    @error('business_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Profile Photo (517.38*492 jpg)</label>
                                    <div class="custom-file">
                                        {{-- <input type="file" wire:model.lazy="image" class="custom-file-input" id="customFile"> --}}

                                        <input type="file" wire:model.lazy="profile_photo" x-ref="image">
                                        @if (!$profile_photo)
                                        @if($ProfileSetting)
                                        <img src="{{ asset('storage/photo/'.$ProfileSetting->profile_photo)}}"  style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                        @endif
                                        @endif
                                        @if ($profile_photo)
                                        <img src="{{ $profile_photo->temporaryUrl() }}" style="height:30px; weight:30px;" alt="Image" class="img-circle img-fluid">
                                        @endif
                                        {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                        @error('image') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Email:</label>
                                    <input class="form-control" type="text" wire:model.lazy="email" placeholder="Email:">
                                    @error('email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Your Name:</label>
                                    <input class="form-control" type="text" wire:model.lazy="name" placeholder="Your Name">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Address:</label>
                                    <input class="form-control" type="text" wire:model.lazy="address" placeholder="Address:">
                                    @error('address') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Postal Code:</label>
                                    <input class="form-control" type="text" wire:model.lazy="postal_code" placeholder="Postal Code:">
                                    @error('postal_code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">City:</label>
                                    <input class="form-control" type="text" wire:model.lazy="city" placeholder="City">
                                    @error('city') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Country</label>
                                        <select wire:model.lazy="country" class="form-control">
                                            <option value="">Select Country</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Dubai">Dubai</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        @error('country') <span class="error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-success w-lg waves-effect waves-light">Update</button></center>
                            </div>
                        </div>
                    </div>
                </form>
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

