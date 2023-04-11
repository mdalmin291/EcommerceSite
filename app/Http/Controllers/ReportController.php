<?php

namespace App\Http\Controllers;

use App\Models\Backend\Inventory\PurchaseInvoice;
use Carbon\Carbon;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\AccountsSetting\ChartOfAccount;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\FrontEnd\Order;
use App\Traits\GetBalance;
use App\Models\Inventory\Category;
use Illuminate\Support\Facades\DB;
use App\Traits\Receivable;
use App\Traits\Payable;
use App\Traits\ProfitLoss;
use App\Traits\Stock;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use GetBalance;
    use Receivable;
    use Payable;
    use ProfitLoss;
    use Stock;
    public function SupplierPaymentReportData(Request $request){
        $accounts_sale_invoice = PurchasePayment::query();

        if ($request->contact_id) {
            $accounts_sale_invoice->where('contact_id', $request->contact_id);
        }
        if ($request->branch_id) {
            $accounts_sale_invoice->where('branch_id', $request->branch_id);
        }
        $accounts_sale_invoice->whereDate('date', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('date', '<=', Carbon::parse($request->to_date)->format('Y-m-d'))->get();

        $this->i = 1;

        return DataTables::of($accounts_sale_invoice)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('payment_method_id', function ($data) {
                return $data->PaymentMethod ? $data->PaymentMethod->name : '';
            })
            ->addColumn('branch_id', function ($data) {
                if ($data->Branch) {
                    return $data->Branch ? $data->Branch->name : '';
                } else {
                    return null;
                }
            })
            ->toJson();
    }
    public function SupplierPaymentReport() {
        $ContactLists = Contact::whereType('Supplier')->get();
        $branches = Branch::orderBy('id', 'DESC')->get();
        return view('Reports.supplier_payment_report', compact('ContactLists', 'branches'));
    }
    public function CustomerPaymentReportData(Request $request){
        $accounts_sale_invoice = SalePayment::query();

        if ($request->contact_id) {
            $accounts_sale_invoice->where('contact_id', $request->contact_id);
        }
        if ($request->branch_id) {
            $accounts_sale_invoice->where('branch_id', $request->branch_id);
        }
        $accounts_sale_invoice->whereDate('date', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('date', '<=', Carbon::parse($request->to_date)->format('Y-m-d'))->get();

        $this->i = 1;

        return DataTables::of($accounts_sale_invoice)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('payment_method_id', function ($data) {
                return $data->PaymentMethod ? $data->PaymentMethod->name : '';
            })
            ->addColumn('branch_id', function ($data) {
                if ($data->Branch) {
                    return $data->Branch ? $data->Branch->name : '';
                } else {
                    return null;
                }
            })
            ->toJson();
    }
    public function CustomerPaymentReport() {
        $ContactLists = Contact::whereType('Customer')->get();
        $branches = Branch::orderBy('id', 'DESC')->get();
        return view('Reports.customer_payment_report', compact('ContactLists', 'branches'));
    }
    public function PayableReportData(Request $request)
    {
        $Contact = Contact::whereType('Supplier');
        if ($request->contact_id) {
            $Contact->where('id', $request->contact_id);
        }
        $Contact->get();
        $this->i = 1;

        return DataTables::of($Contact)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('opening_balance', function ($data) {
                return $this->getPurchaseBill(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->opening_bill - $this->getPurchasePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->opening_paid;
            })
            ->addColumn('credit', function ($data) {
                return $this->getPurchaseBill(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_bill;
            })
            ->addColumn('debit', function ($data) {
                return $this->getPurchasePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_paid;
            })
            ->addColumn('closing_balance', function ($data) {
                return $this->getPurchaseBill(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_bill - $this->getPurchasePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_paid;
            })
            ->toJson();
    }

    public function PayableReport()
    {
        $ContactLists = Contact::whereType('Supplier')->get();
        return view('Reports.payable_report', compact('ContactLists'));
    }



    public function OrderReportData(Request $request)
    {

        $order = Order::query();

        $order->whereDate('order_date', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('order_date', '<=', Carbon::parse($request->to_date)->format('Y-m-d'))->get();

        $this->i = 1;

        return DataTables::of($order)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->business_name : '';
            })
            ->toJson();
    }


    public function OrderReport()
    {
        return view('Reports.order_report');
    }
    public function ReceivableReportData(Request $request)
    {
        $Contact = Contact::whereType('Customer');
        if ($request->contact_id) {
            $Contact->where('id', $request->contact_id);
        }
        $Contact->get();
        $this->i = 1;

        return DataTables::of($Contact)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('opening_balance', function ($data) {
                return $this->getSaleBill(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->opening_bill - $this->getSalePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->opening_paid;
            })
            ->addColumn('credit', function ($data) {
                return $this->getSaleBill(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_bill;
            })
            ->addColumn('debit', function ($data) {
                return $this->getSalePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_paid;
            })
            ->addColumn('closing_balance', function ($data) {
                return $this->getSaleBill(['contact_id' => $data->id])->current_bill - $this->getSalePaid(['contact_id' => $data->id, 'from_date' => Carbon::parse(request()->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse(request()->to_date)->format('Y-m-d')])->current_paid;
            })
            ->toJson();
    }

    public function ReceivableReport()
    {
        $ContactLists = Contact::whereType('Customer')->get();
        return view('Reports.receivable_report', compact('ContactLists'));
    }
    public function ProfitLossReportData(Request $request)
    {
        $products = Product::orderBy('id', 'desc');

        $products->get();
        $this->i = 1;

        return DataTables::of($products)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('code', function ($data) {
                return $data->code;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('total_out', function ($data) {
                return  $this->getStock(['product_id' => $data->id, 'start_date'=>request()->start_date,'end_date'=>request()->end_date])['total_out'];
            })
            ->addColumn('avg_price', function ($data) {
                return  $this->getStock(['product_id' => $data->id])['avg_item_price'];

            })
            ->addColumn('profit_loss', function ($data) {
                return  $this->getStock(['product_id' => $data->id,'start_date'=>request()->start_date,'end_date'=>request()->end_date])['avg_profit'];

            })
            ->toJson();
    }
    public function ProfitLossReport()
    {
        $ContactLists = Contact::whereType('Customer')->get();
        return view('Reports.profit_loss_report', compact('ContactLists'));
    }
    public function SupplierDueReportData(Request $request)
    {
        $Contact = Contact::whereType('Supplier');
        if ($request->contact_id) {
            $Contact->where('id', $request->contact_id);
        }
        $Contact->get();
        $this->i = 1;

        return DataTables::of($Contact)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('grand_total', function ($data) {
                return $data->PurchaseInvoice->sum('payable_amount');
            })
            ->addColumn('amount', function ($data) {
                return $data->PurchasePayment->sum('total_amount');
            })
            ->addColumn('due_amount', function ($data) {
                return $data->PurchaseInvoice->sum('payable_amount') - $data->PurchasePayment->sum('total_amount');
            })
            ->toJson();
    }
    public function SupplierDueReport()
    {
        $ContactLists = Contact::where('type', 'Supplier')->get();
        return view('Reports.supplier_due_report', [
            'ContactLists' => $ContactLists
        ]);
    }
    public function CustomerDueReportData(Request $request)
    {
        $Contact = Contact::whereType('Customer');
        if ($request->contact_id) {
            $Contact->where('id', $request->contact_id);
        }
        $Contact->get();
        $this->i = 1;

        return DataTables::of($Contact)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('grand_total', function ($data) {
                return $data->SaleInvoice->sum('payable_amount');
            })
            ->addColumn('amount', function ($data) {
                return $data->SalePayment->sum('total_amount');
            })
            ->addColumn('due_amount', function ($data) {
                return $data->SaleInvoice->sum('payable_amount') - $data->SalePayment->sum('total_amount');
            })
            ->toJson();
    }
    public function CustomerDueReport()
    {
        $ContactLists = Contact::where('type', 'Customer')->get();
        return view('Reports.customer_due_report', [
            'ContactLists' => $ContactLists
        ]);
    }
    public function SupplierLedgerReportData(Request $request)
    {
        $GetFilterData = [];
        if ($request->contact_id) {
            $openingClosingBill = $this->getPurchaseBill(['contact_id' => $request->contact_id, 'from_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $openingClosingPaid = $this->getPurchasePaid(['contact_id' => $request->contact_id, 'from_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $payments = DB::table("purchase_payments")
                ->whereNull('deleted_at')
                ->whereDate('date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('contact_id', $request->contact_id)
                ->select(DB::raw("'SupplierPayment' as type"), "purchase_payments.purchase_invoice_id as purchase_invoice_id", "purchase_payments.contact_id as contact_id", "purchase_payments.date as txn_date", "purchase_payments.code as code", "purchase_payments.total_amount as amount");

            $Transaction = DB::table("purchase_invoices")
                ->whereNull('deleted_at')
                ->whereDate('purchase_date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('purchase_date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('contact_id', $request->contact_id)

                ->select(DB::raw("'Purchase' as type"), "purchase_invoices.id as purchase_invoice_id",  "purchase_invoices.contact_id as contact_id", "purchase_invoices.purchase_date as txn_date", "purchase_invoices.code as code", "purchase_invoices.payable_amount as amount")
                ->unionall($payments)
                ->orderBy('purchase_invoice_id', 'asc')
                ->get();
            $openingBalance = $openingClosingBill->opening_bill - $openingClosingPaid->opening_paid;
            $GetFilterData[1]['id'] = 1;
            $GetFilterData[1]['code'] = '';
            $GetFilterData[1]['txn_date'] = '';
            $GetFilterData[1]['particulars'] = 'Previous Opening Balance';
            $GetFilterData[1]['debit'] = '';
            $GetFilterData[1]['credit'] = '';
            $GetFilterData[1]['balance'] = $openingBalance;
            $x = 2;
            $CreditBalance = $openingBalance + $openingClosingBill->current_bill - $openingClosingPaid->current_paid;
        } else {
            $Transaction = [];
            $CreditBalance = false;
        }

        foreach ($Transaction as $getTransaction) {

            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['txn_date'] = Carbon::parse($getTransaction->txn_date)->format('d-M-Y');
            $GetFilterData[$x]['code'] = $getTransaction->code;
            $ParticularDetails = $getTransaction->type;
            $GetFilterData[$x]['particulars'] = $ParticularDetails;
            if ($getTransaction->type == "Purchase") {
                $GetFilterData[$x]['debit'] = $getTransaction->amount;
                $openingBalance = $openingBalance + $getTransaction->amount;
            } else {
                $GetFilterData[$x]['debit'] = '';
            }

            if ($getTransaction->type == "SupplierPayment") {
                $GetFilterData[$x]['credit'] = $getTransaction->amount;
                $openingBalance = $openingBalance - $getTransaction->amount;
            } else {
                $GetFilterData[$x]['credit'] = '';
            }

            $GetFilterData[$x]['balance'] = $openingBalance;
            ++$x;
        }
        if ($CreditBalance) {
            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['code'] = '';
            $GetFilterData[$x]['txn_date'] = '';
            $GetFilterData[$x]['particulars'] = 'Closing Balance';
            $GetFilterData[$x]['debit'] = '';
            $GetFilterData[$x]['credit'] = '';
            $GetFilterData[$x]['balance'] = $CreditBalance;
        }

        return DataTables::of($GetFilterData)->toJson();
    }
    public function SupplierLedgerReport()
    {
        $ContactLists = Contact::where('type', 'Supplier')->get();
        return view('Reports.supplier_ledger_report', [
            'ContactLists' => $ContactLists,
        ]);
    }

    public function CustomerLedgerReportData(Request $request)
    {
        $GetFilterData = [];
        if ($request->contact_id) {
            $openingClosingBill = $this->getSaleBill(['contact_id' => $request->contact_id, 'from_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $openingClosingPaid = $this->getSalePaid(['contact_id' => $request->contact_id, 'from_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'to_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $payments = DB::table("sale_payments")
                ->whereNull('deleted_at')
                ->whereDate('date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('contact_id', $request->contact_id)
                ->select(DB::raw("'CustomerPayment' as type"), "sale_payments.sale_invoice_id as sale_invoice_id", "sale_payments.contact_id as contact_id", "sale_payments.date as txn_date", "sale_payments.code as code", "sale_payments.total_amount as amount");

            $Transaction = DB::table("sale_invoices")
                ->whereNull('deleted_at')
                ->whereDate('sale_date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('sale_date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('contact_id', $request->contact_id)

                ->select(DB::raw("'Sale' as type"), "sale_invoices.id as sale_invoice_id",  "sale_invoices.contact_id as contact_id", "sale_invoices.sale_date as txn_date", "sale_invoices.code as code", "sale_invoices.payable_amount as amount")
                ->unionall($payments)
                ->orderBy('sale_invoice_id', 'asc')
                ->get();

            $openingBalance = $openingClosingBill->opening_bill - $openingClosingPaid->opening_paid;
            $GetFilterData[1]['id'] = 1;
            $GetFilterData[1]['code'] = '';
            $GetFilterData[1]['txn_date'] = '';
            $GetFilterData[1]['particulars'] = 'Previous Opening Balance';
            $GetFilterData[1]['debit'] = '';
            $GetFilterData[1]['credit'] = '';
            $GetFilterData[1]['balance'] = $openingBalance;
            $x = 2;
            $CreditBalance = $openingBalance + $openingClosingBill->current_bill - $openingClosingPaid->current_paid;
        } else {
            $Transaction = [];
            $CreditBalance = false;
        }

        foreach ($Transaction as $getTransaction) {

            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['txn_date'] = Carbon::parse($getTransaction->txn_date)->format('d-M-Y');
            $GetFilterData[$x]['code'] = $getTransaction->code;
            $ParticularDetails = $getTransaction->type;
            $GetFilterData[$x]['particulars'] = $ParticularDetails;
            if ($getTransaction->type == "Sale") {
                $GetFilterData[$x]['credit'] = $getTransaction->amount;
                $openingBalance = $openingBalance + $getTransaction->amount;
            } else {
                $GetFilterData[$x]['credit'] = '';
            }

            if ($getTransaction->type == "CustomerPayment") {
                $GetFilterData[$x]['debit'] = $getTransaction->amount;
                $openingBalance = $openingBalance - $getTransaction->amount;
            } else {
                $GetFilterData[$x]['debit'] = '';
            }

            $GetFilterData[$x]['balance'] = $openingBalance;
            ++$x;
        }
        if ($CreditBalance) {
            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['code'] = '';
            $GetFilterData[$x]['txn_date'] = '';
            $GetFilterData[$x]['particulars'] = 'Closing Balance';
            $GetFilterData[$x]['debit'] = '';
            $GetFilterData[$x]['credit'] = '';
            $GetFilterData[$x]['balance'] = $CreditBalance;
        }

        return DataTables::of($GetFilterData)->toJson();
    }
    public function CustomerLedgerReport()
    {
        $ContactLists = Contact::where('type', 'Customer')->get();
        return view('Reports.customer_ledger_report', [
            'ContactLists' => $ContactLists,
        ]);
    }
    public function CashBankBookReportData(Request $request)
    {
        $GetFilterData = [];
        if ($request->payment_method_id) {
            $openingClosingPayment = $this->getPaymentBalance(['payment_method_id' => $request->payment_method_id, 'start_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'end_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $openingClosingTransaction = $this->getTransactionBalance(['payment_method_id' => $request->payment_method_id, 'start_date' => Carbon::parse($request->from_date)->format('Y-m-d'), 'end_date' => Carbon::parse($request->to_date)->format('Y-m-d')]);
            $sale_payments = DB::table("sale_payments")
                ->whereNull('deleted_at')
                ->whereDate('date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('payment_method_id', $request->payment_method_id)
                ->select("payments.contact_id as contact_id", "sale_payments.date as txn_date", "sale_payments.code as code", "sale_payments.total_amount");

            $purchase_payments = DB::table("purchase_payments")
                ->whereNull('deleted_at')
                ->whereDate('date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('payment_method_id', $request->payment_method_id)
                ->select("payments.contact_id as contact_id", "purchase_payments.date as txn_date", "purchase_payments.code as code", "purchase_payments.total_amount");

            $Transaction = DB::table("payments")
                ->whereNull('deleted_at')
                ->whereDate('date', '>=', Carbon::parse($request->from_date)->format('y-m-d'))
                ->whereDate('date', '<=', Carbon::parse($request->to_date)->format('y-m-d'))
                ->where('payment_method_id', $request->payment_method_id)
                ->select("make_transactions.type as type", "make_transactions.contact_id as contact_id", "make_transactions.date as txn_date", "make_transactions.code as code", "make_transactions.amount")
                ->unionall($sale_payments)
                ->unionall($purchase_payments)
                ->orderBy('txn_date', 'asc')
                ->get();
            $openingBalance = $openingClosingPayment->opening_balance + $openingClosingTransaction->opening_balance;
            $GetFilterData[1]['id'] = 1;
            $GetFilterData[1]['code'] = '';
            $GetFilterData[1]['txn_date'] = '';
            $GetFilterData[1]['particulars'] = 'Previous Opening Balance';
            $GetFilterData[1]['debit'] = '';
            $GetFilterData[1]['credit'] = '';
            $GetFilterData[1]['balance'] = $openingBalance;
            $x = 2;
            $CreditBalance = $openingBalance + $openingClosingPayment->current_balance + $openingClosingTransaction->current_balance;
        } else {
            $Transaction = [];
            $CreditBalance = false;
        }
        foreach ($Transaction as $getTransaction) {

            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['txn_date'] = Carbon::parse($getTransaction->txn_date)->format('d-M-Y');
            $GetFilterData[$x]['code'] = $getTransaction->code;

            if ($getTransaction->type == 'SupplierPayment') {
                $GetFilterData[$x]['particulars'] = 'Expense';
                $GetFilterData[$x]['credit'] = $getTransaction->amount;
                $openingBalance = $openingBalance - $getTransaction->amount;
                $GetFilterData[$x]['debit'] = '';
            } else if ($getTransaction->type == 'CustomerPayment') {
                $GetFilterData[$x]['particulars'] = 'Income';
                $GetFilterData[$x]['debit'] = $getTransaction->amount;
                $openingBalance = $openingBalance + $getTransaction->amount;
                $GetFilterData[$x]['credit'] = '';
            } else if ($getTransaction->type == 'SupplierPayment') {
                $GetFilterData[$x]['particulars'] = 'Supplier Payment';
                $GetFilterData[$x]['credit'] = $getTransaction->amount;
                $openingBalance = $openingBalance - $getTransaction->amount;

                $GetFilterData[$x]['debit'] = '';
            } else if ($getTransaction->type == 'CustomerPayment') {
                $GetFilterData[$x]['particulars'] = 'Customer Payment';
                $GetFilterData[$x]['debit'] = $getTransaction->amount;
                $openingBalance = $openingBalance + $getTransaction->amount;
                $GetFilterData[$x]['credit'] = '';
            }


            $GetFilterData[$x]['balance'] = $openingBalance;
            ++$x;
        }
        if ($CreditBalance) {
            $GetFilterData[$x]['id'] = $x;
            $GetFilterData[$x]['code'] = '';
            $GetFilterData[$x]['txn_date'] = '';
            $GetFilterData[$x]['particulars'] = 'Closing Balance';
            $GetFilterData[$x]['debit'] = '';
            $GetFilterData[$x]['credit'] = '';
            $GetFilterData[$x]['balance'] = $CreditBalance;
        }

        return DataTables::of($GetFilterData)->toJson();
    }

    public function CashBankBookReport()
    {

        $paymentMethods = PaymentMethod::get();
        return view('Reports.cash_bank_book_report', compact('paymentMethods'));
    }


    public function IncomeStatementData(Request $request)
    {


        $GrossProfit = DB::table('products')
            ->leftJoin('sale_invoice_details', 'sale_invoice_details.product_id', '=', 'products.id')
            ->leftJoin('sale_invoices', 'sale_invoice_details.sale_invoice_id', '=', 'sale_invoices.id')
            ->whereNull('sale_invoice_details.deleted_at')
            ->whereBetween('sale_invoices.sale_date', [Carbon::parse(request()->from_date)->format('Y-m-d'), Carbon::parse(request()->to_date)->format('Y-m-d')])
            ->selectRaw(DB::raw('
        sum(sale_invoice_details.quantity) as sales_qty,
        sum(sale_invoice_details.quantity*sale_invoice_details.unit_price) as sales_amount,
         products.id as product_id'))
            ->groupBy('products.id')
            ->get();

        $GrossProfit->map(function ($Product) {
            $Product->CostOfGoodSold = $Product->sales_qty * $this->getStock(['product_id' => $Product->product_id])['avg_item_price'];
            return $Product;
        });
        $getExpense = ChartOfAccount::where('is_active', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chart_of_groups')
                    ->whereRaw('chart_of_groups.id = chart_of_accounts.chart_of_group_id')
                    ->whereRaw('chart_of_groups.name = "Expense"');
            })
            ->get();

        $getExpenses = $getExpense->map(function ($item, $key) {
            $item->accounts = $item->TransactionTotal(Carbon::parse(request()->from_date)->format('Y-m-d'), Carbon::parse(request()->to_date)->format('Y-m-d'));
            return $item;
        });

        $getIncome = ChartOfAccount::where('is_active', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chart_of_groups')
                    ->whereRaw('chart_of_groups.id = chart_of_accounts.chart_of_group_id')
                    ->whereRaw('chart_of_groups.name = "Income"');
            })
            ->get();

        $getIncomes = $getIncome->map(function ($item, $key) {
            $item->accounts = $item->TransactionTotal(Carbon::parse(request()->from_date)->format('Y-m-d'), Carbon::parse(request()->to_date)->format('Y-m-d'));
            return $item;
        });

        $getData = [];

        $i = 0;
        $getData[$i]['details'] = '<h4>Sales</h4>';
        $getData[$i]['subtotal'] = '';
        $getData[$i]['total'] = '';
        ++$i;

        $getData[$i]['details'] = 'Sales Amount(+)';
        $getData[$i]['subtotal'] = number_format($GrossProfit->sum('sales_amount'), 2, '.', '');
        $getData[$i]['total'] = '';
        ++$i;
        $shippingCharge = SaleInvoice::whereDate('sale_date', '>=', Carbon::parse(request()->from_date)->format('Y-m-d'))->whereDate('sale_date', '<=', Carbon::parse(request()->to_date)->format('Y-m-d'))->sum('shipping_charge');
        $getData[$i]['details'] = 'Sales Shipping Charge (+)';
        $getData[$i]['subtotal'] = $shippingCharge;
        $getData[$i]['total'] = '';
        ++$i;
        $discount = SaleInvoice::whereDate('sale_date', '>=', Carbon::parse(request()->from_date)->format('Y-m-d'))->whereDate('sale_date', '<=', Carbon::parse(request()->to_date)->format('Y-m-d'))->sum('discount');
        $getData[$i]['details'] = 'Sales Discount (-)';
        $getData[$i]['subtotal'] = $discount;
        $getData[$i]['total'] = '';
        ++$i;


        $getData[$i]['details'] = 'Cost Of Goods Sold (-)';
        $getData[$i]['subtotal'] = number_format($GrossProfit->sum('CostOfGoodSold'), 2, '.', '');
        $getData[$i]['total'] = '';
        ++$i;

        $getData[$i]['details'] = 'Gross Margin (+/-)';
        $getData[$i]['subtotal'] = '-';
        $getData[$i]['total'] =  number_format(($GrossProfit->sum('sales_amount') + $shippingCharge) - ($GrossProfit->sum('CostOfGoodSold') + $discount), 2);
        ++$i;

        $getData[$i]['details'] = '<h4>Operating Expense</h4>';
        $getData[$i]['subtotal'] = '';
        $getData[$i]['total'] = '';
        ++$i;

        $totalExpense = 0;
        foreach ($getExpenses as $getExpense) {
            $totalExpense += $getExpense->accounts;
            $getData[$i]['details'] = $getExpense->name;
            $getData[$i]['subtotal'] = number_format($getExpense->accounts, 2);
            $getData[$i]['total'] = '-';
            ++$i;
        }

        $getData[$i]['details'] = 'Total Expense (-)';
        $getData[$i]['subtotal'] = '-';
        $getData[$i]['total'] = number_format($totalExpense, 2);
        ++$i;

        $getData[$i]['details'] = '<h4>Operating Income</h4>';
        $getData[$i]['subtotal'] = '';
        $getData[$i]['total'] = '';
        ++$i;

        $totalIncome = 0;
        foreach ($getIncomes as $getIncome) {
            $totalIncome += $getIncome->accounts;
            $getData[$i]['details'] = $getIncome->name;
            $getData[$i]['subtotal'] = number_format($getIncome->accounts, 2);
            $getData[$i]['total'] = '-';
            ++$i;
        }

        $getData[$i]['details'] = '<h4>Total Income (+)</h4>';
        $getData[$i]['subtotal'] = '-';
        $getData[$i]['total'] = number_format($totalIncome, 2);
        ++$i;

        $getData[$i]['details'] = '<h3>Net Income (+/-)</h3>';
        $getData[$i]['subtotal'] = '-';
        $getData[$i]['total'] = number_format(($GrossProfit->sum('sales_amount') + $shippingCharge) - ($GrossProfit->sum('CostOfGoodSold') + $discount) + $totalIncome - $totalExpense, 2);
        ++$i;

        return DataTables::of($getData)
            ->rawColumns(['details'])
            ->toJson();
    }
    public function IncomeStatement()
    {
        $branches = Branch::get();
        return view('Reports.income_statement_report', compact('branches'));
    }




    public function StockReportData(Request $request)
    {
        $stock_item = Product::query();

        if ($request->category_id) {
            $stock_item->where('category_id', $request->category_id);
        }
        if ($request->branch_id) {
            $stock_item->where('branch_id', $request->branch_id);
        }
        if ($request->item_id) {
            $stock_item->where('id', $request->item_id);
        }
        $stock_item->get();

        $this->i = 1;

        return DataTables::of($stock_item)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('category_id', function ($data) {
                return $data->Category ? $data->Category->name : '';
            })
            ->addColumn('current_stock', function ($data) {
                if ($data->PurchaseInvoiceDetail && $data->SaleInvoiceDetail) {
                    return $data->PurchaseInvoiceDetail->sum('quantity') - $data->SaleInvoiceDetail->sum('quantity');
                } elseif ($data->PurchaseInvoiceDetail) {
                    return $data->PurchaseInvoiceDetail->sum('quantity');
                } elseif ($data->SaleInvoiceDetail) {
                    return (0 - $data->SaleInvoiceDetail->sum('quantity'));
                }
            })
            ->addColumn('total', function ($data) {
                $qty = 0;
                if ($data->PurchaseInvoiceDetail && $data->SaleInvoiceDetail) {
                    $qty = $data->PurchaseInvoiceDetail->sum('quantity') - $data->SaleInvoiceDetail->sum('quantity');
                } elseif ($data->PurchaseInvoiceDetail) {
                    $qty = $data->PurchaseInvoiceDetail->sum('quantity');
                } elseif ($data->SaleInvoiceDetail) {
                    $qty = (0 - $data->SaleInvoiceDetail->sum('quantity'));
                }

                return $qty * $data->regular_price;
            })
            ->toJson();
    }
    public function StockReport()
    {
        $branches = Branch::get();
        $categories = Category::get();
        $items = Product::get();
        return view('Reports.stock_report', compact('branches', 'categories', 'items'));
    }
    public function SaleDetailReportData(Request $request)
    {
        $sales = DB::table('sale_invoice_details')
            ->join('sale_invoices', 'sale_invoices.id', '=', 'sale_invoice_details.sale_invoice_id')
            ->join('products', 'products.id', '=', 'sale_invoice_details.product_id')
            ->join('contacts', 'contacts.id', '=', 'sale_invoices.contact_id')
            ->join('branches', 'branches.id', '=', 'sale_invoice_details.branch_id')
            ->whereNull('sale_invoice_details.deleted_at')
            ->orderBy('id', 'desc')
            ->select('sale_invoice_details.*', 'contacts.first_name as contact_name', 'sale_invoices.code as invoice_code', 'products.name as product_name', 'branches.name as branch_name');
        if ($request->branch_id) {
            $sales->where('sale_invoice_details.branch_id', $request->branch_id);
        }
        if ($request->category_id) {
            $sales->where('products.category_id', $request->category_id);
        }
        if ($request->contact_id) {
            $sales->where('sale_invoices.contact_id', $request->contact_id);
        }
        if ($request->from_date && $request->to_date) {
            $sales->whereDate('sale_invoice_details.created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('sale_invoice_details.created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d'));
        }
        $sales->get();
        $this->i = 1;

        return DataTables::of($sales)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('sale_subtotal', function ($data) {
                return $data->quantity  * $data->unit_price;
            })
            ->toJson();
    }

    public function SaleDetailReport()
    {
        $ContactLists = Contact::where('type', 'Customer')->get();
        $branches = Branch::get();
        $categories = Category::get();

        return view('Reports.sale_details_report', compact('branches', 'categories', 'ContactLists'));
    }
    public function PurchaseDetailReportData(Request $request)
    {
        $sales = DB::table('purchase_invoice_details')
            ->join('purchase_invoices', 'purchase_invoices.id', '=', 'purchase_invoice_details.purchase_invoice_id')
            ->join('products', 'products.id', '=', 'purchase_invoice_details.product_id')
            ->join('contacts', 'contacts.id', '=', 'purchase_invoices.contact_id')
            ->join('branches', 'branches.id', '=', 'purchase_invoice_details.branch_id')
            ->whereNull('purchase_invoice_details.deleted_at')
            ->orderBy('id', 'desc')
            ->select('purchase_invoice_details.*', 'contacts.first_name as contact_name', 'purchase_invoices.code as invoice_code', 'products.name as product_name', 'branches.name as branch_name');
        if ($request->branch_id) {
            $sales->where('purchase_invoice_details.branch_id', $request->branch_id);
        }
        if ($request->category_id) {
            $sales->where('products.category_id', $request->category_id);
        }
        if ($request->contact_id) {
            $sales->where('purchase_invoices.contact_id', $request->contact_id);
        }
        if ($request->from_date && $request->to_date) {
            $sales->whereDate('purchase_invoice_details.created_at', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('purchase_invoice_details.created_at', '<=', Carbon::parse($request->to_date)->format('Y-m-d'));
        }
        $sales->get();
        $this->i = 1;

        return DataTables::of($sales)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('purchase_subtotal', function ($data) {
                return $data->quantity  * $data->unit_price;
            })
            ->toJson();
    }

    public function PurchaseDetailReport()
    {
        $ContactLists = Contact::where('type', 'Supplier')->get();
        $branches = Branch::get();
        $categories = Category::get();

        return view('Reports.purchase_details_report', compact('branches', 'categories', 'ContactLists'));
    }
    public function SaleReportData(Request $request)
    {
        $accounts_sale_invoice = SaleInvoice::query();

        if ($request->contact_id) {
            $accounts_sale_invoice->where('contact_id', $request->contact_id);
        }
        if ($request->branch_id) {
            $accounts_sale_invoice->where('branch_id', $request->branch_id);
        }
        $accounts_sale_invoice->whereDate('sale_date', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('sale_date', '<=', Carbon::parse($request->to_date)->format('Y-m-d'))->get();

        $this->i = 1;

        return DataTables::of($accounts_sale_invoice)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('user_id', function ($data) {
                return $data->User ? $data->User->name : '';
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('paid_amount', function ($data) {
                return $data->PurchasePayment ? $data->PurchasePayment->sum('total_amount') : 0;
            })
            ->addColumn('due', function ($data) {
                return $data->SalePayment ? $data->payable_amount - $data->SalePayment->sum('total_amount') : $data->payable_amount;
            })
            ->addColumn('discount', function ($data) {
                return $data->discount ? $data->discount : 0;
            })
            ->addColumn('shipping_charge', function ($data) {
                return $data->shipping_charge ? $data->shipping_charge : 0;
            })
            ->addColumn('vat', function ($data) {
                return $data->vat ? $data->vat : 0;
            })
            ->addColumn('branch_id', function ($data) {
                if ($data->Branch) {
                    return $data->Branch ? $data->Branch->name : '';
                } else {
                    return null;
                }
            })
            ->toJson();
    }

    public function SaleReport()
    {
        $ContactLists = Contact::where('type', 'Customer')->get();
        $branches = Branch::get();
        return view('Reports.sale_report', compact('ContactLists', 'branches'));
    }

    public function PurchaseReportDate(Request $request)
    {
        $accounts_sale_invoice = PurchaseInvoice::query();

        if ($request->contact_id) {
            $accounts_sale_invoice->where('contact_id', $request->contact_id);
        }
        if ($request->branch_id) {
            $accounts_sale_invoice->where('branch_id', $request->branch_id);
        }

        $accounts_sale_invoice->whereDate('purchase_date', '>=', Carbon::parse($request->from_date)->format('Y-m-d'))->whereDate('purchase_date', '<=', Carbon::parse($request->to_date)->format('Y-m-d'))->get();

        $this->i = 1;

        return DataTables::of($accounts_sale_invoice)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('user_id', function ($data) {
                return $data->User ? $data->User->name : '';
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('paid_amount', function ($data) {
                return $data->PurchasePayment ? $data->PurchasePayment->sum('total_amount') : 0;
            })
            ->addColumn('due', function ($data) {
                return $data->PurchasePayment ? $data->payable_amount - $data->PurchasePayment->sum('total_amount') : $data->payable_amount;
            })
            ->addColumn('discount', function ($data) {
                return $data->discount ? $data->discount : 0;
            })
            ->addColumn('shipping_charge', function ($data) {
                return $data->shipping_charge ? $data->shipping_charge : 0;
            })
            ->addColumn('vat', function ($data) {
                return $data->vat ? $data->vat : 0;
            })
            ->addColumn('branch_id', function ($data) {
                if ($data->Branch) {
                    return $data->Branch ? $data->Branch->name : '';
                } else {
                    return null;
                }
            })
            ->toJson();
    }

    public function PurchaseReport()
    {
        $ContactLists = Contact::where('type', 'Supplier')->get();
        $branches = Branch::get();
        return view('Reports.purchase_report', compact('ContactLists', 'branches'));
    }
}
