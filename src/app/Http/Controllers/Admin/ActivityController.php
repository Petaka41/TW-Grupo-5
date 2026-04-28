<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = Activity::query()->orderBy('name')->paginate(15);

        return view('admin.activities.index', compact('activities'));
    }

    public function create(): View
    {
        return view('admin.activities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_capacity' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        Activity::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'max_capacity' => $validated['max_capacity'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.activities.index')
            ->with('status', 'Actividad creada.');
    }

    public function edit(Activity $activity): View
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'max_capacity' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            if ($activity->image_path) {
                Storage::disk('public')->delete($activity->image_path);
            }
            $activity->image_path = $request->file('image')->store('activities', 'public');
        }

        $activity->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'max_capacity' => $validated['max_capacity'],
            'image_path' => $activity->image_path,
        ]);

        return redirect()->route('admin.activities.index')
            ->with('status', 'Actividad actualizada.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        if ($activity->image_path) {
            Storage::disk('public')->delete($activity->image_path);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('status', 'Actividad eliminada.');
    }
}
