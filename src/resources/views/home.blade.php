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

<section class="home-section activities-section">
    <h2>Actividades destacadas</h2>

    <div class="cards-grid">

        <article class="activity-card">
            <img 
                src="https://images.unsplash.com/photo-1552196563-55cd4e45efb3?auto=format&fit=crop&w=900&q=80" 
                alt="Clase de yoga matinal"
            >

            <div class="card-content">
                <h3>Yoga Matinal</h3>
                <p>Empieza el día con energía.</p>
                <p><strong>Horario:</strong> 07:00 - 08:00</p>
                <p><strong>Plazas:</strong> 12/15</p>

                <a href="{{ route('activities.index') }}" class="btn-card">
                    Ver detalle
                </a>
            </div>
        </article>

        <article class="activity-card">
            <img 
                src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?auto=format&fit=crop&w=900&q=80" 
                alt="Entrenamiento de CrossFit"
            >

            <div class="card-content">
                <h3>CrossFit Intenso</h3>
                <p>Entrenamiento de alta intensidad.</p>
                <p><strong>Horario:</strong> 18:00 - 19:00</p>
                <p><strong>Plazas:</strong> 18/20</p>

                <a href="{{ route('activities.index') }}" class="btn-card">
                    Ver detalle
                </a>
            </div>
        </article>

        <article class="activity-card">
            <img 
                src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=900&q=80" 
                alt="Clase de natación para adultos"
            >

            <div class="card-content">
                <h3>Natación Adultos</h3>
                <p>Clases para nivel intermedio.</p>
                <p><strong>Horario:</strong> 19:00 - 20:00</p>
                <p><strong>Plazas:</strong> 8/12</p>

                <a href="{{ route('activities.index') }}" class="btn-card">
                    Ver detalle
                </a>
            </div>
        </article>

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

@endsection