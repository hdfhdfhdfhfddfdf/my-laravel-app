<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - IIUM Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="max-w-3xl mx-auto px-4 py-12">
        <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-8 bg-white px-4 py-2 rounded-full shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Event
        </a>

        <h1 class="text-3xl font-bold text-center mb-10">Book Your Ticket</h1>

        <div class="bg-white rounded-3xl p-8 shadow-sm mb-6">
            <h2 class="text-xl font-bold mb-6">Event Summary</h2>
            <div class="border-b border-gray-100 pb-6 mb-6">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Event Name</p>
                <p class="text-lg font-bold">{{ $event->title }}</p>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Date & Time</p>
                    <div class="flex items-center text-gray-700 font-medium">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} • {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Venue</p>
                    <div class="flex items-center text-gray-700 font-medium">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->venue }}
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm">
            <h2 class="text-xl font-bold mb-6">Attendee Information</h2>
            
            <form action="{{ route('events.process', $event->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Matric Number *</label>
                    <input type="text" name="matric_number" placeholder="e.g. 2012345" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" required>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Number of Tickets *</label>
                    <input type="number" name="quantity" value="{{ $quantity }}" readonly class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed">
                </div>

                <div class="flex items-center justify-between mt-8 pt-8 border-t border-gray-100">
                    <div>
                        <p class="text-sm text-gray-500">Total Amount</p>
                        <p class="text-3xl font-bold text-blue-900">RM {{ number_format($event->price * $quantity, 2) }}</p>
                    </div>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 px-10 rounded-xl shadow-lg transition duration-200">
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>