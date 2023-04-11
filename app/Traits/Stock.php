<?php

namespace App\Traits;

use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\purchaseInvoiceDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Stock
{



    public function getStock($data = [])
    {
        $openingStock = 0;
        $openingStockAmount = 0;
        $DateRange = '';

        $Query1 = SaleInvoiceDetail::leftJoin('sale_invoices', function($join) {
            $join->on('sale_invoices.id', '=', 'sale_invoice_details.sale_invoice_id');
          })->where("sale_invoice_details.is_active", 1);
        $Query2 = purchaseInvoiceDetail::leftJoin('purchase_invoices', function($join) {
            $join->on('purchase_invoices.id', '=', 'purchase_invoice_details.purchase_invoice_id');
          })->where("purchase_invoice_details.is_active", 1);

        if (isset($data['product_id'])) {
            $Query1->where("product_id", $data['product_id']);
        }

        if (isset($data['start_date'])) {
            $Query1->whereDate('sale_invoices.sale_date', '>=', Carbon::parse($data['start_date'])->format('y-m-d'));
        }

        if (isset($data['end_date'])) {
            $Query1->whereDate('sale_invoices.sale_date', '<=', Carbon::parse($data['end_date'])->format('y-m-d'));

        }

        if (isset($data['start_date'])) {
            $Query2->whereDate('purchase_invoices.purchase_date', '>=', Carbon::parse($data['start_date'])->format('y-m-d'));
        }

        if (isset($data['end_date'])) {
            $Query2->whereDate('purchase_invoices.purchase_date', '<=', Carbon::parse($data['end_date'])->format('y-m-d'));
        }

        if (isset($data['product_id'])) {
            $Query2->where("product_id", $data['product_id']);
        }

        $Query1->selectRaw("(COALESCE(SUM(quantity), 0)) AS `total_out`");
        $Query2->selectRaw("(COALESCE(SUM(quantity), 0)) AS `total_in`");
        $Query1->selectRaw("(COALESCE(SUM(quantity*unit_price), 0)) AS `total_out_amount`");
        $Query2->selectRaw("(COALESCE(SUM(quantity*unit_price), 0)) AS `total_in_amount`");
        $Query1 = $Query1->first();
        $Query2 = $Query2->first();
        if ($Query2->total_in_amount != 0 && $Query2->total_in != 0) {
            $Query['avg_item_price'] = floatval($Query2->total_in_amount) / floatval($Query2->total_in);
        } else {
            $Query['avg_item_price'] = 0;
        }
        $Query['stock'] = $Query2->total_in- $Query1->total_out;
        $Query['total_out'] = $Query1->total_out;
        $Query['avg_profit'] = $Query1->total_out_amount - ($Query1->total_out * $Query['avg_item_price']);
        return $Query;
    }



    public function getStocknew($data = [])
    {
    $saleDetails = DB::table("sale_invoice_details")
    ->leftJoin('sale_invoices', 'sale_invoices.id', '=', 'sale_invoice_details.sale_invoice_id')
    ->whereNull('sale_invoice_details.deleted_at')
    // ->whereDate('sale_invoices.sale_date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
    // ->whereDate('sale_invoices.sale_date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
    ->select("sale_invoice_details.product_id as product_id","sale_invoice_details.unit_price as unit_price","sale_invoice_details.quantity as quantity");
    $purchaseDetails = DB::table("purchase_invoice_details")
    ->leftJoin('purchase_invoices', 'purchase_invoices.id', '=', 'purchase_invoice_details.purchase_invoice_id')

    ->whereNull('purchase_invoice_details.deleted_at')
    // ->whereDate('purchase_invoices.purchase_date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
    // ->whereDate('purchase_invoices.purchase_date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
    ->select("purchase_invoice_details.product_id as product_id","purchase_invoice_details.unit_price as unit_price","purchase_invoice_details.quantity as quantity")
    ->unionall($saleDetails)
    ->orderBy('product_id','asc')
     ->get();
     return $purchaseDetails;
    }
}
