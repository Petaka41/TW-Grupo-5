<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar turno — {{ $activity->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                <form method="post" action="{{ route('admin.activities.time-slots.update', [$activity, $timeSlot]) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Inicio</label>
                        <input type="datetime-local" name="start_time" value="{{ old('start_time', $timeSlot->start_time->format('Y-m-d\TH:i')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fin</label>
                        <input type="datetime-local" name="end_time" value="{{ old('end_time', $timeSlot->end_time->format('Y-m-d\TH:i')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Actualizar</button>
                        <a href="{{ route('admin.activities.time-slots.index', $activity) }}" class="px-4 py-2 border rounded-md text-sm">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
