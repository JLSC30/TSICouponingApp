<?php

use App\Http\Controllers\API\CouponController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/getProduct', [CouponController::class, 'getProduct']);
// Route::get('/getProductData', [CouponController::class, 'getProductData']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('v1/coupon')->group(function () {
        // Route::put('/{sku}', [CouponController::class, 'update']);
        Route::put('/{sku}/{count}', [CouponController::class, 'ac8dcdb2']);
    });
});
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact admin@trainondemand.online'], 404);
});