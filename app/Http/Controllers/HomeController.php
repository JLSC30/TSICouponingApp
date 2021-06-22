<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('coupon')->get();
        return view('home', compact('products'));
    }

    public function html_email()
    {
        $product = Product::with('coupon')->get();
        foreach ($product as $p)
        {
            if($p->coupon->where('status', 'Unused')->count() <= 100)
            {
                $data = [
                    'product' => $p->name,
                    'count' => $p->coupon->where('status', 'Unused')->count(),
                ];
                // dd(env('ADMIN_EMAIL'));
                Mail::send('pages.email.index', $data, function($message) {
                    $message->to(env('ADMIN_EMAIL'), env('ADMIN_NAME'))->subject
                        ('Coupon App email alert');
                    $message->from(env('MAIL_USERNAME'),env('MAIL_FROM_NAME'));
                });
                echo "Email Sent with attachment. Check your inbox.";
            }
        }
    }

    public function triggerAlert()
    {
        
        $response = Artisan::call('coupon:alert');
        if(!$response)
        {
            return redirect()->route('home')->withSuccess('Alert successfully sent!');
        }
        return  redirect()->route('home')->withError("Something wen't wrong!");
    }
}
