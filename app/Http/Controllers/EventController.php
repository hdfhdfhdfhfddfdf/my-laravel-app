<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class EventController extends Controller
{
    // 1. Show the list of events on the Dashboard
public function index()
{
    // Get all events from the database
    $events = Event::all();

    // Send them to the dashboard view
    return view('dashboard', compact('events'));
}
    // 1. Show the form to create an event
    public function create()
    {
        // Security Check: If not admin, stop them!
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.create-event');
    }

    // 2. Store the event in the database
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Validate the inputs
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'price' => 'required|numeric',
            'total_tickets' => 'required|integer',
        ]);

        // Set available tickets same as total initially
        $data['available_tickets'] = $data['total_tickets'];

        // Save to DB
        Event::create($data);

        return redirect()->route('dashboard')->with('success', 'Event created successfully!');
    }
    public function book(Request $request, $id)
{
    $event = Event::findOrFail($id);
    $quantity = $request->input('quantity', 1);

    // Check if enough tickets are left
    if ($event->available_tickets < $quantity) {
        return back()->with('error', 'Not enough tickets available!');
    }

    // Deduct tickets
    $event->available_tickets -= $quantity;
    $event->save();

    // Create Booking Record
    Booking::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
        'quantity' => $quantity,
    ]);

    return back()->with('success', 'Ticket purchased successfully!');
}
}
