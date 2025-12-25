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
    // This fetches the data!
    $events = Event::all(); 
    return view('eventlist', compact('events'));
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
    // 2. Store the event in the database
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Validate the NEW inputs
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',        // <--- New
            'venue' => 'required|string',      // <--- New
            'category' => 'required|string',   // <--- New
            'price' => 'required|numeric',
            'total_tickets' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // <--- New (Image upload)
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Save the file to "storage/app/public/events"
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        // Set available tickets
        $data['available_tickets'] = $data['total_tickets'];

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

    // 4. Show the user's purchased tickets
public function myBookings()
{
    // Get bookings for the currently logged-in user
    // and "load" the event details (so we can see the Event Title, not just the ID)
    $bookings = Booking::where('user_id', Auth::id())->with('event')->get();

    return view('my-bookings', compact('bookings'));
}

public function show($id)
{
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
}

// 1. Show the checkout form
public function checkout(Request $request, $id)
{
    $event = Event::findOrFail($id);
    $quantity = $request->query('quantity', 1); // Get quantity from previous page
    
    return view('events.checkout', compact('event', 'quantity'));
}

// 2. Process the Booking
public function processBooking(Request $request, $id)
{
    $event = Event::findOrFail($id);
    
    // Validate the new fields
    $request->validate([
        'name' => 'required|string',
        'matric_number' => 'required|string',
        'email' => 'required|email',
        'quantity' => 'required|integer|min:1'
    ]);

    $totalPrice = $event->price * $request->quantity;

    // Check availability
    if ($event->available_tickets < $request->quantity) {
        return back()->with('error', 'Sorry, tickets just sold out!');
    }

    // Deduct tickets
    $event->decrement('available_tickets', $request->quantity);

    // Create the Booking
    $booking = Booking::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
        'matric_number' => $request->matric_number,
        'quantity' => $request->quantity,
        'total_price' => $totalPrice
    ]);

    // Redirect to success page
    return redirect()->route('events.success', $booking->id);
}

// 3. Show Success Page
public function success($id)
{
    $booking = Booking::with('event')->findOrFail($id);
    
    // Security: Only allow the owner to see it
    if ($booking->user_id !== Auth::id()) {
        abort(403);
    }

    return view('events.success', compact('booking'));
}
}
