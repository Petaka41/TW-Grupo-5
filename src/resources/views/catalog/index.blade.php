@extends('layouts.public')

@section('title', 'Catálogo de actividades — '.config('app.name'))

@section('content')

<section class="catalog-page">

    <div class="catalog-header">
        <h1>Catálogo de Actividades</h1>
    </div>

    <div class="activities-grid">
        @forelse ($activities as $activity)

            <article class="catalog-card">

                @if ($activity->image_path)
                    <img
                        src="{{ asset($activity->image_path) }}"
                        alt="{{ $activity->name }}"
                        class="catalog-card-image"
                    >
                @else
                    <div class="catalog-card-image no-image">
                        Sin imagen
                    </div>
                @endif

                <div class="catalog-card-body">
                    <h2>{{ $activity->name }}</h2>

                    <p class="catalog-description">
                        {{ \Illuminate\Support\Str::limit($activity->description, 120) }}
                    </p>

                    <p>
                        <strong>Capacidad:</strong> {{ $activity->max_capacity }} plazas
                    </p>

                    <a href="{{ route('activities.show', $activity) }}" class="catalog-button">
                        Ver detalle y horarios
                    </a>
                </div>

            </article>

        @empty
            <div class="empty-catalog">
                <p>No hay actividades publicadas todavía.</p>
            </div>
        @endforelse
    </div>

    <div class="catalog-pagination">
        {{ $activities->links() }}
    </div>

</section>

@endsection