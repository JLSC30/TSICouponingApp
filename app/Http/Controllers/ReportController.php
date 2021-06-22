<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        if (view()->exists('pages.report.index'))
        {
            if ($request->hasAny('status', 'reportDate'))
            {
                $request->validate([
                    'status' => 'required',
                    'reportDate' => 'required',
                ]);
                
                $explodedTxt = explode(" to ", $request->reportDate);
                // $report = Coupon::where('status', $request->status)->whereDate('updated_at', '>=', $explodedTxt[0])->whereDate('updated_at', '<=',  $explodedTxt[1])->get();
                $report = Coupon::where('status', $request->status)->whereBetween('updated_at', [$explodedTxt[0], $explodedTxt[1]])->get();
            }
            else
            {
                $report = [];
            }
            return view('pages.report.index', compact('report'));
        }
        return abort(404);
    }
}
