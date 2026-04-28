<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <header class="bg-white shadow">
        <nav class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap gap-4 items-center justify-between">
            <a href="{{ route('home') }}" class="font-semibold text-lg">Centro deportivo</a>
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="{{ route('home') }}" class="hover:text-gray-600">Inicio</a>
                <a href="{{ route('activities.index') }}" class="hover:text-gray-600">Catálogo</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-600">Contacto</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-600">Dashboard</a>
                    <a href="{{ route('bookings.index') }}" class="hover:text-gray-600">Mis reservas</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.activities.index') }}" class="hover:text-gray-600">Administración</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-600">Entrar</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-600">Registro</a>
                @endauth
            </div>
        </nav>
    </header>
    <main class="max-w-7xl mx-auto px-4 py-8">
        @if (session('status'))
            <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-4 text-red-800">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
