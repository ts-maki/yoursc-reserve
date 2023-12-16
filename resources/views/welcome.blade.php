<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css',])
        
    </head>
    <body class="">
        <header class="bg-success text-dark bg-opacity-10">
            <div class="container d-flex justify-content-between align-items-center">
                {{-- <a href="{{ route('post.index') }}" class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('friends.png') }}" alt="みんなの掲示板のロゴ" width="70">
                    <h1 class="fs-4 fw-bold">みんなの<span class="header__title"></span>掲示板</h1>
                </a> --}}
                <nav class="navbar">
                    <ul class="d-flex">
                        @auth
                        <li class="nav-item"><a class="nav-link active text-dark p-2" aria-current="page"
                                href="{{ route('profile.edit') }}">アカウント設定</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="nav-link p-2">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">ログアウト</a>
                                </form>
                            </li>
                            @endauth
                            @guest
                        <li class="nav-item">
                            <a class="nav-link text-dark p-2" href="{{ route('register') }}">ユーザー登録</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark p-2" href="{{ route('login') }}">ログイン</a>
                        </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </header>
        <h1 class="text-bg-secondary">こんにちは</h1>
    </body>
</html>
