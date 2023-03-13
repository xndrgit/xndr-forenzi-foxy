{{-- copypaste of the app.blade.php --}}
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

    <title>
        Foxy
        {{-- {{ config('app.name', 'Foxy') }} --}}
    </title>

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
    <link
        href="{{ mix('css/app.css') }}"
        rel="stylesheet"
    >
</head>

<body>
<div id="app">
</div>

<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/front.js') }}" defer></script>

@stack('scripts')
</body>

</html>
