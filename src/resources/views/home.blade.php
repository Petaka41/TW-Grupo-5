@extends('layouts.public')

@section('title', 'Inicio — '.config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold mb-4">Bienvenido al centro deportivo</h1>
    <p class="mb-6 text-gray-600">Consulta el catálogo de actividades y reserva tu plaza (requiere cuenta).</p>
    <div class="flex gap-4">
        <a href="{{ route('activities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Ver catálogo</a>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Contacto</a>
    </div>
@endsection
