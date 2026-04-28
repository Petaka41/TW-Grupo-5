<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TimeSlot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $bookings = Booking::query()
            ->where('user_id', $request->user()->id)
            ->with(['timeSlot.activity'])
            ->latest()
            ->paginate(20);

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'time_slot_id' => ['required', 'integer', 'exists:time_slots,id'],
        ]);

        $userId = (int) $request->user()->id;
        $timeSlotId = (int) $validated['time_slot_id'];

        return DB::transaction(function () use ($userId, $timeSlotId): RedirectResponse {
            /** @var TimeSlot|null $slot */
            $slot = TimeSlot::query()->whereKey($timeSlotId)->lockForUpdate()->first();

            if (! $slot) {
                throw ValidationException::withMessages([
                    'time_slot_id' => 'El turno no existe.',
                ]);
            }

            if ($slot->end_time->isPast()) {
                throw ValidationException::withMessages([
                    'time_slot_id' => 'Este turno ya ha finalizado.',
                ]);
            }

            $slot->load('activity');
            $capacity = $slot->activity->max_capacity;

            $count = Booking::query()
                ->where('time_slot_id', $slot->id)
                ->lockForUpdate()
                ->count();

            if ($count >= $capacity) {
                throw ValidationException::withMessages([
                    'time_slot_id' => 'No quedan plazas en este turno.',
                ]);
            }

            if (Booking::query()
                ->where('user_id', $userId)
                ->where('time_slot_id', $slot->id)
                ->exists()) {
                throw ValidationException::withMessages([
                    'time_slot_id' => 'Ya tienes una reserva para este turno.',
                ]);
            }

            $hasOverlap = Booking::query()
                ->where('user_id', $userId)
                ->whereHas('timeSlot', function ($q) use ($slot) {
                    $q->whereRaw('time_slots.start_time < ? AND time_slots.end_time > ?', [
                        $slot->end_time,
                        $slot->start_time,
                    ]);
                })
                ->exists();

            if ($hasOverlap) {
                throw ValidationException::withMessages([
                    'time_slot_id' => 'Ya tienes otra reserva que se solapa con este horario.',
                ]);
            }

            Booking::create([
                'user_id' => $userId,
                'time_slot_id' => $slot->id,
            ]);

            return redirect()->route('bookings.index')
                ->with('status', 'Reserva confirmada.');
        });
    }

    public function destroy(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorize('delete', $booking);

        $booking->load('timeSlot');

        if ($booking->timeSlot->start_time->isPast()) {
            return back()->withErrors([
                'cancel' => 'No puedes cancelar un turno que ya ha comenzado.',
            ]);
        }

        $booking->delete();

        return back()->with('status', 'Reserva cancelada correctamente.');
    }
}
