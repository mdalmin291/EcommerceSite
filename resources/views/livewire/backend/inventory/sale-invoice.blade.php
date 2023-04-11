<div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h4 class="float-right font-size-16">
                                        Sale # {{$SaleId}}<br>
                                        Date: {{$SaleInvoice->sale_date}}
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
                                            {{$SaleInvoice->Contact->first_name}} {{$SaleInvoice->Contact->last_name}}<br>
                                            {{$SaleInvoice->Contact->address}}<br>
                                            {{$SaleInvoice->Contact->phone}}<br>

                                        </address>
                                    </div>
                                    <div class="col-sm-6 text-sm-right">
                                        <address class="mt-2 mt-sm-0">
                                            <strong>Shipped To:</strong><br>
                                            {{$SaleInvoice->Contact->first_name}} {{$SaleInvoice->Contact->last_name}}<br>
                                            {{$SaleInvoice->Contact->shipping_address}}<br>
                                            {{$SaleInvoice->Contact->phone}}<br>
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
                                            <strong>Sale Date:</strong><br>
                                            {{$SaleInvoice->sale_date}}<br><br>
                                        </address>
                                    </div>
                                </div> --}}
                                <div class="py-2 mt-3">
                                    <h3 class="font-size-15 font-weight-bold">Sale summary</h3>
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
                                         @foreach ($SaleInvoice->SaleInvoiceDetail as $saleInvoiceDetail)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                    <img class="rounded" @if($saleInvoiceDetail->Product->ProductImageFirst) src="{{ asset('storage/photo/'.$saleInvoiceDetail->Product->ProductImageFirst->image)}}" @endif  style="height:30px; weight:30px;" alt="Image2" class="img-circle img-fluid">
                                                </td>
                                                <td>{{$saleInvoiceDetail->Product->name}}</td>
                                                <td>{{$saleInvoiceDetail->quantity}}</td>
                                                <td class="text-right">{{$saleInvoiceDetail->unit_price * $saleInvoiceDetail->quantity}}</td>
                                                @php
                                                    $subTotal += $saleInvoiceDetail->unit_price * $saleInvoiceDetail->quantity;
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
                                        <tr >
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
                                                        @foreach ($SaleInvoice->SalePayment as $SalePayment)
                                                        <tr>
                                                           <td>{{$SalePayment->PaymentMethod->name}}</td>
                                                           <td>{{$SalePayment->date}}</td>
                                                           <td>
                                                            @if($currencySymbol)
                                                               {{ $currencySymbol->symbol }}
                                                            @endif
                                                               {{$SalePayment->total_amount}}
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
                                                @if($SaleInvoice->discount)
                                                     {{$SaleInvoice->discount}}
                                                @else
                                                0
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- <td colspan="3"></td> --}}
                                            <td colspan="1" class="border-0 text-right">
                                                <strong>Shipping</strong></td>
                                            <td class="border-0 text-right">
                                                @if($currencySymbol)
                                                   {{ $currencySymbol->symbol }}
                                                @endif
                                                @if($SaleInvoice->shipping_charge)
                                                   {{$SaleInvoice->shipping_charge}}
                                                   @else
                                                   0
                                                   @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            {{-- <td colspan="3"></td> --}}
                                            <td colspan="1" class="border-0 text-right">
                                                <strong>Total</strong></td>
                                            <td class="border-0 text-right">
                                                <h4 class="m-0">
                                                    @if($currencySymbol)
                                                       {{ $currencySymbol->symbol }}
                                                    @endif
                                                    {{$subTotal + $SaleInvoice->shipping_charge - $SaleInvoice->discount}}
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
