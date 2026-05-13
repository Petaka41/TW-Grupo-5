@extends('layouts.public')

@section('title', 'Instalaciones — '.config('app.name'))

@section('content')

<section class="installations-page">

    <div class="installations-header">
        <h1>Nuestras Instalaciones</h1>
        <p>
            Disponemos de instalaciones modernas y equipadas con la última tecnología para tu entrenamiento.
        </p>
    </div>

    <div class="installations-grid">

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Gimnasio Principal</h2>
            <p class="installation-type">Sala de musculación</p>

            <p class="installation-description">
                Amplio gimnasio equipado con máquinas de última generación y zona de pesas libres.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>50 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Piscina Olímpica</h2>
            <p class="installation-type">Piscina</p>

            <p class="installation-description">
                Piscina de 50 metros con sistema de climatización y carriles profesionales.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>30 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Sala Fitness 1</h2>
            <p class="installation-type">Sala polivalente</p>

            <p class="installation-description">
                Sala acondicionada para clases dirigidas de yoga, pilates y estiramientos.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>20 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Sala Fitness 2</h2>
            <p class="installation-type">Sala polivalente</p>

            <p class="installation-description">
                Sala equipada con espejos y suelo especial para clases de bajo impacto.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>20 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Sala Cardio</h2>
            <p class="installation-type">Sala cardiovascular</p>

            <p class="installation-description">
                Espacio dedicado a bicicletas estáticas, cintas y elípticas con pantallas individuales.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>30 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Ring de Boxeo</h2>
            <p class="installation-type">Zona de combate</p>

            <p class="installation-description">
                Área especializada con ring profesional, sacos y equipamiento de boxeo completo.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>20 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Pistas de Pádel</h2>
            <p class="installation-type">Pista exterior</p>

            <p class="installation-description">
                Dos pistas de pádel con iluminación nocturna y césped artificial de calidad.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>4 personas</strong>
            </p>
        </article>

        <article class="installation-card">
            <div class="installation-icon" aria-hidden="true">
                🏢
            </div>

            <h2>Cancha de Baloncesto</h2>
            <p class="installation-type">Cancha polideportiva</p>

            <p class="installation-description">
                Cancha cubierta multiusos para baloncesto, fútbol sala y voleibol.
            </p>

            <p class="installation-capacity">
                <span aria-hidden="true">👥</span>
                Capacidad: <strong>20 personas</strong>
            </p>
        </article>

    </div>

</section>

@endsection