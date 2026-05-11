@extends('layouts.public')

@section('title', 'Inicio — '.config('app.name'))

@section('content')

<!-- HERO -->
<section class="relative h-[500px] flex items-center justify-center bg-cover bg-center"
    style="background-image: url('https://images.unsplash.com/photo-1558611848-73f7eb4001a1');">

    <div class="bg-black/60 p-10 rounded-xl text-center text-white max-w-3xl">
        <h1 class="text-4xl font-bold mb-4">
            Reserva tus actividades deportivas fácilmente
        </h1>

        <p class="mb-6 text-lg">
            Accede a las mejores instalaciones y actividades en un solo lugar
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('activities.index') }}"
               class="bg-orange-500 px-6 py-3 rounded-lg font-semibold hover:bg-orange-600">
                Ver actividades
            </a>

            <a href="{{ route('register') }}"
               class="bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Registrarse
            </a>
        </div>
    </div>
</section>

<!-- ACTIVIDADES DESTACADAS -->
<section class="py-16 px-8 bg-gray-50">
    <h2 class="text-3xl font-bold text-center mb-10">
        Actividades destacadas
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1552196563-55cd4e45efb3" class="w-full h-40 object-cover">
            <div class="p-5">
                <h3 class="font-bold text-lg mb-2">Yoga Matinal</h3>
                <p class="text-gray-600 text-sm mb-3">Empieza el día con energía</p>
                <p class="text-sm"><b>Horario:</b> 07:00 - 08:00</p>
                <p class="text-sm mb-3"><b>Plazas:</b> 12/15</p>

                <a href="#" class="block text-center bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">
                    Ver detalle
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61" class="w-full h-40 object-cover">
            <div class="p-5">
                <h3 class="font-bold text-lg mb-2">CrossFit Intenso</h3>
                <p class="text-gray-600 text-sm mb-3">Entrenamiento de alta intensidad</p>
                <p class="text-sm"><b>Horario:</b> 18:00 - 19:00</p>
                <p class="text-sm mb-3"><b>Plazas:</b> 18/20</p>

                <a href="#" class="block text-center bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">
                    Ver detalle
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773" class="w-full h-40 object-cover">
            <div class="p-5">
                <h3 class="font-bold text-lg mb-2">Natación Adultos</h3>
                <p class="text-gray-600 text-sm mb-3">Clases para nivel intermedio</p>
                <p class="text-sm"><b>Horario:</b> 19:00 - 20:00</p>
                <p class="text-sm mb-3"><b>Plazas:</b> 8/12</p>

                <a href="#" class="block text-center bg-orange-500 text-white py-2 rounded-md hover:bg-orange-600">
                    Ver detalle
                </a>
            </div>
        </div>

    </div>
</section>

<!-- BENEFICIOS -->
<section class="py-16 px-8">
    <h2 class="text-3xl font-bold text-center mb-10">
        ¿Por qué elegirnos?
    </h2>

    <div class="grid md:grid-cols-3 gap-8 text-center">

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="text-orange-500 text-3xl mb-3">⏱</div>
            <h3 class="font-bold mb-2">Reserva Online</h3>
            <p class="text-gray-600">Reserva tus clases en cualquier momento</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="text-orange-500 text-3xl mb-3">👥</div>
            <h3 class="font-bold mb-2">Control de horarios</h3>
            <p class="text-gray-600">Gestiona tus actividades fácilmente</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="text-orange-500 text-3xl mb-3">🏅</div>
            <h3 class="font-bold mb-2">Instalaciones modernas</h3>
            <p class="text-gray-600">Equipamiento de última generación</p>
        </div>

    </div>
</section>

@endsection
