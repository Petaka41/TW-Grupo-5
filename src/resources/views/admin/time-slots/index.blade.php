@extends('layouts.public')

@section('title', 'Horarios: ' . $activity->name . ' — Admin')

@section('content')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="space-y-2">
                        <p class="text-sm uppercase tracking-wider text-gray-500">Administración</p>
                        <h3 class="text-2xl font-semibold text-gray-900">Horarios: {{ $activity->name }}</h3>
                    </div>
                    <a href="{{ route('admin.activities.time-slots.create', $activity) }}" class="px-4 py-2 bg-[#ff6b35] text-white rounded-md text-sm">Nuevo turno</a>
                </div>
            </div>

            @if (session('status'))
                <div class="p-4 bg-green-50 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <a href="{{ route('admin.activities.index') }}" class="text-sm text-[#ff6b35] hover:underline">&larr; Volver a actividades</a>

            <div class="bg-white shadow sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">Inicio</th>
                            <th class="px-4 py-2">Fin</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeSlots as $slot)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $slot->start_time->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2">{{ $slot->end_time->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.activities.time-slots.edit', [$activity, $slot]) }}" class="text-[#ff6b35] hover:underline">Editar</a>
                                    <form method="post" action="{{ route('admin.activities.time-slots.destroy', [$activity, $slot]) }}" class="inline" onsubmit="return confirm('¿Eliminar turno?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $timeSlots->links() }}
        </div>
    </div>
@endsection
