<x-app-layout>
    <style>
        /* Ensure the whole viewport (including the shell) uses the dotted blue theme */
        body, body > div.min-h-screen {
            background:
                radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.14) 1px, transparent 0),
                radial-gradient(circle at 15px 15px, rgba(255, 255, 255, 0.08) 1px, transparent 0),
                linear-gradient(180deg, #23428d 0%, #1f7fdc 100%);
            background-size: 32px 32px, 32px 32px, 100% 100%;
        }
        .booking-bg {
            background: transparent;
        }
    </style>

    <div class="booking-bg min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/10 border border-white/15 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-2xl text-white mb-10">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-white/70">Your Tickets</p>
                        <h1 class="text-3xl sm:text-4xl font-extrabold mt-2">My Bookings</h1>
                        <p class="text-white/80 mt-2">Keep track of every event you have booked with IIUM Events.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 bg-white/15 border border-white/25 px-4 py-3 rounded-2xl shadow-lg text-white">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        <span class="font-semibold text-lg">{{ $bookings->count() }} ticket{{ $bookings->count() === 1 ? '' : 's' }}</span>
                    </div>
                </div>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white/90 rounded-3xl shadow-xl p-10 text-center max-w-2xl mx-auto border border-white/40">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-800 flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No tickets yet</h3>
                    <p class="text-gray-600 mb-8">You have not booked any events yet. Browse events to get started.</p>
                    <a href="{{ route('eventlist') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-200">
                        <span>Browse Events</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($bookings as $booking)
                        <div class="bg-white/95 rounded-3xl shadow-xl border border-white/40 overflow-hidden flex flex-col md:flex-row hover:shadow-2xl transition duration-300">
                            <div class="md:w-52 bg-gradient-to-b from-[#2450b8] to-[#1d82e3] text-white p-6 relative flex flex-col justify-between">
                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.7) 1px, transparent 0); background-size: 18px 18px;"></div>
                                <div class="relative z-10">
                                    <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center mb-4 border border-white/20">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                    </div>
                                    <p class="text-sm uppercase tracking-[0.2em] text-white/80">Booking</p>
                                    <p class="text-xl font-bold">#BK{{ $booking->id }}</p>
                                </div>
                                <div class="relative z-10 mt-6 text-sm text-white/80">
                                    <p class="flex items-center gap-2">
                                        <span class="inline-block w-2 h-2 bg-white rounded-full"></span>
                                        {{ \Carbon\Carbon::parse($booking->event->event_date)->format('M d, Y') }}
                                    </p>
                                    <p class="flex items-center gap-2 mt-1">
                                        <span class="inline-block w-2 h-2 bg-white rounded-full"></span>
                                        {{ \Carbon\Carbon::parse($booking->event->event_time)->format('h:i A') }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 flex-1">
                                <div class="mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $booking->event->title }}</h3>
                                    <p class="text-gray-600">Tickets for your upcoming event.</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="flex items-start gap-3">
                                        <div class="bg-blue-50 p-3 rounded-2xl">
                                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs uppercase font-bold text-gray-500">Date & Time</p>
                                            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->event->event_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->event->event_time)->format('h:i A') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="bg-blue-50 p-3 rounded-2xl">
                                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs uppercase font-bold text-gray-500">Venue</p>
                                            <p class="font-semibold text-gray-900">{{ $booking->event->venue }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="bg-blue-50 p-3 rounded-2xl">
                                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs uppercase font-bold text-gray-500">Tickets</p>
                                            <p class="font-semibold text-gray-900">{{ $booking->quantity }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="bg-blue-50 p-3 rounded-2xl">
                                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-6.364l-1.414 1.414M8.05 15.95l-1.414 1.414m0-12.728l1.414 1.414m9.9 9.9l1.414 1.414"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs uppercase font-bold text-gray-500">Total Paid</p>
                                            <p class="font-semibold text-gray-900">RM {{ number_format($booking->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50/70 p-6 flex flex-col justify-center gap-3 md:w-64 border-t md:border-t-0 md:border-l border-blue-100">
                                <a href="{{ route('events.success', $booking->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-xl shadow-lg text-center transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download Ticket
                                </a>
                                <a href="{{ route('events.show', $booking->event->id) }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-3 px-4 rounded-xl border border-gray-200 text-center transition">
                                    View Event
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
