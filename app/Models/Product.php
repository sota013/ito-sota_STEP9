<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function searchProducts($keyword, $min_price, $max_price)
    {
        return self::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('product_name', 'like', '%' . $keyword . '%');
            })
            ->when($min_price !== null && $min_price !== '', function ($query) use ($min_price) {
                $query->where('price', '>=', $min_price);
            })
            ->when($max_price !== null && $max_price !== '', function ($query) use ($max_price) {
                $query->where('price', '<=', $max_price);
            })
            ->when(auth()->check(), function ($query) {
                $query->where('user_id', '!=', auth()->id());
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    public function isLikedBy($user_id): bool
    {
        return $this->likes()
            ->where('user_id', $user_id)
            ->exists();
    }

    public function getProductsByUser($user_id)
    {
        return self::where('user_id', $user_id)->get();
    }

    public static function registerProduct($product_data)
    {
        return self::create($product_data);
    }

    public function updateProduct($product_data)
    {
        return $this->update($product_data);
    }

    public function deleteProduct()
    {
        return $this->delete();
    }

    public static function getProductById($product_id)
    {
        return self::findOrFail($product_id);
    }

    public static function getAvailableProductById($product_id)
    {
        return self::where('id', $product_id)
            ->where('stock', '>', 0)
            ->firstOrFail();
    }
    
    public static function getProductForUpdate($product_id)
    {
        return self::where('id', $product_id)
            ->lockForUpdate()
            ->firstOrFail();
    }
    
    public function decreaseStock($quantity)
    {
        return $this->decrement('stock', $quantity);
    }

    public static function getProductByUser($product_id, $user_id)
    {
        return self::where('user_id', $user_id)
            ->findOrFail($product_id);
    }
}
