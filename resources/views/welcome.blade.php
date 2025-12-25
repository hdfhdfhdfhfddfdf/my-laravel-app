<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IIUM Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="bg-blue-900 text-white p-2 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <div>
                            <span class="font-bold text-xl text-blue-900 block leading-tight">IIUM Events</span>
                            <span class="text-xs text-gray-500">Ticketing System</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-gray-900 font-medium">Home</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">Events</a>
                    @auth
                        <a href="{{ route('my-bookings') }}" class="text-gray-500 hover:text-gray-900">My Tickets</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 font-medium ml-4">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-gray-900 border border-gray-300 px-4 py-2 rounded-full font-medium hover:bg-gray-50">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Showing {{ $events->count() }} events</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
            <div class="bg-white rounded-3xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
                <div class="h-48 bg-gray-200 relative">
                    <img src="https://placehold.co/600x400/1e3a8a/FFF?text={{ urlencode($event->title) }}" alt="Event" class="w-full h-full object-cover">
                    <span class="absolute top-4 right-4 bg-amber-200 text-amber-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                        {{ $event->category }}
                    </span>
                </div>
                
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2">{{ $event->title }}</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-5 h-5 mr-3 text-blue-200 fill-current" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                            {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }} • {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-5 h-5 mr-3 text-blue-200 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            {{ $event->venue }}
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-5 h-5 mr-3 text-blue-200 fill-current" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
                            {{ $event->available_tickets }} tickets available
                        </div>
                    </div>

                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-2xl font-bold text-blue-900">
                            {{ $event->price == 0 ? 'Free' : 'RM ' . $event->price }}
                        </span>
                        <a href="{{ route('events.show', $event->id) }}" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold py-2 px-6 rounded-full transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-10 text-gray-500">
                No events found. Login as admin to create one.
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>