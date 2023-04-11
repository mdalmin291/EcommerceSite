<?php

namespace App\Providers;

use App\Http\Livewire\UserProfile\ProfileSettings;
use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\PurchaseInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Inventory\PurchasePayment;
use App\Models\Backend\Inventory\SalePayment;
use App\Models\Backend\ProductInfo\Brand;
use App\Models\Backend\ProductInfo\Category;
use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\ProductInfo\SubCategory;
use App\Models\Backend\ProductInfo\SubSubCategory;
use App\Models\Backend\Setting\BreakingNews;
use App\Models\Backend\Setting\CompanyInfo;
use App\Models\UserProfile\ProfileSetting as UserProfileSetting;
use App\Models\Backend\Setting\InvoiceSetting;
use App\Models\Backend\Setting\Language;
use App\Models\Backend\Setting\ShippingCharge;
use App\Models\District;
use App\Models\User;
use App\Models\FrontEnd\Order;
use App\Models\Inventory\Currency;
use App\Models\Notification;
use App\Models\Setting\Slider;
use App\Services\AddToCardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
       }
        //Categories
        // dd(Product::whereFeatured('New Product')->whereIsActive(1)->orderBy('id', 'desc')->take(3)->get());
        View::composer('*', function ($view) {
            $view->with('language', Language::whereIsDefault(1)->first());
            $view->with('categories', Category::select('id','name','image1','image2')->orderBy('id', 'desc')->get());
            $view->with('topFourCategories', Category::select('id','name','image1','image2')->take(4)->get());
            $view->with('topCategories', Category::select('id','name','image1','image2')->skip(4)->take(200)->get());
            $view->with('categoryImageLast', Category::select('id','image1','image2','name')->whereTopShow(1)->orderBy('id', 'desc')->first());
            $view->with('subCategories', SubCategory::select('id','image','name')->orderBy('id', 'desc')->get());
            $view->with('subSubCategories', SubSubCategory::select('id','name','image')->orderBy('id', 'desc')->get());
            // $view->with('subSubCategories', SubSubCategory::orderBy('id', 'desc')->get());
            $view->with('newProducts', Product::select('id','name','regular_price','special_price','discount','category_id','color','size','brand_id','low_alert','min_order_qty','in_stock')->whereFeatured('New Product')->whereIsActive(1)->orderBy('id', 'desc')->take(3)->get());
            $view->with('brands', Brand::select('id','name','image')->get());
            $view->with('sliders', Slider::select('id','title','image')->orderBy('id', 'desc')->get());
            $view->with('sliderImages', Slider::select('id','title','image')->orderBy('position')->whereIsActive(1)->get());
            $view->with('sliderImageLast', Slider::select('id','title','image')->orderBy('id', 'desc')->whereIsActive(1)->first());
            $view->with('companyInfo', CompanyInfo::select('id','name','phone','mobile','address','hotline','email','web','logo','privacy_policy','google_map_location','google_map_location','terms_condition','about_us','return_policy','front_end_top_header_color','front_end_bottom_header_color','front_end_menu_color','front_end_top_footer_color','front_end_bottom_footer_color')->first());
            $view->with('profilesettings', UserProfileSetting::select('id','profile_photo','business_name','email','name','address','mobile','postal_code','city','country')->first());
            $view->with('InvoiceSetting', InvoiceSetting::whereCreatedBy(Auth::id())->first());
            $view->with('currencySymbol', Currency::select('id','symbol')->whereIsActive(1)->first());
            $view->with('cardBadge', AddToCardService::cardTotalProductAndAmount());
            $view->with('BreakingNews', BreakingNews::select('id','news')->whereIsActive(1)->get());
            $view->with('Districts', District::orderBy('name', 'asc')->get());
            $view->with('orders_count', Order::whereStatus('processing')->count());
            $view->with('shipping_charges', ShippingCharge::select('id','title','shipping_fee')->get());
            $allUser = User::count();
            $view->with('allUser', $allUser);
            $view->with('notifications', Notification::where('status', null)->get());
        });

        View::composer('livewire.dashboard', function ($view) {
            // Start Month Wise Sell
            $i = 12;
            while ($i > 0) {
                $i--;
                $month[$i] = date('Y-m', strtotime("-$i month"));
                // dd($month[$i]);
            }

            $totalSale = SaleInvoice::whereBetween('sale_date', [$month[11] . '-01', $month[0] . '-31'])->sum('payable_amount');
            $one = SaleInvoice::whereBetween('sale_date', [$month[11] . '-01', $month[11] . '-31'])->sum('payable_amount');
            $two = SaleInvoice::whereBetween('sale_date', [$month[10] . '-01', $month[10] . '-29'])->sum('payable_amount');
            $three = SaleInvoice::whereBetween('sale_date', [$month[9] . '-01', $month[9] . '-31'])->sum('payable_amount');
            $four = SaleInvoice::whereBetween('sale_date', [$month[8] . '-01', $month[8] . '-30'])->sum('payable_amount');
            $five = SaleInvoice::whereBetween('sale_date', [$month[7] . '-01', $month[7] . '-31'])->sum('payable_amount');
            $six = SaleInvoice::whereBetween('sale_date', [$month[6] . '-01', $month[6] . '-30'])->sum('payable_amount');
            $seven = SaleInvoice::whereBetween('sale_date', [$month[5] . '-01', $month[5] . '-31'])->sum('payable_amount');
            $eight = SaleInvoice::whereBetween('sale_date', [$month[4] . '-01', $month[4] . '-31'])->sum('payable_amount');
            $nine = SaleInvoice::whereBetween('sale_date', [$month[3] . '-01', $month[3] . '-30'])->sum('payable_amount');
            $ten = SaleInvoice::whereBetween('sale_date', [$month[2] . '-01', $month[2] . '-31'])->sum('payable_amount');
            $eleven = SaleInvoice::whereBetween('sale_date', [$month[1] . '-01', $month[1] . '-30'])->sum('payable_amount');
            $twelve = SaleInvoice::whereBetween('sale_date', [$month[0] . '-01', $month[0] . '-31'])->sum('payable_amount');


            if ($totalSale == 0) {
                $totalSale = 1;
            }

            $view->with('totalSale', $totalSale);
            $view->with('one', $one);
            $view->with('two', $two);
            $view->with('three', $three);
            $view->with('four', $four);
            $view->with('five', $five);
            $view->with('six', $six);
            $view->with('seven', $seven);
            $view->with('eight', $eight);
            $view->with('nine', $nine);
            $view->with('ten', $ten);
            $view->with('eleven', $eleven);
            $view->with('twelve', $twelve);


            // End Month Wise Sell

            // Start Month Wise User Rate
            $allUser = User::count();
            // dd($year);
            $totalUser = User::whereBetween('created_at', [$month[11] . '-01', $month[0] . '-31'])->count();
            $month_1 = User::whereBetween('created_at', [$month[11] . '-01', $month[11] . '-31'])->count();
            $month_2 = User::whereBetween('created_at', [$month[10] . '-01', $month[10] . '-29'])->count();
            $month_3 = User::whereBetween('created_at', [$month[9] . '-01', $month[9] . '-31'])->count();
            $month_4 = User::whereBetween('created_at', [$month[8] . '-01', $month[8] . '-30'])->count();
            $month_5 = User::whereBetween('created_at', [$month[7] . '-01', $month[7] . '-31'])->count();
            $month_6 = User::whereBetween('created_at', [$month[6] . '-01', $month[6] . '-30'])->count();
            $month_7 = User::whereBetween('created_at', [$month[5] . '-01', $month[5] . '-31'])->count();
            $month_8 = User::whereBetween('created_at', [$month[4] . '-01', $month[4] . '-31'])->count();
            $month_9 = User::whereBetween('created_at', [$month[3] . '-01', $month[3] . '-30'])->count();
            $month_10 = User::whereBetween('created_at', [$month[2] . '-01', $month[2] . '-31'])->count();
            $month_11 = User::whereBetween('created_at', [$month[1] . '-01', $month[1] . '-30'])->count();
            $month_12 = User::whereBetween('created_at', [$month[0] . '-01', $month[0] . '-31'])->count();

            if ($totalUser == 0) {
                $totalUser = 1;
            }
            $view->with('totalUser', $totalUser);
            $view->with('month_1', $month_1);
            $view->with('month_2', $month_2);
            $view->with('month_3', $month_3);
            $view->with('month_4', $month_4);
            $view->with('month_5', $month_5);
            $view->with('month_6', $month_6);
            $view->with('month_7', $month_7);
            $view->with('month_8', $month_8);
            $view->with('month_9', $month_9);
            $view->with('month_10', $month_10);
            $view->with('month_11', $month_11);
            $view->with('month_12', $month_12);
            // End Month Wise User Rate

            // Start Top Selling Product
            if ($allUser == 0) {
                $allUser = 1;
            }
            $view->with('allUser', $allUser);
            $view->with('total_quantity', SaleInvoiceDetail::sum('quantity'));
            $view->with('best_Selling_products', SaleInvoiceDetail::groupBy('product_id')
                ->selectRaw('product_id, sum(quantity) as quantity')
                ->orderBy('quantity', 'desc')
                ->take(5)
                ->get());
            // End Top Selling Product

            // Start Top Selling Product
            $view->with('top_five_customers', SaleInvoiceDetail::groupBy('sale_invoice_id')
                ->selectRaw('sale_invoice_id, sum(quantity) as quantity')
                ->orderBy('quantity', 'desc')
                ->take(5)
                ->get());
            // End Top Selling Product

            // Start Order

            $totalOrder = Order::whereBetween('order_date', [$month[11] . '-01', $month[0] . '-31'])->sum('payable_amount');
            if ($totalOrder == 0) {
                $totalOrder = 1;
            }
            $month_1_1 = Order::whereBetween('order_date', [$month[11] . '-01', $month[11] . '-31'])->sum('payable_amount');
            $month_2_2 = Order::whereBetween('order_date', [$month[10] . '-01', $month[10] . '-29'])->sum('payable_amount');
            $month_3_3 = Order::whereBetween('order_date', [$month[9] . '-01', $month[9] . '-31'])->sum('payable_amount');
            $month_4_4 = Order::whereBetween('order_date', [$month[8] . '-01', $month[8] . '-30'])->sum('payable_amount');
            $month_5_5 = Order::whereBetween('order_date', [$month[7] . '-01', $month[7] . '-31'])->sum('payable_amount');
            $month_6_6 = Order::whereBetween('order_date', [$month[6] . '-01', $month[6] . '-30'])->sum('payable_amount');
            $month_7_7 = Order::whereBetween('order_date', [$month[5] . '-01', $month[5] . '-31'])->sum('payable_amount');
            $month_8_8 = Order::whereBetween('order_date', [$month[4] . '-01', $month[4] . '-31'])->sum('payable_amount');
            $month_9_9 = Order::whereBetween('order_date', [$month[3] . '-01', $month[3] . '-30'])->sum('payable_amount');
            $month_10_10 = Order::whereBetween('order_date', [$month[2] . '-01', $month[2] . '-31'])->sum('payable_amount');
            $month_11_11 = Order::whereBetween('order_date', [$month[1] . '-01', $month[1] . '-30'])->sum('payable_amount');
            $month_12_12 = Order::whereBetween('order_date', [$month[0] . '-01', $month[0] . '-31'])->sum('payable_amount');

            $view->with('totalOrder', $totalOrder);
            if ($totalOrder == 0) {
                $totalOrder = 1;
            }
            $view->with('month_1_1', $month_1_1);
            $view->with('month_2_2', $month_2_2);
            $view->with('month_3_3', $month_3_3);
            $view->with('month_4_4', $month_4_4);
            $view->with('month_5_5', $month_5_5);
            $view->with('month_6_6', $month_6_6);
            $view->with('month_7_7', $month_7_7);
            $view->with('month_8_8', $month_8_8);
            $view->with('month_9_9', $month_9_9);
            $view->with('month_10_10', $month_10_10);
            $view->with('month_11_11', $month_11_11);
            $view->with('month_12_12', $month_12_12);
            // End Order

             // Start Current Month Purchase Payment
             $view->with('total_purchase_amount', PurchaseInvoice::whereBetween('purchase_date', [date('Y-m').'-01', date('Y-m').'-31'])->sum('total_amount'));
             $view->with('total_sale_amount', SaleInvoice::whereBetween('sale_date', [date('Y-m').'-01', date('Y-m').'-31'])->sum('total_amount'));
            //  dd(SalePayment::whereBetween('date', [date('Y-m').'-01', date('Y-m').'-31'])->sum('total_amount'));
             // End Current Month Purchase Payment

        });

    }
}
