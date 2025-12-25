<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// modified/written by eimaan
Route::get('/', function () {
    // modified/written by eimaan
    return view('home');
})->name('home');
Route::get('/eventlist', [EventController::class, 'index'])->name('eventlist');
Route::get('/welcome', function () {
    return redirect()->route('eventlist');
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

    Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');

    // Show the checkout form
Route::get('/checkout/{id}', [EventController::class, 'checkout'])->name('events.checkout');

// Process the payment/booking
Route::post('/checkout/{id}', [EventController::class, 'processBooking'])->name('events.process');

// Show the success page
Route::get('/booking/success/{id}', [EventController::class, 'success'])->name('events.success');

Route::get('/dashboard', function () {
    return redirect()->route('eventlist');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
