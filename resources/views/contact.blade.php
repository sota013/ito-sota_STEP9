@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')

<div class="contact-container">

    <h1 class="page-title">お問い合わせフォーム</h1>

    <form action="{{ route('contact.send') }}"
        method="POST"
        class="contact-form">

        @csrf

        {{-- 名前 --}}
        <div class="form-group">
            <label for="name">名前</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label for="message">お問い合わせ内容</label>
            <textarea
                id="message"
                name="message"
                rows="6"
                required
            >{{ old('message') }}</textarea>
            @error('message')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- ボタン --}}
        <div class="contact-buttons">
            <button type="submit" class="purchase-button">
                送信
            </button>

            <a href="{{ route('products.index') }}" class="back-link">
                戻る
            </a>
        </div>

    </form>

</div>

@endsection
