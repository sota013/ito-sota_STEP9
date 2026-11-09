<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ListedProductDetailController extends Controller
{
    public function show($id)
    {
        $product = Product::getProductByUser($id, auth()->id());

        return view('products.listed_show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::getProductByUser($id, auth()->id());
    
        $product->deleteProduct();
    
        return redirect()
            ->route('mypage')
            ->with('success', '商品を削除しました。');
    }
}