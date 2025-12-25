<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900">My Tickets</h1>
                <p class="text-gray-500 mt-2">View and manage your upcoming event bookings</p>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm p-12 text-center max-w-lg mx-auto border border-gray-100">
                    <div class="bg-blue-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No tickets yet</h3>
                    <p class="text-gray-500 mb-8">You haven't booked any events yet.</p>
                    <a href="/" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200">
                        Browse Events
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($bookings as $booking)
                        <div class="bg-white rounded-[20px] shadow-sm hover:shadow-md transition duration-300 border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                            
                            <div class="bg-blue-900 p-6 flex flex-col justify-center items-center text-white md:w-48 shrink-0 relative">
                                <div class="absolute -top-4 -left-4 w-12 h-12 bg-blue-800 rounded-full opacity-50"></div>
                                <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-blue-800 rounded-full opacity-50"></div>
                                
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                <span class="font-bold tracking-widest text-sm">TICKET</span>
                            </div>

                            <div class="p-6 flex-1">
                                <div class="mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $booking->event->title }}</h3>
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-100 uppercase">
                                        BOOKING ID: #BK{{ $booking->id }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-start">
                                        <div class="bg-blue-50 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase font-bold">Date & Time</p>
                                            <p class="font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($booking->event->event_date)->format('M d, Y') }} • {{ \Carbon\Carbon::parse($booking->event->event_time)->format('h:i A') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="bg-blue-50 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 uppercase font-bold">Venue</p>
                                            <p class="font-semibold text-gray-900">{{ $booking->event->venue }}</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold">Tickets</p>
                                        <p class="text-xl font-bold">{{ $booking->quantity }}</p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold">Total Paid</p>
                                        <p class="text-xl font-bold text-blue-900">RM {{ number_format($booking->total_price, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-6 flex flex-col justify-center gap-3 border-l border-gray-100 md:w-64">
                                <a href="{{ route('events.success', $booking->id) }}" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-xl shadow text-center transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download
                                </a>
                                <a href="{{ route('events.show', $booking->event->id) }}" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-3 px-4 rounded-xl border border-gray-200 text-center transition">
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