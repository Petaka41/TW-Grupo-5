@extends('layouts.public')

@section('title', 'Catálogo — '.config('app.name'))

@section('content')
    <h1 class="text-2xl font-bold mb-6">Catálogo de actividades</h1>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($activities as $activity)
            <article class="bg-white rounded-lg shadow overflow-hidden">
                @if ($activity->image_path)
                    <img src="{{ Storage::url($activity->image_path) }}" alt="" class="h-40 w-full object-cover">
                @else
                    <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">Sin imagen</div>
                @endif
                <div class="p-4">
                    <h2 class="font-semibold text-lg">{{ $activity->name }}</h2>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $activity->description }}</p>
                    <p class="text-sm mt-2">Capacidad: {{ $activity->max_capacity }}</p>
                    <a href="{{ route('activities.show', $activity) }}" class="mt-3 inline-block text-indigo-600 hover:underline text-sm">Ver detalle y horarios</a>
                </div>
            </article>
        @empty
            <p>No hay actividades publicadas todavía.</p>
        @endforelse
    </div>
    <div class="mt-8">{{ $activities->links() }}</div>
@endsection
