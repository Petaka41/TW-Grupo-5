@extends('layouts.public')

@section('title', 'Catálogo de actividades — '.config('app.name'))

@section('content')

<section class="catalog-page">

    <div class="catalog-header">
        <h1>Catálogo de Actividades</h1>
    </div>

    <form method="GET" action="{{ route('activities.index') }}" class="catalog-filters">
        <div class="search-wrapper">
            <span class="search-icon" aria-hidden="true">🔍</span>
            <input
                type="search"
                name="search"
                placeholder="Buscar actividad..."
                value="{{ request('search') }}"
                aria-label="Buscar actividad"
            >
        </div>

        <select name="installation" aria-label="Filtrar por instalación">
            <option value="">Todas las instalaciones</option>
            <option value="sala-fitness">Sala Fitness</option>
            <option value="gimnasio-principal">Gimnasio Principal</option>
            <option value="piscina-olimpica">Piscina Olímpica</option>
        </select>

        <select name="day" aria-label="Filtrar por día">
            <option value="">Todos los días</option>
            <option value="lunes">Lunes</option>
            <option value="martes">Martes</option>
            <option value="miercoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
            <option value="sabado">Sábado</option>
            <option value="domingo">Domingo</option>
        </select>

        <button type="submit" class="filter-button">Filtrar</button>
    </form>

    <div class="activities-grid">
        @forelse ($activities as $activity)

            <article class="catalog-card">

                @if ($activity->image_path)
                    <img
                        src="{{ Storage::url($activity->image_path) }}"
                        alt="Imagen de {{ $activity->name }}"
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
                        {{ \Illuminate\Support\Str::limit($activity->description, 95) }}
                    </p>

                    @if (!empty($activity->instructor))
                        <p><strong>Instructor:</strong> {{ $activity->instructor }}</p>
                    @endif

                    <p><strong>Capacidad:</strong> {{ $activity->max_capacity }} plazas</p>

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