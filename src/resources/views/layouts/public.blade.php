<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="public-body">

    <header class="site-header">
        <nav class="site-nav" aria-label="Menú principal">

            <a href="{{ route('home') }}" class="brand-link" aria-label="Ir a inicio">
                <img src="{{ asset('images/logo-solo.png') }}" alt="Logo G5 Sport" class="brand-logo">
                <span class="brand-name">G5 Sport</span>
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Inicio
                </a>

                <a href="{{ route('activities.index') }}" class="{{ request()->routeIs('activities.*') ? 'active' : '' }}">
                    Actividades
                </a>

                <a href="{{ route('installations.index') }}" class="{{ request()->routeIs('installations.*') ? 'active' : '' }}">
                    Instalaciones
                </a>

                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contacto
                </a>
            </div>

            <div class="auth-zone">
                @guest
                    <a href="{{ route('login') }}" class="login-button">
                        Iniciar Sesión
                    </a>
                @endguest

                @auth
                    <div class="user-summary" aria-label="Usuario identificado">
                        <span class="user-name">{{ auth()->user()->name }}</span>

                        <span class="user-role">
                            @if(auth()->user()->isAdmin())
                                Admin
                            @else
                                Socio
                            @endif
                        </span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button">
                            Cerrar sesión
                        </button>
                    </form>
                @endauth
            </div>

        </nav>
    </header>

    <div class="page-layout">

        <main class="main-content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <aside class="side-menu" aria-label="Menú lateral">
            <h2>Accesos rápidos</h2>

            <a href="{{ route('activities.index') }}">Ver actividades</a>
            <a href="{{ route('installations.index') }}">Instalaciones</a>
            <a href="{{ route('contact') }}">Contacto</a>

            @auth
                <a href="{{ route('bookings.index') }}">Mis reservas</a>
                <a href="{{ route('dashboard') }}">Área privada</a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.index') }}">Administración</a>
                @endif
            @endauth
        </aside>

    </div>

    <footer class="site-footer">
        <div class="footer-container">

            <div class="footer-columns">

                <section class="footer-block">
                    <h2 class="footer-title">G5 Sport</h2>
                    <p class="footer-text">
                        Tu centro deportivo de confianza. Instalaciones modernas y actividades para todos los niveles.
                    </p>
                </section>

                <section class="footer-block">
                    <h2 class="footer-title">Enlaces rápidos</h2>

                    <nav class="footer-links" aria-label="Enlaces del pie de página">
                        <a href="{{ route('activities.index') }}">Actividades</a>
                        <a href="{{ route('installations.index') }}">Instalaciones</a>
                        <a href="{{ route('contact') }}">Contacto</a>
                        <a href="{{ asset('como_se_hizo.pdf') }}" target="_blank" rel="noopener noreferrer">
                            Informe de la práctica
                        </a>
                    </nav>
                </section>

                <section class="footer-block">
                    <h2 class="footer-title">Contacto</h2>

                    <div class="footer-contact">
                        <p>
                            <span aria-hidden="true">📍</span>
                            <span>Av. Deportiva 123, Madrid</span>
                        </p>

                        <p>
                            <span aria-hidden="true">📞</span>
                            <span>+34 91 234 56 78</span>
                        </p>

                        <p>
                            <span aria-hidden="true">✉️</span>
                            <span>info@g5sport.com</span>
                        </p>
                    </div>
                </section>

            </div>

            <div class="footer-separator"></div>

            <p class="footer-copy">
                © 2026 G5 Sport. Todos los derechos reservados.
            </p>

        </div>
    </footer>

</body>
</html>