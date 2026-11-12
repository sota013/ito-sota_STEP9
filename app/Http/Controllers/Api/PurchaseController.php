<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchaseController extends Controller
{
    public function store(StorePurchaseRequest $request, $id)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($id, $validated, $request) {
            $product = Product::getProductForUpdate($id);

            if ($product->stock <= 0) {
                throw ValidationException::withMessages([
                    'quantity' => '在庫切れのため購入できません。',
                ]);
            }

            if ($validated['quantity'] > $product->stock) {
                throw ValidationException::withMessages([
                    'quantity' => '在庫数を超える数量は購入できません。',
                ]);
            }

            Sale::registerPurchase(
                $request->user()->id,
                $product->id,
                $validated['quantity']
            );

            $product->decreaseStock($validated['quantity']);
        });

        return response()->json([
            'message' => '購入が完了しました。',
        ], 201);
    }
}
