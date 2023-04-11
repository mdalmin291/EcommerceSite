@push('css')

@endpush
<div>
    <x-slot name="title">
        Register
    </x-slot>
    <x-slot name="header">
        Register
    </x-slot>

		<!-- Main Container  -->
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Register</a></li>
            </ul>

            <div class="row">
                <div id="content" class="col-sm-12">
                    <h2 class="title">Register Account</h2>
                    <p>If you already have an account with us, please login at the <a href="#">login page</a>.</p>
                    @if($message)
                    <div class="alert alert-success text-center" role="alert">
                        <h3>{{ $message }}</h3>
                    </div>
                    @endif
                    <form wire:submit.prevent="contactSave" class="form-horizontal account-register clearfix">
                        <fieldset id="account">
                            <legend>Your Personal Details</legend>
                            <div class="form-group required" style="display: none;">
                                <label class="col-sm-2 control-label">Customer Group</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="customer_group_id" value="1" checked="checked"> Default
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="first_name" placeholder="First Name" id="input-firstname" class="form-control">
                                    @error('first_name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="last_name" placeholder="Last Name" id="input-lastname" class="form-control">
                                    @error('last_name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="email" wire:model.lazy="email" placeholder="E-Mail" id="input-email" class="form-control">
                                    @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="phone" placeholder="Telephone" id="input-telephone" class="form-control">
                                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Mobile</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="mobile" placeholder="Mobile" id="input-mobile" class="form-control">
                                    @error('mobile') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Contact Category</label>
                                <div class="col-sm-10">
                                    <select wire:model.lazy="contact_category_id" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        @foreach ($contactCategories as $contactCategory)
                                           <option value="{{ $contactCategory->id }}">{{ $contactCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('contact_category_id') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="address">
                            <legend>Your Address</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-address">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="address" placeholder="Address" id="input-address" class="form-control">
                                    @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shipping-address">Shipping Address</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="shipping_address" placeholder="Shipping Address" id="input-shipping-address" class="form-control">
                                    @error('shipping_address') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
                                <div class="col-sm-10">
                                    <input type="text" wire:model.lazy="post_code" placeholder="Post Code" id="input-postcode" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-country">Country</label>
                                <div class="col-sm-10">
                                    <select wire:model.lazy="country_id" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="1">Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-zone">State</label>
                                <div class="col-sm-10">
                                    <select wire:model.lazy="state" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        <option value="1">Dhaka</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Your Password</legend>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" wire:model.lazy="password" placeholder="Password" id="input-password" class="form-control">
                                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
                                <div class="col-sm-10">
                                    <input type="password" wire:model.lazy="password_confirmation" placeholder="Confirm Password" id="input-confirm" class="form-control">
                                    @error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Newsletter</legend>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subscribe</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="newsletter" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="newsletter" value="0" checked="checked"> No
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Pricing Tables</b></a>
                                <input class="box-checkbox" type="checkbox" name="agree" value="1"> &nbsp;
                                <input type="submit" value="Continue" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- //Main Container -->

</div>
@push('scripts')

@endpush
