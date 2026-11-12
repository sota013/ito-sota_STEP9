<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function registerPurchase($user_id, $product_id, $quantity)
    {
        return self::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
    }

    public static function getSalesByUser($user_id)
    {
        return self::with('product')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
