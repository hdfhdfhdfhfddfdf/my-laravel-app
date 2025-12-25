<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('welcome');
});

// Route to show the form
Route::get('/admin/create-event', [EventController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('events.create');

//route to ticket booking
Route::get('/my-bookings', [EventController::class, 'myBookings'])
    ->middleware(['auth', 'verified'])
    ->name('my-bookings');

// Route to save the data
Route::post('/admin/create-event', [EventController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('events.store');

    Route::post('/book/{id}', [EventController::class, 'book'])->name('events.book');



Route::get('/dashboard', [EventController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
