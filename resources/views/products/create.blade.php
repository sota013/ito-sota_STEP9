@extends('layouts.app')

@section('title', '商品登録')

@section('content')

<div class="product-create-container">

    <h1 class="page-title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST"
        enctype="multipart/form-data" class="product-create-form">
        @csrf

        <div class="form-group">
            <label for="product_name">商品名</label>
            <input type="text" id="product_name" name="product_name"
                value="{{ old('product_name') }}" required>
            @error('product_name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="number" id="price" name="price"
                min="0" value="{{ old('price') }}" required>
            @error('price')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea id="description" name="description"
                rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">在庫数</label>
            <input type="number" id="stock" name="stock"
                min="0" value="{{ old('stock') }}" required>
            @error('stock')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="img_path">商品画像</label>
            <input type="file" id="img_path" name="img_path"
                accept="image/jpeg,image/png,image/webp" required>
            @error('img_path')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="product-create-buttons">
            <a href="{{ route('products.index') }}" class="back-link">
                戻る
            </a>

            <button type="submit" class="purchase-button">
                登録
            </button>
        </div>

    </form>

</div>

@endsection
