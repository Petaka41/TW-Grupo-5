<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Horarios: {{ $activity->name }}</h2>
            <a href="{{ route('admin.activities.time-slots.create', $activity) }}" class="text-sm px-3 py-1 bg-gray-800 text-white rounded-md">Nuevo turno</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-4 bg-green-50 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            <a href="{{ route('admin.activities.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Volver a actividades</a>
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
                                    <a href="{{ route('admin.activities.time-slots.edit', [$activity, $slot]) }}" class="text-indigo-600 hover:underline">Editar</a>
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
</x-app-layout>
