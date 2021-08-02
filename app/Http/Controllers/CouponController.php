<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\CouponsImport;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::with('product')->get();
        $products = Product::all();
        if (view()->exists('pages.coupon.create')) {
            return view('pages.coupon.create', compact('coupons', 'products'));
        }
        return abort(404);
    }

    public function unused()
    {
        $coupons = Coupon::where('status', 'Unused')->with('product')->get();
        $products = Product::all();
        if (view()->exists('pages.coupon.create')) {
            return view('pages.coupon.create', compact('coupons', 'products'));
        }
        return abort(404);
    }

    public function used()
    {
        $coupons = Coupon::where('status', 'Used')->with('product')->get();
        $products = Product::all();
        if (view()->exists('pages.coupon.create')) {
            return view('pages.coupon.create', compact('coupons', 'products'));
        }
        return abort(404);
    }

    public function store(CouponStoreRequest $request)
    {
        $response = Coupon::create($request->validated());
        if($response)
        {
            return  redirect()->route('coupons.index')->withSuccess('Coupon saved successfully!');
        }
        return  redirect()->route('coupons.index')->withError("Something wen't wrong!");
    }

    public function import(Request $request)
    {
        $a = $request->validate([
            'file' => 'required|file|mimes:xlsx, xls|max:2048'
        ]);

        $response = Excel::import(new CouponsImport, $request->file);
        if($response)
        {
            return  redirect()->route('coupons.index')->withSuccess('Coupon uploaded successfully!');
        }
        return  redirect()->route('coupons.index')->withError("Something wen't wrong!");
    }

    public function edit(Coupon $coupon)
    {
        $coupons = Coupon::with('product')->get();
        $products = Product::all();
        return view('pages.coupon.update', compact('coupon', 'coupons', 'products'));
    }

    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $response = $coupon->update($request->validated());
        if($response)
        {
            return  redirect()->route('coupons.index')->withSuccess('Coupon updated successfully!');
        }
        return  redirect()->route('users.index')->withError("Something wen't wrong!");
    }
}
