<?php

namespace App\Traits;

use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Transaction\Payment;
use Carbon\Carbon;

trait GetBalance
{
    public function getPaymentBalance($data = [])
    {

        $openingBalance = 0;
        $DateRange = '';
         $Query1=SalePayment::whereNotNull('payment_method_id');
         $Query2=PurchasePayment::whereNotNull('payment_method_id');

        if (isset($data['payment_method_id'])) {
            $Query1->where("payment_method_id", $data['payment_method_id']);
            $Query2->where("payment_method_id", $data['payment_method_id']);
        }

        if (isset($data['start_date']) && isset($data['end_date'])) {
            $openingDateEnd = Carbon::parse($data['start_date'])->sub(1, 'day')->format('y-m-d');
            $DateRange = " AND date(date) >= '" . $data['start_date'] . "' AND date(date) <= '" . $data['end_date'] . "' ";
            $OpeningDateRange = "AND date(date) <= '" . $openingDateEnd . "' ";
            $Query1->selectRaw("(COALESCE(SUM(CASE WHEN $OpeningDateRange THEN amount END), 0)) AS `opening_debit`");
            $Query2->selectRaw("(COALESCE(SUM(CASE WHEN $OpeningDateRange THEN amount END), 0)) AS `opening_credit`");
        }
        $Query1->selectRaw("(COALESCE(SUM(CASE WHEN $DateRange THEN amount END), 0)) AS `total_debit`");
        $Query2->selectRaw("(COALESCE(SUM(CASE WHEN $DateRange THEN amount END), 0)) AS `total_credit`");

        $Query1 = $Query1->first();
        $Query2 = $Query2->first();
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $openingBalance =  $Query1->opening_debit-$Query2->opening_credit;
        }
        $Query['opening_balance'] =  $openingBalance;
        $Query['current_balance'] = $Query1->total_debit-$Query2->total_credit;
        return $Query;
    }
    public function getTransactionBalance($data = [])
    {

        $openingBalance = 0;
        $DateRange = '';
         $Query=Payment::whereNotNull('payment_method_id');

        if (isset($data['payment_method_id'])) {
            $Query->where("payment_method_id", $data['payment_method_id']);
        }

        if (isset($data['start_date']) && isset($data['end_date'])) {
            $openingDateEnd = Carbon::parse($data['start_date'])->sub(1, 'day')->format('y-m-d');
            $DateRange = " AND date(date) >= '" . $data['start_date'] . "' AND date(date) <= '" . $data['end_date'] . "' ";
            $OpeningDateRange = "AND date(date) <= '" . $openingDateEnd . "' ";
            $Query->selectRaw("(COALESCE(SUM(CASE WHEN `type` = 'CustomerPayment' $OpeningDateRange THEN amount END), 0)) AS `opening_debit`");
            $Query->selectRaw("(COALESCE(SUM(CASE WHEN `type` = 'SupplierPayment' $OpeningDateRange THEN amount END), 0)) AS `opening_credit`");
        }
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `type` = 'CustomerPayment' $DateRange THEN amount END), 0)) AS `total_debit`");
        $Query->selectRaw("(COALESCE(SUM(CASE WHEN `type` = 'SupplierPayment' $DateRange THEN amount END), 0)) AS `total_credit`");

        $Query = $Query->first();
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $openingBalance =  $Query->opening_debit-$Query->opening_credit;
        }
        $Query['opening_balance'] =  $openingBalance;
        $Query['current_balance'] = $Query->total_debit-$Query->total_credit;
        return $Query;
    }
}
