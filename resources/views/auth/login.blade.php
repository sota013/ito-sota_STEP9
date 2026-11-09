@extends('layouts.app')

@section('title', 'ログイン')

@section('content')

<div class="login-container">
    <div class="login-card">
        <div class="login-card-header">
            <h1>ログイン</h1>
        </div>
        <form action="{{ route('login.store') }}" method="POST" class="login-form">
            @csrf

            @if ($errors->any())
                <div class="login-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="login-form-group">
                <label for="email">メールアドレス</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="login-form-group">
                <label for="password">パスワード</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <div class="login-submit">
                <button type="submit">ログイン</button>
            </div>
        </form>

        <p class="login-register-link">
            アカウントをお持ちでない方は
            <a href="{{ route('register') }}">会員登録</a>
        </p>
    </div>
</div>

@endsection
