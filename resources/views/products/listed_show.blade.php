@extends('layouts.app')

@section('title', '出品商品詳細')

@section('content')

<div class="listed-product-container">

    <div class="listed-product-info">
        <p>商品名：{{ $product->product_name }}</p>
        <p>説明：{{ $product->description }}</p>
    </div>

    @if ($product->img_path)
        <div class="listed-product-image">
            <img
                src="{{ asset('storage/' . $product->img_path) }}"
                alt="{{ $product->product_name }}"
            >
        </div>
    @endif

    <p class="listed-product-price">
        金額：¥{{ number_format($product->price) }}
    </p>

    <div class="listed-product-buttons">
        <a href="{{ route('products.edit', $product->id) }}"
            class="listed-edit-button">
            編集
        </a>

        <form
            action="{{ route('mypage.products.destroy', $product->id) }}"
            method="POST"
            onsubmit="return confirm('この商品を削除してもよろしいですか？');"
        >
            @csrf
            @method('DELETE')

            <button type="submit" class="listed-delete-button">
                削除する
            </button>
        </form>

        <a href="{{ route('mypage') }}" class="listed-back-button">
            戻る
        </a>
    </div>
</div>

@endsection
