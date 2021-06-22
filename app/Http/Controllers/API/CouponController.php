<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;

class CouponController extends Controller
{
    public function getProduct()
    {
        // return Product::with('coupon')->get();
    }

    public function getProductData()
    {
        // return Product::with('coupon')->where('status', 'Used')->get();
    }

    public function update($sku)
    {
        $product = Product::where('sku', $sku)->first();
        if($product !== null)
        {
            $data = Coupon::where('product_id', $product->id)->where('status', 'Unused')->first();
            if($data === null)
            {
                $returnedData = [
                    'coupon' => null,
                    'sku'=> $sku,
                    'status' => 404,
                ];
            }
            else
            {
                $returnedData = [
                    'coupon' => $data->code,
                    'sku'=> $sku,
                    'status' => 202,
                ];
                $data->update(['status' => 'Used']);
            }
        }    
        else
        {
            $returnedData = [
                'coupon' => null,
                'sku'=> $sku,
                'status' => 404,
            ];
        }  
        
        return json_encode($returnedData);
    }
}
