@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        Customer Due Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title design_title">Customer Due Report</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <div wire:ignore class="form-group">
                                <label for="basicpill-firstname-input">Select Customer</label>
                                <select class="form-control form-select select2 updateTable" placeholder="Customer"
                                    name="contact_id" id="contact_id">
                                    <option value="">Select Customer</option>
                                    @foreach ($ContactLists as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
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
                        <table id="customer_due_report_table" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <tfoot>
                                <th colspan="2"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
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
		$('#contact_id').select2(
            {theme: "classic"}
        );

		$('#customer_due_report_table').DataTable({
			processing: true,
			responsive: true,
			serverSide: true,
			ajax: {
				url: "{{ route('report.customer-due-report-data') }}",
				type: 'GET',
				cache: false,
				data : function ( d ) {
					// d.from_date = $('#from_date').val();
					// d.to_date = $('#to_date').val();
					d.contact_id = $('#contact_id').val();
					// d.category_id = $('#category_id').val();
					// d.branch_id = $('#branch_id').val();
				}
			},
			columns: [
			{ title: 'SL', data: 'id', name: 'id' },
			{ title: 'Customer Name', data: 'first_name', name: 'first_name' },
			{ title: 'Mobile', data: 'mobile', name: 'mobile' },
			{ title: 'Total Amount', data: 'grand_total', class: "grand_total", name: 'grand_total' },
			{ title: 'Paid Amount', data: 'amount', class: "amount", name: 'amount' },
			{ title: 'Due Amount', data: 'due_amount', class: "due_amount", name: 'due_amount' }
			],
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			'copyHtml5',
			'csvHtml5',
            // 'excel',
			{extend: 'excelHtml5', title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Customer Due Report',  footer:true,
				exportOptions:{
					columns: ":not(.not-show)"
				},
			},
			{extend: 'pdfHtml5', title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Customer Due Report', orientation: 'landscape', pageSize: 'LEGAL', footer:true,
				exportOptions:{
					charset: "utf-8",
					columns: ":not(.not-show)"
				},
				customize: function (doc) {
					doc.content[1].table.widths =
					Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					doc.styles.tableFooter.alignment = 'center';
					doc.styles.tableBodyEven.alignment = 'center';
					doc.styles.tableBodyOdd.alignment = 'center';
				}
			}
			],
			footerCallback: function(row, data, start, end, display) {
				var api = this.api();
				$.each(['grand_total', 'amount', 'due_amount'], function( index, value ) {

					// var total = api
					// .column('.amount_to_pay', {
					// page: 'all'
					// })
					// .data()
					// .reduce( function (a, b) {
					// return parseFloat(a) + parseFloat(b);
					// }, 0 );

					api.columns('.'+value, {
						page: 'all'
						}).every(function() {
						var sum = this
						.data()
						.reduce(function(a, b) {

							if(!Number(a) && a != 0){
								a = a.replace(/\,/g,'');
							}

							if(!Number(b) && b != 0){
								b = b.replace(/\,/g,'');
							}
							var x = parseFloat(a) || 0;
							var y = parseFloat(b) || 0;
							return x + y;
						}, 0);

						$(this.footer()).html(parseFloat(sum).toFixed(2));
					});



				});

			},
			lengthMenu: [
			[10, 25, 50, 100],
			[10, 25, 50, 100]
			]
		});

		$(document).on('change','.updateTable',function () {
			$('#customer_due_report_table').DataTable().draw(true);
		});
	});
</script>
@endsection
