<nav class="HeaderTop navbar navbar-expand-md navbar shadow-sm">
    <div class="d-flex">
        <button
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
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
            <x-link
                class="navbar-brand font-weight-bold text-white"
                href="{{ url('/admin/home') }}"
            >
                <i class="fa-2x fas fa-box"></i>
                <span>FoxyBox</span>
            </x-link>
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
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.users.index') }}"
                        >
                            Utenti
                        </x-link>
                    </li>
                    <li class="nav-item dropdown mx-1">
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.products.index') }}"
                        >
                            Prodotti
                        </x-link>
                    </li>

                    <li class="nav-item dropdown mx-1">
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.categories.index') }}"
                        >
                            Categorie
                        </x-link>
                    </li>

                    <li class="nav-item dropdown mx-1">
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.subcategories.index') }}"
                        >
                            Sottocategorie
                        </x-link>
                    </li>

                    <li class="nav-item dropdown mx-1">
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.orders.index') }}"
                        >
                            Ordini
                        </x-link>
                    </li>

                    <li class="nav-item dropdown mx-1">
                        <x-link
                            class="nav-link"
                            href="{{ route('admin.jumbos.index') }}"
                        >
                            Jumbo
                        </x-link>
                    </li>
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <x-link
                            class="nav-link d-flex align-items-center"
                            href="{{ route('login') }}"
                        >
                            <i class="fa-sm fa-sharp fa-solid fa-right-to-bracket"></i>
                            {{ __('Accedi') }}
                        </x-link>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <x-link
                                class="nav-link d-flex align-items-center"
                                href="{{ route('register') }}"
                            >
                                <i class="fa-sm fas fa-user-plus"></i>
                                {{ __('Registrati') }}</a>
                            </x-link>
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
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
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
