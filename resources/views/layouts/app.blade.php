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

    <!-- Scripts -->
    <script
        src="{{ asset('js/app.js') }}"
        defer
    ></script>

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
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >

    <script>
        window.laravel = '{!! json_encode(['csrfToken' => csrf_token()]) !!}';
    </script>
</head>

<body>
    <div id="app">
        <nav class="HeaderTop navbar navbar-expand-md navbar shadow-sm">
            <div class="container">
                <a
                    class="navbar-brand"
                    href="{{ url('/') }}"
                >
                    <img
                        alt=""
                        src="{{ asset('img/logo.png') }}"
                    >
                    {{-- {{ config('app.name', 'Foxy') }} --}}
                </a>
                <button
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}"
                    class="navbar-toggler"
                    data-target="#navbarSupportedContent"
                    data-toggle="collapse"
                    type="button"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

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

                            {{-- <li class="nav-item dropdown mx-1">
                                <a
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    class="nav-link dropdown-toggle"
                                    data-toggle="dropdown"
                                    href="{{ route('admin.users.index') }}"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
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
                            </li> --}}
                            <li class="nav-item dropdown mx-1">

                                <a
                                    class="nav-link "
                                    href="{{ route('admin.products.index') }}"
                                >
                                    Prodotti
                                </a>
                                {{-- <div
                                    aria-labelledby="navbarDropdown"
                                    class="dropdown-menu"
                                >
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('admin.products.index') }}"
                                    >Visualizza tutti i prodotti</a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('admin.products.create') }}"
                                    >Aggiungi un nuovo prodotto</a>
                                </div> --}}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>

<style
    lang="scss"
    scoped
>
    .navbar {
        width: 100%;
        height: fit-content;
        background-color: rgb(245, 133, 47);
        color: white;
        padding: 0px;
    }

    .navbar img {
        height: 20px;
        transition: .3s;
    }

    .navbar img:hover {
        transform: scale(1.01)
    }

    .navbar i {
        margin-right: .8rem;
    }

    .navbar a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: .2s ease-in;
    }

    .navbar a:hover {
        color: black;
        transform: scale(1.2)
    }
</style>
