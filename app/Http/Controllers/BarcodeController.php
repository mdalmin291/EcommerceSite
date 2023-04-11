<?php

namespace App\Http\Controllers;

use App\Models\Backend\ProductInfo\Product;
use App\Models\Backend\Setting\CompanyInfo;
use Illuminate\Http\Request;
use DNS1D;

class BarcodeController extends Controller
{
    public function GetMatarialProductSearch(Request $Request)
    {

        $this->code = $Request->code;

        $ProductSearch = Product::select('id', 'name', 'code', 'purchase_price','regular_price')
            ->where(function ($query) {
                $query->Where('code', 'LIKE', '%'.$this->code.'%')
                    ->orWhere('name', 'LIKE', '%'.$this->code.'%');
            })
            ->limit(30)->get();

        $ProductSearch->map(function ($Product) {
            $Product->product_name = $Product->name;
            return $Product;
        });

        return response()->json($ProductSearch);
    }

    public function GenerateBarcode()
    {
        return view('generate_barcode');
    }
    public function BarcodePrint(Request $request)
    {
        $companyInfo=CompanyInfo::first();
        $itemBarcode = [];
        $i = 0;
        for ($x = 0; $x < count($request->product_id); ++$x) {
            for ($y = 0; $y < $request->quantity[$x]; ++$y) {
                $itemBarcode[$i]['company'] = $companyInfo->name;
                $itemBarcode[$i]['name'] = $request->product_name[$x];
                $itemBarcode[$i]['code'] = $request->product_code[$x];
                $itemBarcode[$i]['amount'] = $request->sale_rate[$x];
                $itemBarcode[$i]['barcode'] = 'data:image/png;base64,'.DNS1D::getBarcodePNG($request->product_code[$x], 'C128', 1, 25);
                ++$i;
            }
        }

        return view('barcode_print', compact('itemBarcode'));
    }
}
