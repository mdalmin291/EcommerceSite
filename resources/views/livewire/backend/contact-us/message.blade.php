@push('css')

@endpush
<div>
    <x-slot name="title">
        Message List
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4>Message List</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-centered mb-0 table-nowrap">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>SL</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Messages</th>
                                            {{-- <th>Status</th> --}}
                                            <th colspan="2">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=0;
                                        @endphp

                                         @foreach ($CustomerMessages as $CustomerMessage)

                                        <tr>
                                            <td>
                                                <a href="javascript: void(0);" class="text-body font-weight-bold">{{ ++$i }}</a>
                                            </td>
                                            <td>
                                                {{$CustomerMessage->first_name}}
                                            </td>
                                            <td>
                                                {{$CustomerMessage->last_name}}
                                            </td>

                                            <td>
                                              {{$CustomerMessage->email}}
                                            </td>

                                            <td>
                                                  {{$CustomerMessage->phone}}
                                            </td>
                                            <td>
                                                {{$CustomerMessage->subject}}
                                            </td>
                                            <td>
                                                {{$CustomerMessage->message}}
                                            </td>

                                            <td>
                                                <button class="btn btn-danger btn-sm" wire:click="deleteMessage({{ $CustomerMessage->id }})"><i class="bx bx-window-close font-size-12"></i></button>
                                            </td>
                                            {{-- <td>
                                                <a class="btn btn-info btn-sm btn-block mb-1" href="{{ route('order.order-invoice',['id'=>$order->id]) }}"><i class="fas fa-eye font-size-18"></i></a>
                                                <div wire:ignore>
                                                <select class="form-control" style="border-radius: 15px;background-color:rgb(229, 240, 219);" wire:model.lazy="status" wire:change="OrderStatus">
                                                     <option value="">Status</option>
                                                     <option value="approved {{$order->id}}">Approved</option>
                                                     <option value="cancel {{$order->id}}">Cancel</option>
                                                </select>
                                                </div>
                                            </td> --}}
                                        </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')

        @endpush


