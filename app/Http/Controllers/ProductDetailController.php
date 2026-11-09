<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        $product = Product::getProductById($id);

        $isLiked = auth()->check()
            && $product->isLikedBy(auth()->id());

        return view('products.show', compact('product', 'isLiked'));
    }
}