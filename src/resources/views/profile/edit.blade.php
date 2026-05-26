@extends('layouts.public')

@section('title', 'Mi Perfil — ' . config('app.name'))

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-2 mb-6">
                    <p class="text-sm uppercase tracking-wider text-gray-500">Mi cuenta</p>
                    <h3 class="text-2xl font-semibold text-gray-900">Perfil de {{ $user->name }}</h3>
                    <p class="text-gray-600">Gestiona tu información personal y preferencias de seguridad</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
