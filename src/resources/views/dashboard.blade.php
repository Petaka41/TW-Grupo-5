@extends('layouts.public')

@section('title', 'Dashboard — ' . config('app.name'))

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-2">
                    <p class="text-sm uppercase tracking-wider text-gray-500">Área privada</p>
                    <h3 class="text-2xl font-semibold text-gray-900">Bienvenido, {{ auth()->user()->name }}</h3>
                    <p class="text-gray-600">
                        {{ auth()->user()->isAdmin() ? 'Tienes acceso al panel de administración.' : 'Desde aquí puedes ver tus reservas y gestionar tu perfil.' }}
                    </p>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Mi perfil</a>
                    <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm">Mis reservas</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-[#ff6b35] text-white rounded-md text-sm">Panel admin</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
