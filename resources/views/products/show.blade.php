@extends('layouts.app')

@section('title', $product->product_name . ' - 商品詳細')

@section('content')

<div class="product-detail-container">

    <h1 class="page-title">商品詳細</h1>
    <div class="product-detail">
        <div class="product-detail-info">
            <p>商品名：{{ $product->product_name }}</p>
            <p>説明：{{ $product->description }}</p>
            @if ($product->img_path)
                <div class="product-detail-image">
                    <img
                    src="{{ asset('storage/' . $product->img_path) }}"
                    alt="{{ $product->product_name }}"
                    >
                </div>
            @endif

            <p>金額：￥{{ number_format($product->price) }}</p>
            <p>会社：{{ $product->company->company_name ?? '未設定' }}</p>
            <div class="like-area">
                @if ($isLiked)
                    <form action="{{ route('products.like', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="heart-button liked" aria-label="お気に入り解除">
                            ♥
                        </button>
                    </form>
                @else
                    <form action="{{ route('products.like', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="heart-button" aria-label="お気に入り登録">
                            ♥
                        </button>
                    </form>
                @endif
            </div>

            @if ($product->stock > 0)
                <a
                    href="{{ route('products.purchase.create', $product->id) }}"
                    class="purchase-button"
                >
                    カートに追加する
                </a>
            @else
                <p>在庫切れのため購入できません。</p>
            @endif

            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif

            <a href="{{ route('products.index') }}" class="back-link">
                戻る
            </a>
        </div>
    </div>
</div>

@endsection
