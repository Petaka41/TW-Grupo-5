<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredActivities = Activity::query()
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredActivities'));
    }
}
