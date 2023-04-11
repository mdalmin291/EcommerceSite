@extends('layouts.backend_app')
@section('content')
	<form id="add_barcode_generate_form" action="{{route('product.generate_barcode_print')}}" method="get" class="form-horizontal validatable">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-footer align-items-center justify-content-between d-flex">
							<button type="button" class="btn btn-outline-success pull-right">Generate Barcode</button>
						</div>
					</div>
				</div>
				<div class="col-xl-10">
					<div class="form-group">
						<label for="example-search-input" class="col-16 col-form-label">Product Name/Code</label>
						<div class="col-16">
							<input type="text" name="item_material_product_name" autocomplete="off" data-type="Product" class="form-control" placeholder="Enter Item Name">
							<input type="hidden" name="item_material_id">
							<input type="hidden" name="item_material_code">
							<input type="hidden" name="item_material_unit">
							<input type="hidden" name="item_material_unit_id">
							<input type="hidden" name="item_material_pur_rate">
							<input type="hidden" name="item_material_sale_rate">
						</div>
					</div>
				</div>
				<div class="col-xl-2">
					<div class="form-group">
						<label for="example-search-input" class="col-16 col-form-label">Search</label>
						<div class="col-16">
							<button type="button" class="btn btn-primary add_product_row_button">Add</button>
						</div>
					</div>
				</div>
				{{-- <div class="col-md-4 text-white">
									<div class="form-group">
										<label for="example-search-input" class="col-16 col-form-label">Barcode Scan</label>
										<div class="col-16">
											<input type="text" name="product_barcode" autocomplete="off" autofocus="on" data-type="Product" class="form-control" placeholder="Enter Barcode Scan/Product Code">
										</div>
									</div>
								</div> --}}
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-block">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="SaleTable">
									<thead>
										<tr>
											<th>Item Code</th>
											<th>Product name</th>
											<th>Quantity</th>
											<th>Unit</th>
											<th>Rate</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<tr id="">

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-16 col-md-16">
					<button type="submit" class="btn btn-success " data-target="#sales_invoice"  align="right">
						Generate Barcode
					</button>
				</div>
			</div>
		</div>
	</form>
