<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-right font-size-16">
                            Purchase # {{$PurchaseId}}<br>
                            <address>
                                Date: {{$PurchaseInvoice->purchase_date}}<br><br>
                            </address>
                        </h4>
                        <div class="mb-4">
                            <img src="@if($InvoiceSetting) {{ asset('storage/photo/'.$InvoiceSetting->logo)}}@endif" alt="logo" style="height:40px;"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Billed To:</strong><br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->first_name}} {{$PurchaseInvoice->Contact->last_name}} @endif<br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->address}} @endif<br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->phone}} @endif<br>
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>Supplier</strong><br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->first_name}} {{$PurchaseInvoice->Contact->last_name}} @endif<br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->address}} @endif<br>
                               @if (isset($PurchaseInvoice->Contact)) {{$PurchaseInvoice->Contact->phone}} @endif<br>
                            </address>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method:</strong><br>
                                Visa ending **** 4242<br>
                                jsmith@email.com
                            </address>
                        </div>
                        <div class="col-sm-6 mt-3 text-sm-right">
                            <address>
                                <strong>Purchase Date:</strong><br>
                                {{$PurchaseInvoice->purchase_date}}<br><br>
                            </address>
                        </div>
                    </div> --}}
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Purchase summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">SL.</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=0;
                                    $subTotal=0;
                                @endphp
                             @foreach ($PurchaseInvoice->PurchaseInvoiceDetail as $purchaseInvoiceDetail)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <img class="rounded" @if(isset($purchaseInvoiceDetail->Product->ProductImageFirst)) src="{{ asset('storage/photo/'.$purchaseInvoiceDetail->Product->ProductImageFirst->image)}}" @endif  style="height:30px; weight:30px;" alt="Image2" class="img-circle img-fluid">
                                    </td>
                                    <td>@if (isset($purchaseInvoiceDetail->Product)){{$purchaseInvoiceDetail->Product->name}} @endif</td>
                                    <td>@if (isset($purchaseInvoiceDetail)){{$purchaseInvoiceDetail->quantity}} @endif</td>
                                    <td class="text-right">@if (isset($purchaseInvoiceDetail)){{$purchaseInvoiceDetail->unit_price * $purchaseInvoiceDetail->quantity}} @endif</td>
                                    @php
                                        $subTotal += $purchaseInvoiceDetail->unit_price * $purchaseInvoiceDetail->quantity;
                                    @endphp
                                </tr>
                              @endforeach
                              <tr>
                                <td colspan="4" class="text-right">Sub Total</td>
                                <td class="text-right">
                                    @if($currencySymbol)
                                        {{ $currencySymbol->symbol }}
                                    @endif
                                    {{$subTotal}}
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="3" colspan="3" style="border: none;">
                                    {{-- Start Payment Method --}}
                                    <center>
                                    <table class="table-info">
                                        <thead>
                                            <tr>
                                              <th>Method</th>
                                              <th>Date</th>
                                              <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($PurchaseInvoice->PurchasePayment as $PurchasePayment)
                                            <tr>
                                               <td>@if (isset($PurchasePayment->PaymentMethod)){{$PurchasePayment->PaymentMethod->name}} @endif</td>
                                               <td>@if (isset($PurchasePayment)){{$PurchasePayment->date}} @endif</td>
                                               <td>
                                                @if($currencySymbol)
                                                   {{ $currencySymbol->symbol }}
                                                @endif
                                                   {{$PurchasePayment->total_amount}}
                                               </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </center>
                                    {{-- End Payment Method --}}
                                </td>
                                <td colspan="1" class="border-0 text-right">
                                    <strong>Discount</strong></td>
                                <td class="border-0 text-right">
                                    @if($currencySymbol)
                                        {{ $currencySymbol->symbol }}
                                    @endif
                                    @if($PurchaseInvoice->discount)
                                         {{$PurchaseInvoice->discount}}
                                    @else
                                    0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" class="border-0 text-right">
                                    <strong>Shipping</strong></td>
                                <td class="border-0 text-right">
                                    @if($currencySymbol)
                                       {{ $currencySymbol->symbol }}
                                    @endif
                                    @if($PurchaseInvoice->shipping_charge)
                                       {{$PurchaseInvoice->shipping_charge}}
                                       @else
                                       0
                                       @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" class="border-0 text-right">
                                    <strong>Total</strong></td>
                                <td class="border-0 text-right">
                                    <h4 class="m-0">
                                        @if($currencySymbol)
                                           {{ $currencySymbol->symbol }}
                                        @endif
                                        {{$subTotal + $PurchaseInvoice->shipping_charge - $PurchaseInvoice->discount}}
                                    </h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <div class="float-left p-1">
                            @if($InvoiceSetting)
                               {!!$InvoiceSetting->invoice_footer!!}
                            @endif
                        </div>
                        <div class="float-right d-print-none">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Column -->
    </div>
    <!-- end row -->


<footer class="footer">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <script>document.write(new Date().getFullYear())</script> © Skote.
        </div>
        <div class="col-sm-6">
            <div class="text-sm-right d-none d-sm-block">
                Design & Develop by Themesbrand
            </div>
        </div>
    </div>
</div>
</footer>
</div>
