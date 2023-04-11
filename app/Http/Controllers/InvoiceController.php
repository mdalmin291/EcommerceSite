<?php

namespace App\Http\Controllers;

use App\Models\Backend\Setting\InvoiceSetting;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Setting\CompanyInfo;
use App\Models\FrontEnd\Order;
use App\Models\UserProfile\ProfileSetting;

class InvoiceController extends Controller
{
    public function SaleInvoice($id)
    {
        return view('sale_invoice', [
            'CompanyInfo' => CompanyInfo::first(),
            'Invoice' => SaleInvoice::find($id),
            'InvoiceSetting' => InvoiceSetting::first(),
        ]);
    }

    public function TakeOrderInvoice($id)
    {
        return view('take_invoice_invoice', [
            'ProfileSetting' => ProfileSetting::first(),
            'Invoice' => Order::find($id),
            'InvoiceSetting' => InvoiceSetting::first(),
        ]);
    }
}
