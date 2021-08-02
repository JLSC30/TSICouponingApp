<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        if (view()->exists('pages.report.index'))
        {
            // if ($request->hasAny('status', 'reportDate'))
            if ($request->hasAny('product', 'reportDate'))
            {
                $request->validate([
                    'product' => 'required',
                    'reportDate' => 'required',
                ]);
                $status = 'Used';
                
                $explodedTxt = explode(" - ", $request->reportDate);
                $report = Coupon::where('product_id', $request->product)->whereBetween('updated_at', [$explodedTxt[0], $explodedTxt[1]])->where('status', $status)->with('product')->get();
            }
            else
            {
                $report = [];
            }
            $products = Product::all();
            return view('pages.report.index', compact('report', 'products'));
        }
        return abort(404);
    }
}
