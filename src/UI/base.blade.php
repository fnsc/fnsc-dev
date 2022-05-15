<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ url('/') }}" />
    <link rel="canonical" href="{{ url('/') }}" />
    <title>{{ $title = config('app.name') }} | @yield('title')</title>
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
    <meta property="og:image" content="{{ asset('img/image.png') }}"/>
    <meta property="og:url" content="{{ url('/') }}"/>
    <meta property="og:description" content="{{ $description }}"/>
    <meta name="twitter:title" content="{{ $title }}"/>
    <meta name="twitter:image" content="{{ asset('img/image.png') }}"/>
    <meta name="twitter:url" content="{{ url('/') }}"/>
    <meta name="twitter:card" content="summary"/>
    {{-- Apple and Android app capable --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="{{ $title }}" />
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon_57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon_60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon_72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon_76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon_114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon_120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon_144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon_152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon_180.png') }}" />
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('img/favicon_512.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/favicon_120.png') }}" />
    {{-- Microsoft app capable --}}
    <meta name="msapplication-TitleImage" content="{{ asset('img/favicon_144.png') }}" />
    <meta name="msapplication-TitleColor" content="{{ $themeColor }}" />
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons" />
    {{-- CSS Files --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}" />
    @yield('css_files')
</head>
<body>
    <div id="app"></div>
    {{-- JS Files --}}
    <script src="{{ asset('js/base.js') }}"></script>
    @yield('js_files')
</body>
</html>
