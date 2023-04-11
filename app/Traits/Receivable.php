<?php

namespace App\Traits;

use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SalePayment;
use Carbon\Carbon;

trait Receivable
{
    public function getSalePaid($data = [])
    {

        $openingBalance = 0;
        $DateRange = '';
         $Query=SalePayment::query();

        if (isset($data['contact_id'])) {
            $Query->where("contact_id", $data['contact_id']);
        }

        if (isset($data['from_date']) && isset($data['to_date'])) {
            $openingDateEnd = Carbon::parse($data['from_date'])->sub(1, 'day')->format('y-m-d');
            $DateRange = "  date(date) >= '" . $data['from_date'] . "' AND date(date) <= '" . $data['to_date'] . "' ";
            $OpeningDateRange = " date(date) <= '" . $openingDateEnd . "' ";
            $Query->selectRaw("(COALESCE(SUM(CASE WHEN  $OpeningDateRange THEN total_amount END), 0)) AS `opening_total_paid`");
        }
        // $Query->selectRaw("(COALESCE(SUM(CASE WHEN  $DateRange THEN total_amount END), 0)) AS `total_paid`");
        $Query->selectRaw("(COALESCE(SUM(total_amount), 0)) AS `total_paid`");

        $Query = $Query->first();
        if (isset($data['from_date']) && isset($data['to_date'])) {
            $openingBalance =  $Query->opening_total_paid;
        }
        $Query['opening_paid'] =  $openingBalance;
        $Query['current_paid'] = $Query->total_paid;
        return $Query;
    }
    public function getSaleBill($data = [])
    {
        $openingBalance = 0;
        $DateRange = '';
         $Query=SaleInvoice::query();

        if (isset($data['contact_id'])) {
            $Query->where("contact_id", $data['contact_id']);
        }

        if (isset($data['from_date']) && isset($data['to_date'])) {
            $openingDateEnd = Carbon::parse($data['from_date'])->sub(1, 'day')->format('y-m-d');
            $DateRange = "  date(sale_date) >= '" . $data['from_date'] . "' AND date(sale_date) <= '" . $data['to_date'] . "' ";
            $OpeningDateRange = " date(sale_date) <= '" . $openingDateEnd . "' ";
            $Query->selectRaw("(COALESCE(SUM(CASE WHEN  $OpeningDateRange THEN payable_amount END), 0)) AS `opening_total_bill`");
        }
        if (isset($data['from_date']) && isset($data['to_date'])) {
          $Query->selectRaw("(COALESCE(SUM(CASE WHEN  $DateRange THEN payable_amount END), 0)) AS `total_bill`");
        }else{
          $Query->selectRaw("(COALESCE(SUM(payable_amount), 0)) AS `total_bill`");
        }

        $Query = $Query->first();
        if (isset($data['from_date']) && isset($data['to_date'])) {
            $openingBalance =  $Query->opening_total_bill;
        }
        $Query['opening_bill'] =  $openingBalance;
        $Query['current_bill'] = $Query->total_bill;
        return $Query;
    }
}
