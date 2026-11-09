@extends('layouts.app')

@section('title', '会員登録')

@section('content')

<div class="register-container">
    <div class="register-card">
        <div class="register-card-header">
            <h1>会員登録</h1>
        </div>
        <form action="{{ route('register.store') }}" method="POST" class="register-form">
            @csrf

            <div class="register-form-group">
                <label for="name">ユーザー名</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name') }}" required>
            </div>

            <div class="register-form-group">
                <label for="name_kanji">名前（漢字）</label>
                <input type="text" id="name_kanji" name="name_kanji"
                    value="{{ old('name_kanji') }}" required>
            </div>

            <div class="register-form-group">
                <label for="name_kana">名前（カナ）</label>
                <input type="text" id="name_kana" name="name_kana"
                    value="{{ old('name_kana') }}">
            </div>

            <div class="register-form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}" required>
            </div>

            <div class="register-form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="register-form-group">
                <label for="password_confirmation">パスワード確認</label>
                <input type="password" id="password_confirmation"
                    name="password_confirmation" required>
            </div>

            <div class="register-submit">
                <button type="submit">登録する</button>
            </div>
        </form>
    </div>
</div>

@endsection
