<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmed - IIUM Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center py-12 px-4">

    <div class="bg-green-100 rounded-full p-6 mb-6">
        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
    </div>

    <h1 class="text-3xl font-bold text-green-600 mb-2">Ticket Booking Successful!</h1>
    <p class="text-gray-500 mb-10 text-center">Your booking has been confirmed. Check your email for details.</p>

    <div class="bg-white rounded-3xl shadow-lg w-full max-w-2xl overflow-hidden">
        
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Booking ID</p>
            <p class="text-xl font-bold text-blue-900">#BK{{ $booking->id }}</p>
        </div>

        <div class="p-8">
            <div class="mb-8">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Event Name</p>
                <h2 class="text-2xl font-bold text-gray-900">{{ $booking->event->title }}</h2>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Date & Time</p>
                    <div class="flex items-center text-gray-700 font-medium">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($booking->event->event_date)->format('M d, Y') }}<br>
                        {{ \Carbon\Carbon::parse($booking->event->event_time)->format('h:i A') }}
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Venue</p>
                    <div class="flex items-center text-gray-700 font-medium">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $booking->event->venue }}
                    </div>
                </div>
            </div>

            <hr class="border-dashed border-gray-200 my-8">

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Attendee Name</p>
                    <p class="font-bold">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Matric Number</p>
                    <p class="font-bold">{{ $booking->matric_number }}</p>
                </div>
            </div>

            <div class="flex justify-between items-end mb-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Tickets</p>
                    <p class="font-bold text-xl">{{ $booking->quantity }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Paid</p>
                    <p class="font-bold text-3xl text-blue-900">RM {{ number_format($booking->total_price, 2) }}</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6 text-center border border-gray-100">
                <p class="text-sm text-gray-500 mb-4">Your E-Ticket QR Code</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BOOKING-{{ $booking->id }}" alt="QR Code" class="mx-auto rounded-lg mix-blend-multiply">
                <p class="text-xs text-gray-400 mt-4">Present this QR code at the event entrance</p>
            </div>
        </div>
    </div>

    <div class="flex gap-4 mt-8 w-full max-w-2xl">
        <button class="flex-1 bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 rounded-xl shadow transition" onclick="window.print()">
            Download Ticket
        </button>
        <a href="/" class="flex-1 bg-white hover:bg-gray-50 text-gray-700 font-bold py-3 rounded-xl shadow border border-gray-200 text-center transition">
            Back to Events
        </a>
    </div>

</body>
</html>