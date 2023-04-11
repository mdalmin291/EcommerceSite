@push('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
@endpush

<div>
    <x-slot name="title">
        Order Invoice
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                       <div class="col-md-3"></div>
                       <div class="col-md-6">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body m-0 p-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body m-0 p-0">
                                                        <div class="row mb-2">
                                                           <div class="col-md-2"></div>
                                                           <div class="col-md-8">
                                                               <center>
                                                                   <img src="{{ asset('storage/photo/'.Auth::user()->profile_photo_path) }}" alt="Logo" style="width: 100px; height: 100px;" class="avatar-md rounded-circle img-thumbnail">
                                                               </center>
                                                               <h3 class="text-center">
                                                                   {{-- @if($profileSetting)
                                                                    {{ $profileSetting->business_name }}
                                                                   @endif --}}
                                                                </h3>
                                                                <h6 class="text-center">
                                                                   {{-- @if($profileSetting)
                                                                   {{ $profileSetting->phone }}
                                                                  @endif --}}
                                                                </h6>
                                                                <p class="text-center">
                                                                   {{-- @if($profileSetting)
                                                                   {{ $profileSetting->address }}
                                                                  @endif --}}
                                                                </p>
                                                                 <hr>
                                                                 <p><span class="font-weight-bold">Invoice</span><?php echo str_repeat('&nbsp;', 45); ?>:<?php echo str_repeat('&nbsp;', 60); ?>
                                                                    @if ($Invoice)
                                                                       {{ $Invoice->code }}
                                                                    @endif
                                                                    </p>
                                                                 <p><span class="font-weight-bold">Date</span><?php echo str_repeat('&nbsp;', 50); ?>:<?php echo str_repeat('&nbsp;', 60); ?>
                                                                  @if ($Invoice)
                                                                    {{ $Invoice->date }}
                                                                  @endif
                                                                </p>
                                                                 <p><span class="font-weight-bold">Member</span><?php echo str_repeat('&nbsp;', 43); ?>:<?php echo str_repeat('&nbsp;', 60); ?>
                                                                   @if ($Invoice)
                                                                     {{ $Invoice->Contact->name }}
                                                                   @endif
                                                                </p>
                                                                 <p><span class="font-weight-bold">Member Points</span><?php echo str_repeat('&nbsp;', 30); ?>:<?php echo str_repeat('&nbsp;', 60); ?>{{ $memberPoint }}</p>
                                                                 <p><span class="font-weight-bold">Sales By</span><?php echo str_repeat('&nbsp;', 43); ?>:<?php echo str_repeat('&nbsp;', 60); ?>
                                                                    @if ($Invoice)
                                                                    {{ $Invoice->User->name }}
                                                                    @endif
                                                                 </p>

                                                                 <div>
                                                                    <table class="table table-bordered mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th><center>Item</center></th>
                                                                                <th><center>Price</center></th>
                                                                                <th><center>Quantity</center></th>
                                                                                <th><center>Vat</center></th>
                                                                                <th><center>Total</center></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            @foreach ($Invoice->StockManager as $stockItem)
                                                                            <tr>
                                                                                <th scope="row"><center>{{$stockItem->Item->name}}</center></th>
                                                                                <td>
                                                                                    <center>
                                                                                        {{ $stockItem->sale_price }}
                                                                                     </center>
                                                                                </td>
                                                                                <td>
                                                                                    <center>
                                                                                        {{ $stockItem->quantity }}
                                                                                    </center>
                                                                                </td>
                                                                                <td><center>  {{ $stockItem->vat }}</center></td>
                                                                                <td><center>  {{ $stockItem->sale_subtotal }}</center></td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                 </div>
                                                                 @if ( $Invoice)
                                                                 <p class="mt-2"><span class="font-weight-bold">Sub Total</span><?php echo str_repeat('&nbsp;', 44); ?>:<?php echo str_repeat('&nbsp;', 40); ?>

                                                                   {{ $Invoice->subtotal }}

                                                                </p>
                                                                @if ($Invoice->vat_total)
                                                                 <p><span class="font-weight-bold">Total Vat</span><?php echo str_repeat('&nbsp;', 45); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                      {{ $Invoice->vat_total }}
                                                                 </p>
                                                                @endif
                                                                  @if ( $Invoice->discount)
                                                                     <p><span class="font-weight-bold">Total Discount</span><?php echo str_repeat('&nbsp;', 35); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                    {{ $Invoice->discount }}
                                                                   </p>
                                                                  @endif
                                                                @if ($Invoice->shipping_charge)
                                                                <p><span class="font-weight-bold">Shipping Charge</span><?php echo str_repeat('&nbsp;', 35); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                   {{ $Invoice->shipping_charge }}
                                                               </p>
                                                               @endif
                                                               @if ($Invoice->expense_point)
                                                               <p><span class="font-weight-bold">Expense Point</span><?php echo str_repeat('&nbsp;', 37); ?>:<?php echo str_repeat('&nbsp;', 40); ?>

                                                                     {{ $Invoice->expense_point }}

                                                                   </p>
                                                                <p><span class="font-weight-bold">Ex.Point Amount</span><?php echo str_repeat('&nbsp;', 37); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                   {{ $Invoice->expense_point_amount }}</p>
                                                                   @endif
                                                                 <p><span class="font-weight-bold">Net Amount</span><?php echo str_repeat('&nbsp;', 40); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                    {{ $Invoice->grand_total }}
                                                                </p>
                                                                 <p><span class="font-weight-bold">Paid Amount</span><?php echo str_repeat('&nbsp;', 37); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                    @if ($Invoice)
                                                                      {{ $Invoice->paid_amount }}
                                                                    @endif
                                                                   </p>
                                                                   <p><span class="font-weight-bold"> @if($Invoice->due>=0)Due Amount @else Change Amount @endif </span><?php echo str_repeat('&nbsp;', 37); ?>:<?php echo str_repeat('&nbsp;', 40); ?>
                                                                         {{ abs($Invoice->due) }}
                                                                      </p>
                                                                   @endif

                                                                 <p>Thank You For Shopping. Come again!!</p>

                                                           </div>
                                                           <div class="col-md-2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       </div>
                       <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
        <!-- Init js-->
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

@endpush


