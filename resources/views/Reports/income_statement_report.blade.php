@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        Income Statement Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2  d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title" id="header-text-design">Income Statement</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Select Date</label>
                                <input type="text" id="reportrange" name="reportrange" class="form-control" />
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Start Date</label>
                                <input type="date" class="form-control updateTable prevDate" id="start_date" name="start_date" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">End Date</label>
                                <input type="date" class="form-control updateTable currentDate" id="end_date" name="end_date" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Branch</label>
                                <select class="form-control" placeholder="branch_id" name="branch_id" id="branch_id">
                                    <option>Select one Branch</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Company</label>
                                <select class="form-control">
                                    <option>Select Company</option>
                                    @foreach ($Company as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="col-lg-4">
                            <div wire:ignore class="form-group">
                                <label for="basicpill-firstname-input">Select Company</label>
                                <select class="form-control form-select select2 updateTable"
                                    placeholder="Customer" name="" id="">
                                    <option value="">Select Company</option>
                                    @foreach ($CompanyInfo as $CompanyInfo)
                                    <option value="{{ $CompanyInfo->id }}">{{ $CompanyInfo->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="income_statement_table" class="table table-striped table-bordered nowrap"
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

		$('#income_statement_table').DataTable({
			processing: true,
			responsive: true,
			serverSide: true,
			ordering: false,
			paging: false,
			order: [[ 2, "desc" ]],
			ajax: {
				url: "{{ route('report.income-statement-data') }}",
				type: 'GET',
				cache: false,
				data : function ( d ) {
                    d.from_date = $('#start_date').val();
					d.to_date = $('#end_date').val();
					d.branch_id = $('#branch_id').val();
				}
			},
			columns: [
            { title: 'Accounts Details', data: 'details', name: 'details', width:'50%' },
            { title: 'Sub-Total', data: 'subtotal', name: 'subtotal' },
            { title: 'Total', data: 'total', name: 'total' },
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
            // messageTop: function() {
            //     return 'Customer Name : '+$('#contact_id :selected').text()+' ';
            // },
            pageSize: 'LEGAL',
				exportOptions:{
					charset: "utf-8",
					columns: ":not(.not-show)"
				},
				customize: function (doc) {
                    // alert(Array(doc.content[2].table.body[0].length + 1).join('*').split(''));
					doc.content[1].table.widths =
					Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
			$('#income_statement_table').DataTable().draw(true);
		});
	});
</script>
@endsection
