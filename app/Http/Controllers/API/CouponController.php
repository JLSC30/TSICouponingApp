<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

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
            Log::info('Selected product is '. $product->name);
            $data = Coupon::where('product_id', $product->id)->where('status', 'Unused')->first();
            if($data === null)
            {
                Log::info('No coupon found!');
                $returnedData = [
                    'coupon' => null,
                    'sku'=> $sku,
                    'status' => 404,
                ];
            }
            else
            {
                Log::info('Your coupon for product '. $product->name.' is '. $data->code);
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
            Log::info('No product found!');
            $returnedData = [
                'coupon' => null,
                'sku'=> $sku,
                'status' => 404,
            ];
        }  
        
        Log::info('Return into JSON format');
        return json_encode($returnedData);
    }

    public function ac8dcdb2($sku, $count)
    {
        $product = Product::where('sku', $sku)->first(); 
        if($product !== null)
        {
            Log::info('Selected product is '. $product->name);
            $data = Coupon::where('product_id', $product->id)->where('status', 'Unused')->take($count)->get(['code']);
            if($data === null)
            {
                Log::info('No coupon found!');
                $returnedData = [
                    'coupon' => null,
                    'sku'=> $sku,
                    'status' => 404,
                ];
            }
            else
            {
                Log::info('You generated '. $data->count() .' coupon out of '. $count .' for the product '. $product->name);
                $returnedData = [
                    'coupon' => $data->toArray(),
                    'sku'=> $sku,
                    'status' => 202,
                ];

                foreach($data as $i)
                {
                    $i->update(['status' => 'Used']);
                }
            }
        }    
        else
        {
            Log::info('No product found!');
            $returnedData = [
                'coupon' => null,
                'sku'=> $sku,
                'status' => 404,
            ];
        }  
        
        Log::info('Return into JSON format');
        return json_encode($returnedData);
    }
}
