<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="宿泊予約サイト" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <link rel="icon" href="{{ asset('/favicon.ico') }}" /> --}}
    <link rel="apple-touch-icon" href="{{ asset('/favicon.ico') }}" />
    <meta property="og:site_name" content="{{ config('app.name', '宿泊予約サイト') }}" />
    {{-- TODO 本番環境のURLにする --}}
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name', '宿泊予約サイト') }}" />
    <meta property="og:description" content="宿泊予約ができるサイト" />
    <meta property="og:locale" content="ja_JP" />
    {{-- TODO 本番環境のシェア用画像のURLを絶対パスで指定する --}}
    {{--
    <meta property="og:image" content="{{ asset('friends.png') }}" /> --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="宿泊予約サイト" />
    {{-- TODO Twitter専用の記述です。シェアされた時に表示したい画像を絶対パスで設定 --}}
    {{--
    <meta name="twitter:image:src" content="{{ asset('friends.png') }}" /> --}}

    {{-- 宿泊詳細でカレンダーのbootstrapのテーマを読み込む --}}
    @if (!empty($calendar_theme_bootstrap))
        {{ $calendar_theme_bootstrap }}
    @endif

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css',])
    <title>{{ config('app.name', '宿泊予約サイト') }}</title>
</head>

<body>
    <x-header></x-header>
    <main>
        {{ $slot }}
    </main>
</body>

</html>