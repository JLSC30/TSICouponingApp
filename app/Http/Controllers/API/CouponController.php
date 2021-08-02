<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function ac8dcdb2($sku, $count)
    {
        $product = Product::where('sku', $sku)->first();

        $public_runs = ['public', 'runs', 'public_runs'];

        $contains = Str::contains($product, $public_runs);
        
        if ($product)
        {
            Log::info('Selected product is '. $product->name);
            $data = Coupon::where('product_id', $product->id)->where('status', 'Unused')->take($count)->get(['id', 'code']);

            if($contains)
            {
                if($data)
                {
                    $result = [];
                    $result['sku'] = $sku;
                    $result['coupon'] = [];
                    for ($i = 0; $i < $count; $i++)
                    {
                        if (isset($data[$i]))
                        {
                            $result['coupon'][$i]['code'] = $data[$i]->code;
                            $result['coupon'][$i]['status'] = 202;
                            Log::info('This is a public runs code, cannot be set to used status');
                        }
                        else
                        {
                            $result['coupon'][$i]['code'] = null;
                            $result['coupon'][$i]['status'] = 404;
                        }
                    }
                    $returnedData = $result;
                }
                else
                {
                    Log::info('No coupon found!');
                    $returnedData = [
                        'coupon' => null,
                        'status' => 404,
                    ];
                }
                
            }
            else
            {
                if ($data)
                {
                    $result = [];
                    $result['sku'] = $sku;
                    $result['coupon'] = [];
                    for ($i = 0; $i < $count; $i++)
                    {
                        if (isset($data[$i]))
                        {
                            $result['coupon'][$i]['code'] = $data[$i]->code;
                            $result['coupon'][$i]['status'] = 202;

                            $data[$i]->update(['status' => 'Used']);
                            Log::info('Coupon '. $data[$i]->code . ' status set to used.');
                        }
                        else
                        {
                            $result['coupon'][$i]['code'] = null;
                            $result['coupon'][$i]['status'] = 404;
                        }
                    }
                    $returnedData = $result;
                }
                else
                {
                    Log::info('No coupon found!');
                    $returnedData = [
                        'coupon' => null,
                        'status' => 404,
                    ];
                }
            }
        }
        else
        {
            Log::info('No product found!');
            $returnedData = [
                'coupon' => null,
                'status' => 404,
            ];
        }

        Log::info('Return into JSON format');
        return json_encode($returnedData);
    }
}
