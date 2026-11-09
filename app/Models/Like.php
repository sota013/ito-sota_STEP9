<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'product_id'];

        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function toggleLike($user_id, $product_id)
    {
        $like = self::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
    
        if ($like) {
            $like->delete();
        } else {
            self::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
            ]);
        }
    }
}
