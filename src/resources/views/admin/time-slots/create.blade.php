@extends('layouts.public')

@section('title', 'Nuevo turno — ' . $activity->name . ' — Admin')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="space-y-2">
                    <p class="text-sm uppercase tracking-wider text-gray-500">Administración</p>
                    <h3 class="text-2xl font-semibold text-gray-900">Nuevo turno — {{ $activity->name }}</h3>
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('admin.activities.time-slots.store', $activity) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Inicio</label>
                        <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fin</label>
                        <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-[#ff6b35] text-white rounded-md text-sm">Guardar</button>
                        <a href="{{ route('admin.activities.time-slots.index', $activity) }}" class="px-4 py-2 border rounded-md text-sm">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
