<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actividades (administración)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-4 bg-green-50 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            <div class="flex justify-end">
                <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm">Nueva actividad</a>
            </div>
            <div class="bg-white shadow sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Capacidad</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $activity->name }}</td>
                                <td class="px-4 py-2">{{ $activity->max_capacity }}</td>
                                <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.activities.time-slots.index', $activity) }}" class="text-indigo-600 hover:underline">Horarios</a>
                                    <a href="{{ route('admin.activities.edit', $activity) }}" class="text-indigo-600 hover:underline">Editar</a>
                                    <form action="{{ route('admin.activities.destroy', $activity) }}" method="post" class="inline" onsubmit="return confirm('¿Eliminar actividad?');">
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
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>
