<?php

namespace App\Http\Controllers;

use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\ContactInfo\ContactCategory;
use App\Models\Backend\Inventory\Invoice;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\ProductInfo\Brand;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\ProductInfo\ProductImage;
use App\Models\Backend\ProductInfo\ProductProperties;
use App\Models\Backend\ProductInfo\SubCategory;
use App\Models\Backend\ProductInfo\SubSubCategory;
use App\Models\Backend\ProductInfo\Unit;
use App\Models\Backend\ProductInfo\Color;
use App\Models\Backend\ProductInfo\Size;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\CompanyInfo;
use App\Models\Backend\Setting\CouponCode;
use App\Models\Backend\Setting\InvoiceSetting;
use App\Models\Backend\Setting\PaymentMethod;
use App\Models\Backend\Setting\ShippingCharge;
use App\Models\Backend\Setting\Vat;
use App\Models\Backend\Setting\Warehouse;
use App\Models\Backend\Setting\BreakingNews;
use App\Models\Backend\Setting\Language;
use App\Models\Inventory\Category;
use App\Models\Inventory\Currency;
use App\Models\Inventory\DeliveryMethod;
use App\Models\Backend\AccountsSetting\ChartOfAccount;
use App\Models\Backend\AccountsSetting\ChartOfGroup;
use App\Models\Backend\AccountsSetting\Transaction;
use App\Models\Setting\Slider;
use App\Models\FrontEnd\Vendor;
use App\Models\User as UserMm;
use App\Models\Backend\ProductInfo\ProductFeature;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class DatatableController extends Controller
{

    public function FeatureProductTable()
    {
        $Query = ProductFeature::query()->orderBy('position', 'asc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit unit')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete unit')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }

                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }
    public function VendorCancelListTable()
    {
        $Query = Vendor::query()->whereStatus('Cancel');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->toJSON();
    }
    public function VendorApprovedListTable()
    {
        $Query = Vendor::query()->whereStatus('Approved');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->toJSON();
    }
    public function VendorListTable()
    {
        $Query = Vendor::query()->whereStatus('Pending');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callApprove(' . $data->id . ')">Approve</button>
                    <button class="btn btn-danger btn-sm" onclick="callCancel(' . $data->id . ')">Cancel</button>';
            })
            ->rawColumns(['action'])
            ->toJSON();
    }
    public function LanguageListTable()
    {
        $Query = Language::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_default', function ($data) {
                return $data->is_default == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';

                $html .= '<a class="btn btn-info btn-sm" href="' . route('setting.manage-language', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="fas fa-tasks font-size-18"></i></a>';
                if (Auth::User()->can('edit language')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete language')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action', 'is_active'])
            ->toJSON();
    }
    public function NewsListTable()
    {
        $Query = BreakingNews::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit breaking_news')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete breaking_news')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action', 'is_active'])
            ->toJSON();
    }
    public function ShippingChargeTable()
    {
        $Query = ShippingCharge::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit shipping_charge')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete shipping_charge')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action', 'is_active'])
            ->toJSON();
    }

    public function ChartOfAccountTable()
    {
        $Query = ChartOfAccount::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('chart_of_group_id', function ($data) {
                return $data->ChartOfGroup ? $data->ChartOfGroup->name : '';
            })

            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit payment_method')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete payment_method')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }

                return $html;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJSON();
    }

    public function ChartOfGroupTable()
    {
        $Query = ChartOfGroup::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit payment_method')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete payment_method')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }

                return $html;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJSON();
    }

    public function PaymentTable()
    {
        $Query = Transaction::query()->orderBy('id', 'desc')->whereType('Payment');
        $this->i = 1;

        return Datatables::of($Query)

            ->addColumn('id', function ($data) {
                return  $this->i++;
            })

            ->addColumn('chart_of_account_id', function ($data) {
                return $data->ChartOfAccount ? $data->ChartOfAccount->name : '';
            })
            ->addColumn('payment_method_id', function ($data) {
                return $data->PaymentMethod ? $data->PaymentMethod->name : '';
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name : '';
            })

            ->addColumn('action', function ($data) {
                $html = '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $html .= 'Action';
                $html .= '</button>';

                $html .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                $html .= '<a title="Invoice" class="dropdown-item btn btn-warning btn-sm font-weight-bold  mb-1" onclick="callInvoice(' . $data->id . ')" target="_blank"> <i class="fas fa-eye "></i>&nbsp;View</a>';
                $html .= '<button title="Edit" class="dropdown-item btn btn-success btn-sm font-weight-bold  mb-1" onclick="callEdit(' . $data->id . ')">.<i class="fas fa-edit"></i>&nbsp;Edit</button>';
                $html .= '<button title="Delete" class="dropdown-item btn btn-danger btn-sm font-weight-bold  mb-1" onclick="callDelete(' . $data->id . ')"><i class="fas fa-trash"></i>&nbsp;Delete</button>';
                $html .= '</div></div>';

                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }


    public function ReceiveTable()
    {
        $Query = Transaction::query()->orderBy('id', 'desc')->whereType('Receive');
        $this->i = 1;

        return Datatables::of($Query)

            ->addColumn('id', function ($data) {
                return  $this->i++;
            })

            ->addColumn('chart_of_account_id', function ($data) {
                return $data->ChartOfAccount ? $data->ChartOfAccount->name : '';
            })
            ->addColumn('payment_method_id', function ($data) {
                return $data->PaymentMethod ? $data->PaymentMethod->name : '';
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name : '';
            })

            ->addColumn('action', function ($data) {
                $html = '<div class="dropdown"><button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $html .= 'Action';
                $html .= '</button>';

                $html .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                $html .= '<a title="Invoice" class="dropdown-item btn btn-warning btn-sm font-weight-bold  mb-1" onclick="callInvoice(' . $data->id . ')" target="_blank"> <i class="fas fa-eye "></i>&nbsp;View</a>';
                $html .= '<button title="Edit" class="dropdown-item btn btn-success btn-sm font-weight-bold  mb-1" onclick="callEdit(' . $data->id . ')">.<i class="fas fa-edit"></i>&nbsp;Edit</button>';
                $html .= '<button title="Delete" class="dropdown-item btn btn-danger btn-sm font-weight-bold  mb-1" onclick="callDelete(' . $data->id . ')"><i class="fas fa-trash"></i>&nbsp;Delete</button>';
                $html .= '</div></div>';

                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }



    public function SaleListTable()
    {
        $Query = SaleInvoice::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                $html .= '<button class="btn btn-dark btn-sm" onclick="sendMail(' . $data->id . ')" data-id="' . $data->id . '"><i class="fa fa-envelope font-size-18"></i></button>';
                $InvoiceSetting = InvoiceSetting::first();
                if($InvoiceSetting->type=='Receipt'){
                    $html .= '<a class="btn btn-info btn-sm" href="' . route('order.order-invoice-print', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="fas fa-eye font-size-18"></i></a>';
                }else{
                    $html .= '<a class="btn btn-info btn-sm" href="' . route('inventory.sale-invoice', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="fas fa-eye font-size-18"></i></a>';
                }
                $html .= '<a class="btn btn-success btn-sm" href="' . route('transaction.customer-payment', ['search' => $data->code]) . '" data-id="' . $data->id . '"><i class="fas fa-coins font-size-18"></i></a>';
                if (Auth::User()->can('edit sales')) {
                    $html .= '<a class="btn btn-primary btn-sm" href="' . route('inventory.sale', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="bx bx-edit font-size-18"></i></a>';
                }
                if (Auth::User()->can('delete sales')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['id', 'contact_id', 'action'])
            ->toJSON();
    }

    public function PurchaseListTable()
    {
        $Query = PurchaseInvoice::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('contact_id', function ($data) {
                return $data->Contact ? $data->Contact->first_name . ' ' . $data->Contact->last_name : '';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                $html .= '<button class="btn btn-dark btn-sm" onclick="sendMail(' . $data->id . ')" data-id="' . $data->id . '"><i class="fa fa-envelope font-size-18"></i></button>
                <a class="btn btn-info btn-sm" href="' . route('inventory.purchase-invoice', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="fas fa-eye font-size-18"></i></a>
                <a class="btn btn-success btn-sm" href="' . route('transaction.supplier-payment', ['search' => $data->code]) . '" data-id="' . $data->id . '"><i class="fas fa-coins font-size-18"></i></a>';
                if (Auth::User()->can('edit purchase')) {
                    $html .= '<a class="btn btn-primary btn-sm" href="' . route('inventory.purchase', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="bx bx-edit font-size-18"></i></a>';
                }
                if (Auth::User()->can('delete purchase')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['id', 'contact_id', 'action'])
            ->toJSON();
    }

    public function SliderTable()
    {
        $Query = Slider::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit slider')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete slider')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['category_id', 'image', 'action'])
            ->toJSON();
    }

    public function UnitTable()
    {
        $Query = Unit::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit unit')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete unit')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function InvoiceTable()
    {
        $Query = Invoice::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function CompanyInfoTable()
    {
        $Query = CompanyInfo::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit company_info')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete company_info')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function InvoiceSettingTable()
    {
        $Query = InvoiceSetting::query()->orderBy('id', 'desc');
        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->rawColumns(['image', 'action'])
            ->toJSON();
    }

    public function WarehouseTable()
    {
        $Query = Warehouse::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('branch_id', function ($data) {
                return $data->Branch ? $data->Branch->name : '';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit warehouse')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete warehouse')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action', 'branch_id'])
            ->toJSON();
    }

    public function DeliveryMethodTable()
    {
        $Query = DeliveryMethod::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('branch_id', function ($data) {
                return $data->Branch ? $data->Branch->name : '';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit delivery_method')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete delivery_method')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['branch_id', 'is_active', 'action'])
            ->toJSON();
    }

    public function CurrencyTable()
    {
        $Query = Currency::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit currency')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete currency')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJSON();
    }

    public function BranchTable()
    {
        $Query = Branch::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit branch')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete branch')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJSON();
    }

    public function paymentMethodTable()
    {
        $Query = PaymentMethod::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit payment_method')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete payment_method')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['is_active', 'action'])
            ->toJSON();
    }

    public function BrandTable()
    {
        $Query = Brand::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit brand')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete brand')) {
                if (!$data->BrandCheck) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
            }
                return $html;
            })
            ->rawColumns(['image', 'action'])
            ->toJSON();
    }

    public function ColorTable()
    {
        $Query = Color::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit brand')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete brand')) {
                if (!$data->BrandCheck) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
            }
                return $html;
            })
            ->rawColumns(['image', 'action'])
            ->toJSON();
    }

    public function SizeTable()
    {
        $Query = Size::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit brand')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete brand')) {
                if (!$data->BrandCheck) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
            }
                return $html;
            })
            ->rawColumns(['image', 'action'])
            ->toJSON();
    }

    public function VatTable()
    {
        $Query = Vat::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit vat')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('edit vat')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['image', 'is_active', 'action'])
            ->toJSON();
    }

    public function CouponTable()
    {
        $Query = CouponCode::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit coupon_code')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete coupon_code')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['image', 'is_active', 'action'])
            ->toJSON();
    }

    public function ContactCategoryTable()
    {
        $Query = ContactCategory::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit contact')) {
                $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }
                if (Auth::User()->can('delete contact')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['image', 'action'])
            ->toJSON();
    }

    public function CustomerTable()
    {
        $Query = Contact::query()->whereType('Customer')->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit contact')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }

                if (Auth::User()->can('delete contact')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function SupplierTable()
    {
        $Query = Contact::query()->whereType('Supplier')->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit contact')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }

                if (Auth::User()->can('delete contact')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function StaffTable()
    {
        $Query = Contact::query()->whereType('Staff')->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })

            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit contact')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }

                if (Auth::User()->can('delete contact')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['action'])
            ->toJSON();
    }

    public function ProductPropertiesTable()
    {
        $Query = ProductProperties::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('product_id', function ($data) {
                return $data->Product ? $data->Product->name : '';
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->rawColumns(['product_id', 'action'])
            ->toJSON();
    }

    public function ProductImageTable()
    {
        $Query = ProductImage::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('product_id', function ($data) {
                return $data->Product ? $data->Product->name : '';
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->rawColumns(['sub_category_id', 'image', 'action'])
            ->toJSON();
    }

    public function ProductTable()
    {
        $Query = Product::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('category_id', function ($data) {
                return $data->Category ? $data->Category->name : '';
            })
            ->addColumn('product_id', function ($data) {
                // return $data->ProductImageFirst ? $data->ProductImageFirst->image : '';
                if ($data->ProductImageFirst) {
                    $url = asset('storage/photo/' . $data->ProductImageFirst->image);
                } else {
                    $url = '';
                }


                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                $html .= '<button class="btn btn-info btn-sm" onclick="callDetail(' . $data->id . ')"><i class="fas fa-eye font-size-12"></i></button>';
                if (Auth::User()->can('edit product_list')) {
                $html .= '<a class="btn btn-primary btn-sm" href="' . route('product.product', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="bx bx-edit font-size-12"></i></a>';
                }
                if (Auth::User()->can('delete product_list')) {
                $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-12"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['category_id', 'image', 'product_id', 'is_active', 'action'])
            ->toJSON();
    }

    public function SubSubCategoryTable()
    {
        $Query = SubSubCategory::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('sub_category_id', function ($data) {
                return $data->SubCategory ? $data->SubCategory->name : '';
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->rawColumns(['sub_category_id', 'image', 'is_active', 'action'])
            ->toJSON();
    }

    public function SubCategoryTable()
    {
        $Query = SubCategory::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('category_id', function ($data) {
                return $data->Category ? $data->Category->name : '';
            })
            ->addColumn('image', function ($data) {
                $url = asset('storage/photo/' . $data->image);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit category')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }

                if (Auth::User()->can('delete category')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['category_id', 'image', 'is_active', 'action'])
            ->toJSON();
    }

    public function CategoryTable()
    {
        $Query = Category::query()->orderBy('id', 'desc');

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('is_active', function ($data) {
                return $data->is_active == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('image1', function ($data) {
                $url = asset('storage/photo/' . $data->image1);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image1" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('image2', function ($data) {
                $url = asset('storage/photo/' . $data->image2);

                return '<img src="' . $url . '" style="height:92px; weight:138px;" alt="Image2" class="img-fluid mx-auto d-block"/>';
            })
            ->addColumn('action', function ($data) {
                $html = '';
                if (Auth::User()->can('edit category')) {
                    $html .= '<button class="btn btn-primary btn-sm" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                }

                if (Auth::User()->can('delete category')) {
                    $html .= '<button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
                }
                return $html;
            })
            ->rawColumns(['image1', 'image2', 'is_active', 'action'])
            ->toJSON();
    }

    public function index()
    {
        return Datatables::of([])->make(true);
    }

    public function UserTable()
    {
        $Query = UserMm::query()->orderBy('id', 'desc')->get();

        $this->i = 1;

        return Datatables::of($Query)
            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('action', function ($data) {
                return '<a class="dropdown-item btn btn-primary btn-sm" href="' . route('user-management.user-restiction', ['id' => $data->id]) . '" data-id="' . $data->id . '"><i class="fa fa-lock font-size-18"></i></a>
                    <button class="btn btn-primary btn-sm ml-3" onclick="callEdit(' . $data->id . ')"><i class="bx bx-edit font-size-18"></i></button>';
                    // <button class="btn btn-danger btn-sm" onclick="callDelete(' . $data->id . ')"><i class="bx bx-window-close font-size-18"></i></button>';
            })
            ->toJSON();
    }
}
