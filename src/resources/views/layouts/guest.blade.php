<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased auth-body">
        <div class="auth-page">
            <section class="auth-shell">
                <div class="auth-visual">
                    <a href="{{ route('home') }}" class="auth-brand">
                        <img src="{{ asset('images/logo-solo.png') }}" alt="Logo G5 Sport" class="auth-logo">                        <span>G5 Sport</span>
                    </a>

                    <div class="auth-copy">
                        <h1>Reserva, gestiona y administra desde una misma cuenta.</h1>
                        <p>Un único acceso para usuarios normales y administradores, con una interfaz más clara y coherente con el resto de la web.</p>
                    </div>

                
                </div>

                <div class="auth-card">
                    {{ $slot }}
                </div>
            </section>
            </div>
        </div>
    </body>
</html>