@include('layouts.footer')
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){

		// $('#add_barcode_generate_form').ajaxForm({
			// beforeSend: formBeforeSend,
			// beforeSubmit: formBeforeSubmit,
			// error: formError,
			// success: function (responseText, statusText, xhr, $form) {
				// removeLoadingButton($form.find("button[type=submit]"));
			// },
			// clearForm: true,
			// resetForm: true
		// });

		$(document).on("click", ".add_product_row_button", function () {
			var itemMaterialId = $('input[name^="item_material_id"]').val();
			var itemMaterialCode = $('input[name^="item_material_code"]').val();
			var itemMaterialName = $('input[name^="item_material_product_name"]').val();
			var itemMaterialUnit = $('input[name^="item_material_unit"]').val();
			var itemMaterialUnitId = $('input[name^="item_material_unit_id"]').val();
			var itemMaterialPurRate = $('input[name^="item_material_pur_rate"]').val();
			var itemMaterialSaleRate = $('input[name^="item_material_sale_rate"]').val();
			if(itemMaterialId == ''){
				swal("Not Found!", 'Item Not Found', "error");
				}else if (itemMaterialId != '') {

				addSaleRow({
					product_id: itemMaterialId,
					product_code: itemMaterialCode,
					product_name: itemMaterialName,
					product_unit: itemMaterialUnit,
					product_unit_id: itemMaterialUnitId,
					product_pur_rate: itemMaterialPurRate,
					product_sale_rate: itemMaterialSaleRate,
				});

				}else{
				swal("Not Found!", 'Item Code Not Found', "error");
			}
			$('input[name^="item_material_id"]').val('');
			$('input[name^="item_material_code"]').val('');
			$('input[name^="item_material_product_name"]').val('');
			$('input[name^="item_material_unit"]').val('');
			$('input[name^="item_material_unit_id"]').val('');
			$('input[name^="item_material_pur_rate"]').val('');
			$('input[name^="item_material_sale_rate"]').val('');

		});


		$('input[name^="product_barcode"]').on('keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                if ($(this).val() == '') {
                    return false;
                }
                $(this).ajaxSubmit({
                    beforeSend: formBeforeSend,
                    beforeSubmit: formBeforeSubmit,
                    error: formError,
                    dataType: 'json',
                    method: 'GET',
                    url: "{{ route('product.product_search') }}",
                    data: {
                        code: $(this).val(),
                        type: $(this).data('type')
                    },
                    success: function (responseText) {
                        addSaleRow({
                            product_id: responseText[0].id,
                            product_code: responseText[0].code,
                            product_name: responseText[0].product_name,
                            product_unit: responseText[0].unit.name,
                            product_unit_id: responseText[0].unit.id,
                            product_pur_rate: responseText[0].purchase_price,
                            product_sale_rate: responseText[0].regular_price,
                        });
                    }
                });
                $(this).val('');
            }
        });
        $(document).on("click", ".row_delete", function () {
			$(this).parent('td').parent('tr').remove();
		});
		function addSaleRow(data) {
			var generator = new IDGenerator(8);
			// var SaleTable = document.getElementById('SaleTable').getElementsByTagName('tbody')[0];
			var SaleTable = document.getElementById('SaleTable');
			if (SaleTable.rows["row_"+data.product_id]) {
				swal("Exits!", 'Item Already Exits', "error");
				return true;
			}
			var rowCnt = SaleTable.rows.length;
			var tr = SaleTable.insertRow(rowCnt);
			var item_row_id = "ST" + generator.generate();
			tr.setAttribute('id', "row_"+data.product_id);
			for (var c = 0; c <= 5; c++) {
				var td = document.createElement('td');
				td = tr.insertCell(c);
				if (c == 0) {
					var ele = document.createElement('input');
					ele.setAttribute('type', 'hidden');
					ele.setAttribute('data-id', data.product_id);
					ele.setAttribute('value', data.product_id);
					ele.setAttribute('name', 'product_id[]');
					td.appendChild(ele);

					var ele = document.createElement('input');
					ele.setAttribute('type', 'text');
					ele.setAttribute('class', 'form-control');
					ele.setAttribute('data-id', data.product_id);
					ele.setAttribute('style', 'min-width: 100px;');
					ele.setAttribute('value', data.product_code);
					ele.setAttribute('name', 'product_code[]');
					td.appendChild(ele);

					var ele = document.createElement('input');
					ele.setAttribute('type', 'hidden');
					ele.setAttribute('value', item_row_id);
					ele.setAttribute('name', 'item_row_id[]');
					td.appendChild(ele);

					// var ele = document.createElement('input');
					// ele.setAttribute('type', 'hidden');
					// ele.setAttribute('value', data.purchase_type);
					//ele.setAttribute('value', data.item_type);
					// ele.setAttribute('name', 'item_type[]');
					// td.appendChild(ele);

					var ele = document.createElement('input');
					ele.setAttribute('type', 'hidden');
					ele.setAttribute('value', data.product_unit_id);
					ele.setAttribute('name', 'item_unit_id[]');
					td.appendChild(ele);

					var ele = document.createElement('input');
					ele.setAttribute('type', 'hidden');
					ele.setAttribute('value', data.product_pur_rate);
					ele.setAttribute('name', 'pur_rate[]');
					td.appendChild(ele);

					var ele = document.createElement('input');
					ele.setAttribute('type', 'hidden');
					ele.setAttribute('id', 'vat_subtotal_' + data.product_id);
					ele.setAttribute('value', parseFloat(data.product_sale_vat) / 100 * data.product_sale_rate);
					ele.setAttribute('name', 'vat_subtotal[]');
					td.appendChild(ele);

					}else if (c == 1) {
					var ele = document.createElement('input');
					ele.setAttribute('type', 'text');
					ele.setAttribute('class', 'form-control');
					ele.setAttribute('style', 'min-width: 100px;');
					ele.setAttribute('value', data.product_name);
					ele.setAttribute('name', 'product_name[]');
					td.appendChild(ele);

					} else if (c == 2) {
					var ele = document.createElement('input');
					ele.setAttribute('type', 'text');
					ele.setAttribute('class', 'form-control row_cal_update');
					ele.setAttribute('style', 'min-width: 100px;');
					ele.setAttribute('data-id', data.product_id);
					ele.setAttribute('id', 'quantity_' + data.product_id);
					ele.setAttribute('value', '1');
					ele.setAttribute('name', 'quantity[]');
					ele.setAttribute('placeholder', 'Quantity');
					td.appendChild(ele);
					} else if (c == 3) {
					var ele = document.createElement('input');
					ele.setAttribute('type', 'text');
					ele.setAttribute('class', 'form-control');
					ele.setAttribute('style', 'min-width: 100px;');
					ele.setAttribute('value', data.product_unit);
					ele.setAttribute('name', 'unit[]');
					ele.setAttribute('placeholder', 'Unit');
					td.appendChild(ele);
					} else if (c == 4) {
					var ele = document.createElement('input');
					ele.setAttribute('type', 'text');
					ele.setAttribute('class', 'form-control row_cal_update');
					ele.setAttribute('style', 'min-width: 100px;');
					ele.setAttribute('data-id', data.product_id);
					ele.setAttribute('value', data.product_sale_rate);
					ele.setAttribute('id', 'sale_rate_' + data.product_id);
					ele.setAttribute('name', 'sale_rate[]');
					ele.setAttribute('placeholder', 'Sales Rate');
					td.appendChild(ele);
					} else if (c == 5) {
					var ele = document.createElement('a');
					ele.setAttribute('href', 'javascript:void(0);');
					ele.setAttribute('data-item_row_id', item_row_id);
					ele.setAttribute('class', 'btn btn-danger btn-sm row_delete');
					var ele_icon = document.createElement('i');
					ele_icon.setAttribute('class', 'fa fa-trash');
					ele.appendChild(ele_icon);
					td.appendChild(ele);
				}
				}
			}
		});
	</script>
	@endsection
