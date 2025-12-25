<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IIUM Events | Event List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ii-blue-900:#09306b; --ii-blue-500:#0ea5e9; }
        body { font-family: 'Inter', sans-serif; }
        .bg-dotted {
            background:
                radial-gradient(circle at 1px 1px, rgba(255,255,255,0.12) 1px, transparent 0),
                radial-gradient(circle at 15px 15px, rgba(255,255,255,0.07) 1px, transparent 0),
                linear-gradient(180deg, #23428d 0%, #1f7fdc 100%);
            background-size: 32px 32px, 32px 32px, 100% 100%;
        }
        .pill { border-radius: 9999px; }
        .card-glass { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); backdrop-filter: blur(8px); }
        .stat-pill { display:inline-flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:9999px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.22); color:#fff; font-weight:700; }
    </style>
</head>
<body class="bg-dotted min-h-screen text-white">

    <header class="sticky top-0 z-50 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="bg-white rounded-2xl shadow-md px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl p-2 flex items-center justify-center" style="width:56px;height:56px;">
                        <svg class="w-10 h-10" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <rect x="4" y="4" width="56" height="56" rx="14" fill="#2f4da5" />
                            <rect x="4.8" y="4.8" width="54.4" height="54.4" rx="13.2" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="1.6" />
                            <g transform="translate(17.6 17.6) scale(1.2)">
                                <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="none" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-lg text-blue-900 block">IIUM Events</span>
                        <span class="text-xs text-gray-500">Ticketing System</span>
                    </div>
                </div>
                <nav class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 pill border border-[#d7deea] bg-white font-bold text-[#0b2c8b] shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">Home</a>
                    <a href="{{ route('eventlist') }}" class="inline-flex items-center px-4 py-2 pill border border-[#7b8df5] bg-[#eef2ff] font-bold text-[#0a2ea8] shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">Events</a>
                    @auth
                        <a href="{{ route('my-bookings') }}" class="inline-flex items-center px-4 py-2 pill border border-[#d7deea] bg-white font-bold text-[#0b2c8b] shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">My Tickets</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="inline-flex items-center px-4 py-2 pill border border-[#d7deea] bg-white font-bold text-red-500 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">Logout</button></form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-gray-900 border border-gray-300 px-4 py-2 pill font-medium hover:bg-gray-50">Login</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <section class="card-glass rounded-3xl p-8 shadow-2xl mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-white/70">Browse Events</p>
                    <h1 class="text-3xl sm:text-4xl font-extrabold mt-2">Event List</h1>
                    <p class="text-white/80 mt-2">Find and book events happening at IIUM.</p>
                </div>
                <div class="flex gap-3 flex-wrap">
                    <span class="stat-pill inline-flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full text-sm font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        {{ $events->count() }} events
                    </span>
                    <span class="stat-pill inline-flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full text-sm font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-6.364l-1.414 1.414M8.05 15.95l-1.414 1.414m0-12.728l1.414 1.414m9.9 9.9l1.414 1.414"></path></svg>
                        Fresh events weekly
                    </span>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-12">
            @forelse($events as $event)
                <div class="bg-white/95 rounded-3xl shadow-xl border border-white/60 overflow-hidden flex flex-col h-full hover:shadow-2xl transition">
                    <div class="h-48 bg-gray-200 relative">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#23428d] via-[#2f71d2] to-[#1f7fdc] flex items-center justify-center text-white font-bold text-lg text-center px-4">
                                {{ Str::limit($event->title, 24) }}
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 bg-white/90 text-blue-900 text-xs font-bold px-3 py-1 rounded-full shadow">{{ $event->category }}</span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $event->title }}</h3>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-5">
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $event->venue }}
                            </p>
                            <p class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z"></path></svg>
                                {{ $event->available_tickets }} tickets available
                            </p>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-extrabold text-blue-900">
                                {{ $event->price == 0 ? 'Free' : 'RM ' . number_format($event->price, 2) }}
                            </span>
                            <a href="{{ route('events.show', $event->id) }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-5 pill shadow-lg transition">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-white/90 rounded-3xl shadow-xl border border-white/50 text-gray-700">
                    No events found. @auth @if(auth()->user()->role === 'admin') <span class="text-sm text-gray-500">Create one from the dashboard.</span> @endif @endauth
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
