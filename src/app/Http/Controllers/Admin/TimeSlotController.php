<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TimeSlotController extends Controller
{
    public function index(Activity $activity): View
    {
        $timeSlots = $activity->timeSlots()->orderBy('start_time')->paginate(20);

        return view('admin.time-slots.index', compact('activity', 'timeSlots'));
    }

    public function create(Activity $activity): View
    {
        return view('admin.time-slots.create', compact('activity'));
    }

    public function store(Request $request, Activity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $start = Carbon::parse($validated['start_time']);
        $end = Carbon::parse($validated['end_time']);

        if (TimeSlot::overlapsForActivity($activity->id, $start, $end)) {
            throw ValidationException::withMessages([
                'start_time' => 'Este horario se solapa con otro turno de la misma actividad.',
            ]);
        }

        $activity->timeSlots()->create([
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return redirect()->route('admin.activities.time-slots.index', $activity)
            ->with('status', 'Turno creado.');
    }

    public function edit(Activity $activity, TimeSlot $timeSlot): View
    {
        return view('admin.time-slots.edit', compact('activity', 'timeSlot'));
    }

    public function update(Request $request, Activity $activity, TimeSlot $timeSlot): RedirectResponse
    {
        $validated = $request->validate([
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $start = Carbon::parse($validated['start_time']);
        $end = Carbon::parse($validated['end_time']);

        if (TimeSlot::overlapsForActivity($activity->id, $start, $end, $timeSlot->id)) {
            throw ValidationException::withMessages([
                'start_time' => 'Este horario se solapa con otro turno de la misma actividad.',
            ]);
        }

        $timeSlot->update([
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return redirect()->route('admin.activities.time-slots.index', $activity)
            ->with('status', 'Turno actualizado.');
    }

    public function destroy(Activity $activity, TimeSlot $timeSlot): RedirectResponse
    {
        $timeSlot->delete();

        return redirect()->route('admin.activities.time-slots.index', $activity)
            ->with('status', 'Turno eliminado.');
    }
}
