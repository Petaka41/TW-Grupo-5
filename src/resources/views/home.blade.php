@extends('layouts.public')

@section('title', 'Inicio — '.config('app.name'))

@section('content')

<section class="hero home-hero">
    <div class="hero-card">
        <h1>Reserva tus actividades deportivas fácilmente</h1>

        <p>
            Accede a las mejores instalaciones y actividades en un solo lugar.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('activities.index') }}" class="btn-primary">
                Ver actividades
            </a>

            <a href="{{ route('register') }}" class="btn-secondary">
                Registrarse
            </a>
        </div>
    </div>
</section>


<section class="home-section benefits-section">
    <h2>¿Por qué elegirnos?</h2>

    <div class="cards-grid benefits-grid">

        <article class="benefit-card">
            <div class="benefit-icon" aria-hidden="true">⏱</div>
            <h3>Reserva Online</h3>
            <p>Reserva tus clases en cualquier momento.</p>
        </article>

        <article class="benefit-card">
            <div class="benefit-icon" aria-hidden="true">👥</div>
            <h3>Control de horarios</h3>
            <p>Gestiona tus actividades fácilmente.</p>
        </article>

        <article class="benefit-card">
            <div class="benefit-icon" aria-hidden="true">🏅</div>
            <h3>Instalaciones modernas</h3>
            <p>Equipamiento de última generación.</p>
        </article>

    </div>
</section>

<section class="home-section activities-section">
    <h2>Actividades destacadas</h2>

    <div class="cards-grid">

        @forelse ($featuredActivities as $activity)
            <article class="activity-card">

                @if ($activity->image_path)
                    <img
                        src="{{ Storage::url($activity->image_path) }}"
                        alt="Imagen de {{ $activity->name }}"
                    >
                @else
                    <div class="activity-card-placeholder">
                        Sin imagen
                    </div>
                @endif

                <div class="card-content">
                    <h3>{{ $activity->name }}</h3>

                    <p>
                        {{ \Illuminate\Support\Str::limit($activity->description, 80) }}
                    </p>

                    @if (!empty($activity->instructor))
                        <p>
                            <strong>Instructor:</strong> {{ $activity->instructor }}
                        </p>
                    @endif

                    <p>
                        <strong>Capacidad:</strong> {{ $activity->max_capacity }} plazas
                    </p>

                    <a href="{{ route('activities.show', $activity) }}" class="btn-card">
                        Ver detalle
                    </a>
                </div>

            </article>
        @empty
            <div class="empty-catalog">
                <p>No hay actividades publicadas todavía.</p>
            </div>
        @endforelse

    </div>
</section>

@endsection