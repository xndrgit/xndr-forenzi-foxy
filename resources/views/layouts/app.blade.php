<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        content="width=device-width, initial-scale=1"
        name="viewport"
    >

    <!-- CSRF Token -->
    <meta
        content="{{ csrf_token() }}"
        name="csrf-token"
    >

    <meta property="og:title" content="FoxyBox - SCATOLE IN TEMPI RECORD"/>
    <meta property="og:url" content="https://www.foxyboxi.it/"/>
    <meta property="og:image" content="https://www.foxyboxi.it/img/logo.png"/>

    <title>Foxy @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('foxyboxi.ico') }}"/>

    <!-- Fonts -->
    <link
        href="//fonts.gstatic.com"
        rel="dns-prefetch"
    >
    <link
        href="https://fonts.googleapis.com/css?family=Nunito"
        rel="stylesheet"
    >

    <!-- Styles -->
    <link href="{{ mix('css/datatables.bundle.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('styles')

    <script>
        window.laravel = '{!! json_encode(['csrfToken' => csrf_token()]) !!}';
    </script>
</head>

<body>
<div id="app" class="admin-panel">
    <x-layout.navbar></x-layout.navbar>

    <x-layout.main>
        <div class="main-content">
            {{ $slot }}
        </div>
    </x-layout.main>

    <div id="background-cover"></div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/admin.js') }}"></script>

@stack('scripts')
</body>

</html>
