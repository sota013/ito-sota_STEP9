<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductCreateController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('products', 'public');
        }

        Product::registerProduct([
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'product_name' => $validated['product_name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'img_path' => $imagePath,
        ]);

        return redirect()
            ->route('mypage')
            ->with('success', '商品を登録しました。');
    }
}
