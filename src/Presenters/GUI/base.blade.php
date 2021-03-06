<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ url('/') }}" />
    <link rel="canonical" href="{{ url('/') }}" />
    <title>{{ $title }} | @yield('location')</title>
    <meta charset="utf-8" />
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="{{ $themeColor }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{ $description }}" />
    <meta name="author" content="{{ $author }}" />
    <meta name="keyword" content="{{ $keywords }}" />
    {{-- Facebook Twitter --}}
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:site_name" content="{{ $title }}"/>
    <meta property="og:image" content="{{ custom_asset('img/favicon-32x32.png') }}"/>
    <meta property="og:url" content="{{ url('/') }}"/>
    <meta property="og:description" content="{{ $description }}"/>
    <meta name="twitter:title" content="{{ $title }}"/>
    <meta name="twitter:image" content="{{ custom_asset('img/favicon-32x32.png') }}"/>
    <meta name="twitter:url" content="{{ url('/') }}"/>
    <meta name="twitter:card" content="summary"/>
    {{-- Apple and Android app capable --}}
    <link rel="manifest" href="{{ custom_asset('manifest.json') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="{{ $themeColor }}" />
    <meta name="apple-mobile-web-app-title" content="{{ $title }}" />
    <link rel="icon" href="{{ custom_asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ custom_asset('img/apple-touch-icon.png') }}" />
    {{-- Microsoft app capable --}}
    <meta name="msapplication-TitleImage" content="{{ custom_asset('img/android-chrome-192x192.png') }}" />
    <meta name="msapplication-TitleColor" content="{{ $themeColor }}" />
    {{-- CSS Files --}}
    <link rel="stylesheet" type="text/css" href="{{ custom_asset('css/app.css') }}" />
    @yield('css_files')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    {{-- JS Files --}}
    <script src="{{ custom_asset('js/app.js') }}"></script>
    @yield('js_files')
</body>
</html>
