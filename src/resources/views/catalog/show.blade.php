@extends('layouts.public')

@section('title', $activity->name.' — '.config('app.name'))

@section('content')
    <a href="{{ route('activities.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Volver al catálogo</a>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="md:flex gap-6">
            @if ($activity->image_path)
                <img src="{{ Storage::url($activity->image_path) }}" alt="" class="w-full md:w-64 h-48 object-cover rounded-md">
            @endif
            <div>
                <h1 class="text-2xl font-bold">{{ $activity->name }}</h1>
                <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $activity->description }}</p>
                <p class="mt-2 text-sm text-gray-600">Plazas por turno: {{ $activity->max_capacity }}</p>
            </div>
        </div>
    </div>

    <h2 class="text-xl font-semibold mt-8 mb-4">Próximos turnos</h2>
    <ul class="space-y-3">
        @forelse ($timeSlots as $slot)
            @php
                $booked = $slot->bookings_count;
                $full = $booked >= $activity->max_capacity;
            @endphp
            <li class="bg-white rounded shadow px-4 py-3 flex flex-wrap items-center justify-between gap-2">
                <div>
                    <span class="font-medium">{{ $slot->start_time->translatedFormat('d/m/Y H:i') }}</span>
                    —
                    <span>{{ $slot->end_time->format('H:i') }}</span>
                    <span class="text-sm text-gray-600 ml-2">({{ $booked }}/{{ $activity->max_capacity }} ocupadas)</span>
                </div>
                @auth
                    @if (! $full)
                        <form method="post" action="{{ route('bookings.store') }}" class="inline">
                            @csrf
                            <input type="hidden" name="time_slot_id" value="{{ $slot->id }}">
                            <button type="submit" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">Reservar</button>
                        </form>
                    @else
                        <span class="text-sm text-red-600">Completo</span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">Inicia sesión para reservar</a>
                @endauth
            </li>
        @empty
            <li class="text-gray-600">No hay turnos programados.</li>
        @endforelse
    </ul>
@endsection
