<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $products = Product::searchProducts(
            $keyword,
            $min_price,
            $max_price
        );

        if ($request->ajax()) {
            return response()->json([
                'html' => view('products.partials.list', [
                    'products' => $products,
                ])->render(),
            ]);
        }
        
        return view('products.index', [
            'products' => $products,
            'keyword' => $keyword,
            'minPrice' => $min_price,
            'maxPrice' => $max_price,
        ]);
    }
}
