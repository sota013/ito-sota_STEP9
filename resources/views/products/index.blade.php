@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<div class="products-container">
    <h1 class="page-title">商品一覧</h1>

    <form
        action="{{ route('products.index') }}"
        method="GET"
        class="search-form"
        id="search-form"
    >
        <input
            type="text"
            name="keyword"
            placeholder="商品名を入力"
            value="{{ $keyword ?? '' }}"
        >

        <input
            type="number"
            name="min_price"
            placeholder="最低価格"
            value="{{ $minPrice ?? '' }}"
            min="0"
        >

        <span>～</span>

        <input
            type="number"
            name="max_price"
            placeholder="最高価格"
            value="{{ $maxPrice ?? '' }}"
            min="0"
        >

        <button type="submit">検索</button>
    </form>

    <div class="products-table-wrapper" id="products-table-wrapper">
        @include('products.partials.list', ['products' => $products])
    </div>
</div>

@endsection