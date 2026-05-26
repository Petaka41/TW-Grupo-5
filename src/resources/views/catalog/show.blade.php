@extends('layouts.public')

@section('title', $activity->name.' — '.config('app.name'))

@section('content')

<section class="activity-detail-page">

    <a href="{{ route('activities.index') }}" class="back-link">
        ← Volver al catálogo
    </a>

    <article class="activity-detail-card">

        @if ($activity->image_path)
            <img
                src="{{ Storage::url($activity->image_path) }}"
                alt="Imagen de {{ $activity->name }}"
                class="activity-detail-image"
            >
        @else
            <div class="activity-detail-image activity-detail-placeholder">
                <div>
                    <span>G5 Sport</span>
                    <strong>{{ $activity->name }}</strong>
                </div>
            </div>
        @endif

        <div class="activity-detail-content">

            <div class="activity-title-block">
                <h1>{{ $activity->name }}</h1>

                <p>
                    {{ $activity->description ?: 'Actividad deportiva disponible en nuestro centro.' }}
                </p>
            </div>

            <div class="activity-info-grid activity-info-grid-simple">
                <div class="activity-info-item">
                    <div class="activity-info-icon">
                        <span>👥</span>
                    </div>

                    <div>
                        <span>Capacidad</span>
                        <strong>{{ $activity->max_capacity }} plazas</strong>
                    </div>
                </div>
            </div>

            <div class="activity-detail-separator"></div>

            <section class="slots-section">
                <div class="slots-header">
                    <div>
                        <h2>Horarios disponibles</h2>
                        <p>Consulta los próximos turnos disponibles para esta actividad.</p>
                    </div>
                </div>

                <div class="slots-list">
                    @forelse ($timeSlots as $slot)
                        @php
                            $booked = $slot->bookings_count;
                            $full = $booked >= $activity->max_capacity;
                            $available = max($activity->max_capacity - $booked, 0);
                        @endphp

                        <div class="slot-card">
                            <div class="slot-date-block">
                                <span class="slot-day">
                                    {{ $slot->start_time->translatedFormat('d M') }}
                                </span>

                                <span class="slot-weekday">
                                    {{ $slot->start_time->translatedFormat('l') }}
                                </span>
                            </div>

                            <div class="slot-main-info">
                                <strong>
                                    {{ $slot->start_time->format('H:i') }} - {{ $slot->end_time->format('H:i') }}
                                </strong>

                                <span>
                                    {{ $available }} de {{ $activity->max_capacity }} plazas disponibles
                                </span>
                            </div>

                            <div class="slot-action">
                                @auth
                                    @if (! $full)
                                        <form method="POST" action="{{ route('bookings.store') }}">
                                            @csrf

                                            <input type="hidden" name="time_slot_id" value="{{ $slot->id }}">

                                            <button type="submit" class="reserve-button">
                                                Reservar plaza
                                            </button>
                                        </form>
                                    @else
                                        <span class="full-badge">Completo</span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="reserve-button">
                                        Inicia sesión para reservar
                                    </a>
                                @endauth
                            </div>
                        </div>

                    @empty
                        <div class="empty-slots">
                            <h3>No hay horarios disponibles</h3>
                            <p>Actualmente esta actividad no tiene turnos programados.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>

    </article>

</section>

@endsection
