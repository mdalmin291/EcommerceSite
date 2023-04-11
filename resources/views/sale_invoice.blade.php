<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Invoice</title>
    <base href="/" />

    <style>
        h6 {
            margin: 0px;
            padding: 0px;
            font-size: 11px;
            font-weight: normal;
        }

        body {
            font-family: tahoma;
            font-size: 11px;
            margin: 0px;
            padding: 0px;
        }

        #invoice_page {
            width: 265px;
        }

        table {
            font-size: 11px;
            border-collapse: collapse;
            width: 100%;
        }

        .inv_item_row {
            /*border-bottom:1px solid gray;*/
        }

            .inv_item_row td, .inv_item_row th {
                padding: 0.5px 0px;
            }
    </style>
    <script>
        function printBody() {
            window.print();
        }
    </script>

</head>
<body onload="printBody()">
    <div id="invoice_page">
        <div class="header">
            <div style="padding:5px 0;font-size:11px;border-bottom:1px dashed #000;text-align:center;">
                <strong><img class="img-responsive" src="@if(isset($InvoiceSetting)) {{ asset('storage/photo/'.$InvoiceSetting->logo)}}@endif"  height="50px"></strong>
                <br>
                {{-- <h2 style="border-bottom:1px solid gray;margin:0 auto;font-size:20px;">{{$Invoice->token_no}}</h2> --}}
                <strong style="font-size: 20px">{{$CompanyInfo->name}}</strong><br>
                {{$CompanyInfo->address}}<br />
                {{$companyInfo->mobile}}<br />
                {{$CompanyInfo->email}}<br />
               @if($InvoiceSetting) {{$InvoiceSetting->website}} @endif
            </div>
            @if($InvoiceSetting->vat_reg_no) <h6 style="margin-top:5px;"><strong>VAT REG NO. :</strong> {{$InvoiceSetting->vat_reg_no}} </h6>@endif
            @if($InvoiceSetting->vat_area_code)<h6><strong>VAT AREA CODE :</strong>   {{$InvoiceSetting->vat_area_code}} </h6><br>@endif
            <div align="center" style="border-bottom:1px dashed #333;">INVOICE # @if($Invoice) {{$Invoice->code}} @endif</div>
            <h6 style="margin:5px 0px"><strong>Date:</strong> @if(isset($Invoice->created_at)) {{$Invoice->created_at->format('d-m-Y')}} @endif</h6>
            @if(isset($Invoice->Contact->first_name)) <h6 style="margin:5px 0px"><strong>Customer:</strong>  {{$Invoice->Contact->first_name}} </h6> @endif
            @if(isset($Invoice->Contact->mobile)) <h6 style="margin:5px 0px"><strong>Mobile:</strong>  {{$Invoice->Contact->mobile}} </h6> @endif
            @if(isset($Invoice->Contact->address)) <h6 style="margin:5px 0px"><strong>Address:</strong>  {{$Invoice->Contact->address}} </h6> @endif
            {{-- <h6 style="margin:5px 0px"><strong>Customer Name:</strong> @if($Invoice) {{$Invoice->Contact->name}} @endif</h6> --}}
            {{-- @if($Invoice->Waiter)   <h6 style="margin:5px 0px"><strong>Waiter :</strong>  {{$Invoice->Waiter->name}}</h6>@endif --}}
            {{-- @if($Invoice->Table)<h6 style="margin:5px 0px"><strong>Table No. :</strong> {{$Invoice->Table->name}}</h6>@endif --}}
            {{-- <h6 style="margin:5px 0px"><strong>Cashier. :</strong> @if($Invoice->User){{$Invoice->User->name}}@endif</h6> --}}

            <div style="border-bottom:1px dashed #333;"></div>
        </div>
        <div class="inv_body">
            <table border="0">
                <thead>
                    <tr style="border-bottom:1px solid gray" class="inv_item_row">
                        <th>###</th>
                        <th style="text-align:center">Item Description</th>
                        <th style="text-align:center">Price</th>
                        <th style="text-align:center">Qty</th>
                        <th style="text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp
                    @foreach ($Invoice->SaleInvoiceDetail as $stockManager)
                    @php $i++ @endphp
                        <tr class="inv_item_row">
                            <td align="center">{{$i}}</td>
                            <td align="center"> @if($stockManager->Product) {{$stockManager->Product->name}} @endif</td>
                            <td align="center">{{$stockManager->unit_price}} </td>
                            <td align="center">{{$stockManager->quantity}} </td>
                            <td align="right" style="text-align:right;">{{$stockManager->unit_price * $stockManager->quantity}} </td>
                        </tr>
                   @endforeach

                    <tr class="inv_item_row" style="border-top:1px solid gray;">
                        <td colspan="4" align="right" style="height:12px;">Sub Total:</td>
                        <td colspan="2" align="right">{{$Invoice->total_amount}} </td>
                    </tr>
                    <tr class="inv_item_row">
                        <td colspan="4" align="right">Discount:</td>
                        <td colspan="2" align="right">{{$Invoice->discount}}</td>
                    </tr>

                    @if($Invoice->shipping_charge)
                    <tr class="inv_item_row">
                        <td colspan="4" align="right">Shipping Charge:</td>
                        <td colspan="2" align="right">{{$Invoice->shipping_charge}}</td>
                    </tr>
                    @endif
                    <tr class="inv_item_row">
                        <td colspan="4" align="right">Total:</td>
                        <td colspan="2" align="right">{{$Invoice->total_amount-$Invoice->discount+$Invoice->shipping_charge}}</td>
                    </tr>


                    {{-- <tr class="inv_item_row">
                        <td colspan="4" align="right">Remarks:</td>
                        <td colspan="2" align="right">{{$Invoice->note}}</td>
                    </tr> --}}
                </tbody>
            </table>
            <br>
            <div style="width:100%;margin-top:10px;font-size:11px;">
                @if($InvoiceSetting->invoice_footer){!!$InvoiceSetting->invoice_footer!!} @else  Thank u for Join with <strong>@if($companyInfo) {{$companyInfo->name}} @endif</strong><br>
                For any query, Please call {{$InvoiceSetting->mobile}} @endif <br>
                Powered by: <a href="http://shomikaron.com/" target="_blank">Shomikaron(01643235533)</a><br />
            </div>
        </div><!--/table-responsive-->
    </div>
    @if($InvoiceSetting->is_print_invoice==true)
<br>
<br>

@endif


    <script>
    </script>
</body>
</html>
