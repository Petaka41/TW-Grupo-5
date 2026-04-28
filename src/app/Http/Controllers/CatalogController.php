<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $activities = Activity::query()
            ->orderBy('name')
            ->paginate(12);

        return view('catalog.index', compact('activities'));
    }

    public function show(Activity $activity): View
    {
        $timeSlots = $activity->timeSlots()
            ->withCount('bookings')
            ->where('end_time', '>', now())
            ->orderBy('start_time')
            ->get();

        return view('catalog.show', compact('activity', 'timeSlots'));
    }
}
