@extends('layouts.public')

@section('title', 'Instalaciones — '.config('app.name'))

@section('content')

<section class="installations-page">

    <div class="installations-header">
        <h1>Nuestras Instalaciones</h1>

        <p>
            Disponemos de instalaciones modernas y equipadas para entrenar, reservar actividades y disfrutar del deporte en G5 Sport.
        </p>
    </div>

    <div class="installations-grid">


        <article class="installation-card">
            <img src="{{ asset('images/gimnasio.jpg') }}" alt="Gimnasio principal" class="installation-image">
            <div class="installation-card-content">
                <h2>Gimnasio principal</h2>
                <p class="installation-description">Fachada del gimnasio principal con acceso directo al área de entrenamiento.</p>
            </div>
        </article>

        <article class="installation-card">
            <img src="{{ asset('images/sala-fitness-1.jpg') }}" alt="Sala fitness 2" class="installation-image">
            <div class="installation-card-content">
                <h2>Sala Fitness 1</h2>
                <p class="installation-description">Espacio amplio para sesiones en grupo, estiramientos y acondicionamiento físico.</p>
            </div>
        </article>

        <article class="installation-card">
            <img src="{{ asset('images/sala-fitness-2.jpg') }}" alt="Sala fitness 1" class="installation-image">
            <div class="installation-card-content">
                <h2>Sala Fitness 2</h2>
                <p class="installation-description">Sala preparada para clases dirigidas, yoga, pilates y actividades colectivas.</p>
            </div>
        </article>



        <article class="installation-card">
            <img src="{{ asset('images/sala-cardio.jpg') }}" alt="Sala cardio" class="installation-image">
            <div class="installation-card-content">
                <h2>Sala Cardio</h2>
                <p class="installation-description">Zona equipada con máquinas cardiovasculares para mejorar la resistencia.</p>
            </div>
        </article>


        <article class="installation-card">
            <img src="{{ asset('images/piscina.jpg') }}" alt="Piscina" class="installation-image">
            <div class="installation-card-content">
                <h2>Piscina Olímpica</h2>
                <p class="installation-description">Piscina preparada para natación libre, entrenamientos acuáticos y actividades dirigidas.</p>
            </div>
        </article>



        <article class="installation-card">
            <img src="{{ asset('images/pista-padel.jpg') }}" alt="Pista de pádel" class="installation-image">
            <div class="installation-card-content">
                <h2>Pista de Pádel</h2>
                <p class="installation-description">Pista preparada para partidos, entrenamientos y actividades deportivas de pádel.</p>
            </div>
        </article>


        

    </div>

</section>

@endsection