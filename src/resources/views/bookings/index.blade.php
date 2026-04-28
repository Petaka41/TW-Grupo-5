<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis reservas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="p-4 bg-green-50 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            @error('cancel')
                <div class="p-4 bg-red-50 text-red-800 rounded text-sm">{{ $message }}</div>
            @enderror
            <div class="bg-white shadow sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">Actividad</th>
                            <th class="px-4 py-2">Inicio</th>
                            <th class="px-4 py-2">Fin</th>
                            <th class="px-4 py-2">Reservado el</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $booking->timeSlot->activity->name }}</td>
                                <td class="px-4 py-2">{{ $booking->timeSlot->start_time->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $booking->timeSlot->end_time->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($booking->timeSlot->start_time->isFuture())
                                        <form method="post" action="{{ route('bookings.destroy', $booking) }}" class="inline" onsubmit="return confirm('¿Cancelar esta reserva?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Cancelar</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-gray-600">No tienes reservas todavía.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>
