<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/html_email', [App\Http\Controllers\HomeController::class, 'html_email'])->name('html_email');


Route::group(['middleware' => 'auth'], function (){

    Route::resource('products', ProductController::class);
    Route::resource('coupons', CouponController::class, ['except'=>['show','create', 'update', 'destroy', 'edit']]);
    Route::post('coupons/import', [CouponController::class, 'import'])->name('coupon.import');
    Route::get('coupons/unused', [CouponController::class, 'unused'])->name('coupons.unused');
    Route::get('coupons/used', [CouponController::class, 'used'])->name('coupons.used');

    Route::resource('profile', ProfileController::class, ['except'=>['show','create', 'store', 'destroy', 'edit']]);
    Route::get('profile/changePassword', [ProfileController::class, 'changePasswordForm'])->name('profile.changepassword');
    Route::put('profile/changePassword/{id}', [ProfileController::class, 'changePassword'])->name('profile.change');
    Route::post('profile/generateApiKey', [ProfileController::class, 'generateApiKey'])->name('profile.generateApiKey');
    Route::post('profile/deleteApiKey', [ProfileController::class, 'deleteApiKey'])->name('profile.deleteApiKey');

    Route::resource('users', UserController::class, ['except'=>['show','create']]);
    Route::resource('report', ReportController::class, ['except'=>['create','store', 'show', 'edit', 'update', 'destroy']]);

    // Route::get('/sendAlert', [App\Http\Controllers\HomeController::class, 'triggerAlert'])->name('sendAlert');

    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        if (!$exitCode)
        {
            return redirect()->route('home');
        }
        abort('500');
    })->name('config-cache');

    Route::get('/optimize', function() {
        $exitCode = Artisan::call('optimize');
        if (!$exitCode)
        {
            return redirect()->route('home');
        }
        abort('500');
    })->name('optimize');

});