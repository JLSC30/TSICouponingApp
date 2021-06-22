<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.product.create', compact('products'));
    }

    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['sku'] = Str::slug($validatedData['sku'], '-');

        $response = Product::create($validatedData);
        if($response)
        {
            return  redirect()->route('products.index')->withSuccess('Product saved successfully!');
        }
        return  redirect()->route('products.index')->withError("Something wen't wrong!");
    }

    public function show(Product $product)
    {
        $products = Product::all();
        return view('pages.product.update', compact('products', 'product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $validatedData['sku'] = Str::slug($validatedData['sku'], '-');

        $response = $product->update($validatedData);
        if($response)
        {
            return  redirect()->route('products.index')->withSuccess('Product updated successfully!');
        }
        return  redirect()->route('products.index')->withError("Something wen't wrong!");
    }

    public function destroy(Product $product)
    {
        $response = $product->delete();
        if($response)
        {
            return  redirect()->route('products.index')->withSuccess('Product deleted successfully!');
        }
        return  redirect()->route('products.index')->withError("Something wen't wrong!");
    }
}
