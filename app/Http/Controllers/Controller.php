<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // success info question error warning
        $this->middleware(function($request, $next){
            if(session('success'))
            {
                toast(session('success'),'success')->timerProgressBar()->autoClose(3000)->position('bottom-end');
            }
            if(session('info'))
            {
                toast(session('info'),'info')->timerProgressBar()->autoClose(3000)->position('bottom-end');
            }
            if(session('question'))
            {
                toast(session('question'),'question')->timerProgressBar()->autoClose(3000)->position('bottom-end');
            }
            if(session('error'))
            {
                toast(session('error'),'error')->timerProgressBar()->autoClose(3000)->position('bottom-end');
            }
            if(session('warning'))
            {
                toast(session('warning'),'warning')->timerProgressBar()->autoClose(3000)->position('bottom-end');
            }
            if(session('api'))
            {
                toast(session('api'),'success')->timerProgressBar()->width('40rem')->autoClose(5000)->position('bottom-end');
            }

            return $next($request);
        });
    }
}
