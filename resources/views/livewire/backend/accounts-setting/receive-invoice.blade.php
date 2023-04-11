@push('css')
<style>
    .stylefortable {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .styleforth {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .stylefortd {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .customer-payment-modal {
        position: relative;
        left: 87px;
    }
</style>
@endpush
<div>
    <x-slot name="title">RECEIVE RECEIPT</x-slot>
    <x-slot name="header">RECEIVE RECEIPT</x-slot>

    <center>
        <table style="width:50%;">
            <tr>
                <td style="width: 40px;height:50px;vertical-align: super;"
                    class="customer-payment-modal" style="padding: 0px;margin: 0px;">
                    <img src="@if ($companyInfo){{ asset('storage/photo/' . $companyInfo->logo) }}@endif"
                        style="width: 40px;height: 40px;padding: 0px;margin: 0px;vertical-align: super;"
                        alt="PaikariApp">
                </td>
                <td>
                    <h3 style="text-align:center;margin:0px;">
                       @if (isset($companyInfo)){{ $companyInfo->name }}@endif
                    </h3>
                    <p style="text-align:center;margin:0px;">Mobile:
                       @if (isset($companyInfo)){{ $companyInfo->mobile }}@endif
                    </p>
                    <p style="text-align:center;margin:0px;">Telephone:
                       @if (isset($companyInfo)){{ $companyInfo->phone }}@endif
                    </p>
                    <p style="text-align:center;margin:0px;">

                    </p>
                    <h4 style="text-align:center;">Receipt Voucher</h4>
                </td>
            </tr>
        </table>
    </center>
    <center>
        <table style="width:50%;">
            <tr>
                <td>
                    <p style="margin-top: 20px; font-weight:bold;">No. : @if($receive)
                        {{$receive->code}} @endif </p>
                    <p style="font-weight:bold;">Dated : {{ date("d-m-Y") }}</p>
                </td>
                <td></td>
            </tr>
        </table>
        <table class="payment stylefortable" style="width:50%;">
            <tr>
                <th class="styleforth">Particulars</th>
                <th class="styleforth">Amount</th>
            </tr>
            {{-- <tr>
                <td class="stylefortd font-weight-bold">Account : </td>
                <td class="stylefortd">0</td>
            </tr> --}}
            <tr>
                <td class="stylefortd">@if($receive->Contact) {{$receive->Contact->first_name}} {{$receive->Contact->last_name}} @endif- Cr
                    <p class="ml-5">Agst Ref <strong>@if(isset($receive)) ({{$receive->transaction_id}}) @endif
                        @if(isset($receive)) {{$receive->amount}}  Dr @endif
                      </strong>
                   </p>
                </td>
                <td class="stylefortd">
                    @if(isset($receive->amount)) {{$receive->amount}} @endif
                </td>
            </tr>
            
            {{-- <tr>
                <td class="stylefortd font-weight-bold">Amounts (In Words): </td>
                <td class="stylefortd">
                </td>
            </tr> --}}

            {{-- <tr>
                <td class="stylefortd ml-5">
                    {{$total}}
                </td>
                <td>AED: {{$transaction->Invoice->amount_to_pay}}</td>
            </tr> --}}
        </table>

        <table style="width:50%; margin-top:40px;">
            <tr>
                <td>Receiver’s Signature</td>
                <td style="float: right;">Authorised Signatory</td>
            </tr>
        </table>
    </center>
</div>
    @push('scripts')

    @endpush

