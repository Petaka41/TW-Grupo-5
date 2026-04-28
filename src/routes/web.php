<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/actividades', [CatalogController::class, 'index'])->name('activities.index');
Route::get('/actividades/{activity}', [CatalogController::class, 'show'])->name('activities.show');

Route::get('/contacto', ContactController::class)->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mis-reservas', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/reservas', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/reservas/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('activities', ActivityController::class)->except(['show']);
    Route::resource('activities.time-slots', TimeSlotController::class)
        ->except(['show'])
        ->scoped([
            'time_slot' => 'activity_id',
        ]);
});

require __DIR__.'/auth.php';
