<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductEditController extends Controller
{
    public function edit($id)
    {
        $product = Product::getProductByUser($id, auth()->id());

        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::getProductByUser($id, auth()->id());

        $validated = $request->validated();

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')
                ->store('products', 'public');

            $validated['img_path'] = $imagePath;
        } else {
            unset($validated['img_path']);
        }

        $product->updateProduct($validated);

        return redirect()->route('mypage')
            ->with('success', '商品を更新しました。');
    }
}
