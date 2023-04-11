@@ -0,0 +1,168 @@
@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        Order Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title design_title">Order Report</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">From Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="from_date"
                                            name="from_date" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">To Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="to_date"
                                            name="to_date" />
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
                        <table id="order_report_table" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <tfoot>
                                <th colspan="4"></th>
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
        $('.currentDate').val(getDateFormat());

		$('#order_report_table').DataTable({
			processing: true,
			responsive: true,
			serverSide: true,
			ajax: {
				url: "{{ route('report.order-report-data') }}",
				type: 'GET',
				cache: false,
				data : function ( d ) {
					d.from_date = $('#from_date').val();
					d.to_date = $('#to_date').val();
				}
			},
			columns: [
			{ title: 'SL', data: 'id', name: 'id' },
			{ title: 'OrderCode', data: 'code', name: 'code' },
			{ title: 'Order Date', data: 'order_date', class: "total_amount", name: 'total_amount' },
			{ title: 'Business Name', data: 'contact_id', class: "contact_id", name: 'contact_id' },
			{ title: 'Total', data: 'payable_amount', class: "payable_amount", name: 'payable_amount' },
			{ title: 'Status', data: 'status', class: "status", name: 'status' },
			],
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			'copyHtml5',
			'csvHtml5',
            // 'excel',
			{extend: 'excelHtml5', title: '{{$companyInfo->name}} \n {{$companyInfo->address}} \n Sale Report',  footer:true,
				exportOptions:{
					columns: ":not(.not-show)"
				},
			},
			{extend: 'pdfHtml5', title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Sale Report', orientation: 'landscape', pageSize: 'LEGAL', footer:true,
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
				$.each(['payable_amount'], function( index, value ) {

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
			[10, 25, 50, 100, 500, 1000],
			[10, 25, 50, 100, 500, 1000]
			]
		});

		$(document).on('change','.updateTable',function () {
			$('#order_report_table').DataTable().draw(true);
		});
	});
</script>
@endsection
