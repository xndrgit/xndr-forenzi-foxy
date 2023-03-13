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

    <title>Foxy</title>

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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/datatables.bundle.css') }}" rel="stylesheet">

    <script>
        window.laravel = '{!! json_encode(['csrfToken' => csrf_token()]) !!}';
    </script>
</head>

<body>
<div id="app" class="admin-panel">
    <nav class="HeaderTop navbar navbar-expand-md navbar shadow-sm">
        <div class="d-flex">
            <button
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}"
                class="navbar-toggler collapsed"
                data-target="#navbarSupportedContent"
                data-toggle="collapse"
                type="button"
                id="toggle-nav-button"
            >
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <div class="nav-item mx-3">
                <a href="/admin/home" class="navbar-brand font-weight-bold text-white">
                    <i class="fa-2x fas fa-box"></i>
                    <span>FoxyBox</span>
                </a>
            </div>

            <div
                class="collapse navbar-collapse"
                id="navbarSupportedContent"
            >
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                        <li class="nav-item dropdown mx-1">
                            <a
                                class="nav-link "
                                href="{{ route('admin.users.index') }}"
                            >
                                Utenti
                            </a>
                            <div
                                aria-labelledby="navbarDropdown"
                                class="dropdown-menu"
                            >
                                <a
                                    class="dropdown-item"
                                    href="{{ route('admin.users.index') }}"
                                >Visualizza tutti gli utenti</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown mx-1">

                            <a
                                class="nav-link "
                                href="{{ route('admin.products.index') }}"
                            >
                                Prodotti
                            </a>
                        </li>

                        <li class="nav-item dropdown mx-1">
                            <a
                                class="nav-link"
                                href="{{ route('admin.categories.index') }}"
                            >
                                Categorie
                            </a>

                        </li>

                        <li class="nav-item dropdown mx-1">
                            <a
                                class="nav-link"
                                href="{{ route('admin.subcategories.index') }}"
                            >
                                Sottocategorie
                            </a>

                        </li>

                        <li class="nav-item dropdown mx-1">
                            <a
                                class="nav-link"
                                href="{{ route('admin.orders.index') }}"
                            >
                                Ordini
                            </a>

                        </li>

                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">

                            <a
                                class="nav-link d-flex align-items-center"
                                href="{{ route('login') }}"
                            >
                                <i class="fa-sm fa-sharp fa-solid fa-right-to-bracket"></i>
                                {{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a
                                    class="nav-link d-flex align-items-center"
                                    href="{{ route('register') }}"
                                >
                                    <i class="fa-sm fas fa-user-plus"></i>
                                    {{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a
                                aria-expanded="false"
                                aria-haspopup="true"
                                class="nav-link dropdown-toggle"
                                data-toggle="dropdown"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                v-pre
                            >
                                {{ Auth::user()->name }}
                            </a>

                            <div
                                aria-labelledby="navbarDropdown"
                                class="dropdown-menu dropdown-menu-right"
                            >
                                <a
                                    class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                >
                                    {{ __('Logout') }}
                                </a>

                                <form
                                    action="{{ route('logout') }}"
                                    class="d-none"
                                    id="logout-form"
                                    method="POST"
                                >
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="d-flex col-12 justify-content-center">
                    <a
                        class="main-logo ml-3 w-75 d-flex justify-content-center"
                        href="{{ url('/admin/home') }}"
                    >
                        <img
                            alt=""
                            class="img-fluid"
                            src="{{ asset('img/logo.png') }}"
                        >
                    </a>

                </div>
            </div>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
    </main>

    <div id="background-cover"></div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/vendor-jquery.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/datatables.bundle.js') }}"></script>
<script src="{{ mix('js/admin.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>

@stack('scripts')
</body>

</html>
