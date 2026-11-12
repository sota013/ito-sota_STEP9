<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cytech EC')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <div class="site-logo">
            Cytech EC
        </div>

        <nav class="header-nav">
            <a href="{{ route('products.index') }}">Home</a>
            <a href="{{ route('mypage') }}">マイページ</a>
        </nav>

        <div class="header-user">
            @auth
                <span>{{ Auth::user()->name_kanji }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        ログアウト
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">ログイン</a>
            @endauth
        </div>
    </div>
</header>

<main class="main-content">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="footer-inner">

        <a href="{{ route('contact') }}" class="contact-button">
            お問い合わせ
        </a>

        <nav class="footer-nav">
            <a href="{{ route('products.index') }}">Home</a>
            <a href="{{ route('mypage') }}">マイページ</a>
        </nav>

        <div class="footer-copy">
            © 2024 Company, Inc
        </div>

    </div>
</footer>

@stack('scripts')

</body>
</html>