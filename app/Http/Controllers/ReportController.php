<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

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
                    // 'status' => 'required',
                    'reportDate' => 'required',
                ]);
                $status = 'Used';
                
                $explodedTxt = explode(" to ", $request->reportDate);
                // $report = Coupon::where('status', $request->status)->whereDate('updated_at', '>=', $explodedTxt[0])->whereDate('updated_at', '<=',  $explodedTxt[1])->get();
                // $report = Coupon::where('status', $request->status)->whereBetween('updated_at', [$explodedTxt[0], $explodedTxt[1]])->with('product')->get();
                // $report = Coupon::where([['product_id', '=', $request->product] ])->whereBetween('updated_at', [$explodedTxt[0], $explodedTxt[1]])->with('product')->get();
                $report = Coupon::where([['product_id', '=', $request->product], ['status', '=', $status] ])->whereBetween('updated_at', [$explodedTxt[0], $explodedTxt[1]])->with('product')->get();
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
