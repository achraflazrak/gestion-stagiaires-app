<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('accueil') }}">
            DSI stage app
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login') && Route::currentRouteName() != 'login')
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                </li>
                @endif

                @if (Route::has('register') && Route::currentRouteName() != 'register')
                <li class="nav-item mx-3">
                    <a class="btn btn-light" href="{{ route('register') }}">{{ __('S\'incrire') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa-solid fa-user{{ Auth::user()->is_admin ? '-tie' : '' }}"></i> {{ ucwords(Auth::user()->nom . ' ' . Auth::user()->prenom) }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Se déconnecter') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
