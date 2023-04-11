@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        Cash Bank Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title design_title">Cash Bank Book Report</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">From Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="from_date"
                                            name="from_date" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">To Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="to_date"
                                            name="to_date" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div wire:ignore class="form-group">
                                        <label for="basicpill-firstname-input">Payment Method</label>
                                        <select class="form-control form-select select2 updateTable"
                                            placeholder="payment_method_id" name="payment_method_id" id="payment_method_id">
                                            <option value="">Select One Option</option>
                                            @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="cash_bank_book_report_table" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.currentDate').val(getDateFormat());

		$('#cash_bank_book_report_table').DataTable({
			processing: true,
			responsive: true,
			serverSide: true,
			ordering: false,
			paging: false,
			order: [[ 2, "desc" ]],
			ajax: {
				url: "{{ route('report.cash-bank-book-report-data') }}",
				type: 'GET',
				cache: false,
				data : function ( d ) {
                    d.from_date = $('#from_date').val();
					d.to_date = $('#to_date').val();
					d.payment_method_id = $('#payment_method_id').val();
				}
			},
			columns: [
			{ title: 'ID', targets: 1,  data: 'id', name: 'id' },
			{ title: 'TXN',  data: 'code', name: 'code' },
			{ title: 'Date',  data: 'txn_date', name: 'txn_date' },
			{ title: 'Particulars',  data: 'particulars', name: 'particulars' },
			{ title: 'Credit',  data: 'credit', class: "credit", name: 'credit' },
			{ title: 'Debit',  data: 'debit', class: "debit", name: 'debit' },
			{ title: 'Balance',  data: 'balance', class: "balance", name: 'balance' },
			],
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			'copyHtml5',
			'csvHtml5',
			{extend: 'excelHtml5',
            title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Cash Bank Book Report',
            messageTop: function() {
                return 'Payment Method Name : '+$('#payment_method_id :selected').text()+' ';
            },
				exportOptions:{
					// columns: ":not(.not-show)"
                    columns: ':visible'
				},
			},
			{
            extend: 'pdfHtml5',
            title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Cash Bank Book Report',
            orientation: 'landscape',
            messageTop: function() {
                return 'Customer Name : '+$('#contact_id :selected').text()+' ';
            },
            pageSize: 'LEGAL',
				exportOptions:{
					charset: "utf-8",
					columns: ":not(.not-show)"
				},
				customize: function (doc) {
                    // alert(Array(doc.content[2].table.body[0].length + 1).join('*').split(''));
					doc.content[2].table.widths =
					Array(doc.content[2].table.body[0].length + 1).join('*').split('');
					doc.styles.tableFooter.alignment = 'center';
					doc.styles.tableBodyEven.alignment = 'center';
					doc.styles.tableBodyOdd.alignment = 'center';
				}
			}
			],
			drawCallback : function ( settings ) {
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;

			},
			lengthMenu: [
			[-1],
			["All"]
			]
		});

		$(document).on('change','.updateTable',function () {
			$('#cash_bank_book_report_table').DataTable().draw(true);
		});
	});
</script>
@endsection
