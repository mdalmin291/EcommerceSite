<?php

namespace App\Traits;

use App\Models\Backend\Inventory\StockManager;
use Carbon\Carbon;

trait ProfitLoss
{
    public function getProfitLoss($data = [])
    {
        $openingStock = 0;
        $openingStockAmount = 0;
        $DateRange = '';

        $Query = StockManager::where("status", 1);

        if (isset($data['contact_id'])) {
            $Query->where("contact_id", $data['contact_id']);
        }

        if (isset($data['invoice_id'])) {
            $Query->where("invoice_id", $data['invoice_id']);
        }

        if (isset($data['item_id'])) {
            $Query->where("item_id", $data['item_id']);
        }


        if (isset($data['start_date']) && isset($data['end_date'])) {
            //     $openingDateEnd = Carbon::parse($data['start_date'])->sub(1, 'day')->format('y-m-d');
            $DateRange = " AND date(date) >= '" . $data['start_date'] . "' AND date(date) <= '" . $data['end_date'] . "' ";
            //     $OpeningDateRange = " AND date(date) <= '" . $openingDateEnd . "' ";
            //     $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'In' $OpeningDateRange THEN quantity END), 0)) AS `total_opening_in`");
            //     $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'Out' $OpeningDateRange THEN quantity END), 0)) AS `total_opening_out`");
        }
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'In' THEN quantity END), 0)) AS `total_in`");
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'Out' $DateRange THEN quantity END), 0)) AS `total_out`");
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'In' THEN subtotal END), 0)) AS `total_in_amount`");
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `flow` = 'Out' $DateRange THEN subtotal END), 0)) AS `total_out_amount`");
        $Query = $Query->first();
        if ($Query->total_in_amount != 0 && $Query->total_in != 0) {
            $Query['avg_item_price'] = floatval($Query->total_in_amount) / floatval($Query->total_in);
        } else {
            $Query['avg_item_price'] = 0;
        }
        $Query['avg_profit'] = $Query->total_out_amount - ($Query->total_out * $Query['avg_item_price']);
        return $Query;
    }
}
