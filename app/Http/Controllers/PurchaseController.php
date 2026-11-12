<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function create($id)
    {
        $product = Product::getAvailableProductById($id);

        return view('products.purchase', compact('product'));
    }

    public function store(StorePurchaseRequest $request, $id)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($id, $validated) {
            $product = Product::getProductForUpdate($id);

            if ($product->stock <= 0) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => '在庫切れのため購入できません。',
                ]);
            }

            if ($validated['quantity'] > $product->stock) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'quantity' => '在庫数を超える数量は購入できません。',
                ]);
            }

            Sale::registerPurchase(
                auth()->id(),
                $product->id,
                $validated['quantity']
            );

            $product->decreaseStock($validated['quantity']);
        });

        return redirect()
            ->route('products.index')
            ->with('success', '購入が完了しました。');
    }
}
