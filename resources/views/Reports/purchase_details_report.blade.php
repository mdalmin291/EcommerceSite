@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        Purchase Details Report
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title design_title">Purchase Details Report</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">From Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="from_date"
                                            name="from_date" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="basicpill-firstname-input">To Date</label>
                                        <input type="date" class="form-control updateTable currentDate" id="to_date"
                                            name="to_date" />
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div wire:ignore class="form-group">
                                        <label for="basicpill-firstname-input">Select Supplier</label>
                                        <select class="form-control form-select select2 updateTable"
                                            placeholder="Customer" name="contact_id" id="contact_id">
                                            <option value="">Select Supplier</option>
                                            @foreach ($ContactLists as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div wire:ignore class="form-group">
                                        <label for="basicpill-firstname-input">Select Category</label>
                                        <select class="form-control form-select select2 updateTable"
                                            placeholder="Category" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div wire:ignore class="form-group">
                                        <label for="basicpill-firstname-input">Select Branch</label>
                                        <select class="form-control form-select select2 updateTable"
                                            placeholder="Branch" name="branch_id" id="branch_id">
                                            <option value="">Select Branch</option>
                                            @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="col-lg-3">
                            <div wire:ignore class="form-group">
                                <label for="basicpill-firstname-input">Select Customer</label>

                                <select class="form-control form-select select2 updateTable" placeholder="Customer"
                                    name="contact_id" id="contact_id">
                                    <option value="">Select Customer</option>
                                    @foreach ($ContactLists as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                        <table id="purchase_details_report_table" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            {{-- <tfoot>
                                <th colspan="5"></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot> --}}
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

		$('#purchase_details_report_table').DataTable({
			processing: true,
			responsive: true,
			serverSide: true,
			ajax: {
				url: "{{ route('report.purchase-details-report-data') }}",
				type: 'GET',
				cache: false,
				data : function ( d ) {
					d.from_date = $('#from_date').val();
					d.to_date = $('#to_date').val();
					d.contact_id = $('#contact_id').val();
					d.category_id = $('#category_id').val();
					d.branch_id = $('#branch_id').val();
				}
			},
			columns: [
			{ title: 'SL', data: 'id', name: 'id' },
			{ title: 'Date', data: 'created_at', name: 'created_at' },
			{ title: 'Supplier Name', data: 'contact_name', name: 'contact_name' },
			{ title: 'Code', data: 'invoice_code', name: 'invoice_code' },
			{ title: 'Product Name', data: 'product_name', class: "product_name", name: 'product_name' },
			{ title: 'Qty', data: 'quantity', class: "quantity", name: 'quantity' },
			{ title: 'Unit Price', data: 'unit_price', class: "unit_price", name: 'unit_price' },
			{ title: 'Sub Total', data: 'purchase_subtotal', class: "purchase_subtotal", name: 'purchase_subtotal' },
            { title: 'Branch', data: 'branch_name', name: 'branch_name' }
			],
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			'copyHtml5',
			'csvHtml5',
            // 'excel',
			{extend: 'excelHtml5', title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Purchase Details Report',  footer:true,
				exportOptions:{
					columns: ":not(.not-show)"
				},
			},
			{extend: 'pdfHtml5', title: '{{$companyInfo->business_name}} \n {{$companyInfo->address}} \n Purchase Details Report', orientation: 'landscape', pageSize: 'LEGAL', footer:true,
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
				$.each(['quantity', 'purchase_price', 'purchase_subtotal'], function( index, value ) {

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
			$('#purchase_details_report_table').DataTable().draw(true);
		});
	});
</script>
@endsection
