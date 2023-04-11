@push('css')

@endpush
<div>
    <x-slot name="title">
        Sms Setting
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="SmsSettingSave">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="search-box mr-2 mb-2 d-inline-block">
                                    <div class="position-relative">
                                        <h4 class="card-title">Sms Setting</h4>
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Username</label>
                                    <input class="form-control" type="text" wire:model.lazy="username" placeholder="Userame">
                                    @error('username') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Password</label>
                                    <input class="form-control" type="text" wire:model.lazy="password" placeholder="Password">
                                    @error('password') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Sender Id</label>
                                    <input class="form-control" type="text" wire:model.lazy="sender_id" placeholder="Sender Id">
                                    @error('sender_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">Business Name</label>
                                    <input class="form-control" type="text" wire:model.lazy="business_name" placeholder="Business Name">
                                    @error('business_name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_sale" type="checkbox"
                                           wire:model.lazy="is_sale" @if ($is_sale) checked @endif>
                                    <label class="form-check-label" for="is_sale">
                                        Sale
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_purchase" type="checkbox"
                                           wire:model.lazy="is_purchase" @if ($is_purchase) checked @endif>
                                    <label class="form-check-label" for="is_purchase">
                                        Purchase
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_receive" type="checkbox"
                                           wire:model.lazy="is_receive" @if ($is_receive) checked @endif>
                                    <label class="form-check-label" for="is_receive">
                                        Receive Collection
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_payment" type="checkbox"
                                           wire:model.lazy="is_payment" @if ($is_receive) checked @endif>
                                    <label class="form-check-label" for="is_payment">
                                        Payment
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_contact" type="checkbox"
                                           wire:model.lazy="is_contact" @if ($is_receive) checked @endif>
                                    <label class="form-check-label" for="is_contact">
                                        Contact
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="is_receivable" type="checkbox"
                                           wire:model.lazy="is_receivable" @if ($is_receive) checked @endif>
                                    <label class="form-check-label" for="is_receivable">
                                        Receivable
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <center><button type="submit" class="btn btn-success w-lg waves-effect waves-light" wire:target="logo" wire:loading.attr="disabled">Update</button></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')


@endpush

