<x-app-layout>
    @php
        $totalEvents = $events->count();
        $totalTickets = $events->sum('available_tickets');
        $avgPrice = $events->count() ? number_format($events->avg('price'), 2) : '0.00';
    @endphp

    <style>
        .dashboard-shell {
            position: relative;
            min-height: 100vh;
            background:
                radial-gradient(circle at 1px 1px, rgba(255,255,255,0.14) 1px, transparent 0),
                radial-gradient(circle at 15px 15px, rgba(255,255,255,0.08) 1px, transparent 0),
                linear-gradient(180deg, #23428d 0%, #1f7fdc 100%);
            background-size: 32px 32px, 32px 32px, 100% 100%;
        }
        .glass-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 25px 80px rgba(7,14,35,0.35);
            backdrop-filter: blur(10px);
        }
        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1rem;
            border-radius: 9999px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.25);
            color: #fff;
            font-weight: 700;
        }
    </style>

    <div class="dashboard-shell">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="glass-card rounded-3xl p-6 sm:p-8 text-white mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-white/70">Welcome back</p>
                        <h1 class="text-3xl sm:text-4xl font-extrabold mt-2">Dashboard</h1>
                        <p class="text-white/80 mt-2">Manage your events and keep track of ticket inventory.</p>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('events.create') }}" class="inline-flex items-center gap-2 bg-white text-[#0a2ea8] font-bold px-5 py-3 rounded-full shadow-lg hover:-translate-y-0.5 hover:shadow-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Create New Event
                        </a>
                    @endif
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <span class="stat-pill">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        {{ $totalEvents }} event{{ $totalEvents === 1 ? '' : 's' }}
                    </span>
                    <span class="stat-pill">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.364-6.364l-1.414 1.414M8.05 15.95l-1.414 1.414m0-12.728l1.414 1.414m9.9 9.9l1.414 1.414"></path></svg>
                        Avg price RM {{ $avgPrice }}
                    </span>
                    <span class="stat-pill">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z"></path></svg>
                        {{ $totalTickets }} tickets available
                    </span>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 p-4 mb-6 rounded-xl shadow-sm">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-10">
                @forelse($events as $event)
                    <div class="bg-white/95 overflow-hidden shadow-xl rounded-3xl border border-white/60 hover:shadow-2xl transition flex flex-col h-full">
                        <div class="h-44 bg-gray-200 relative">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center text-white font-bold text-lg">
                                    {{ Str::limit($event->title, 20) }}
                                </div>
                            @endif
                            <span class="absolute top-3 right-3 bg-white/90 text-blue-900 text-xs font-bold px-3 py-1 rounded-full shadow">
                                {{ $event->category }}
                            </span>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                            
                            <div class="text-sm text-gray-600 space-y-2 mb-4">
                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                </p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->venue }}
                                </p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z"></path></svg>
                                    {{ $event->available_tickets }} tickets left
                                </p>
                            </div>

                            <div class="mt-auto flex justify-between items-center border-t pt-4 border-gray-100">
                                <span class="font-extrabold text-lg text-blue-900">
                                    RM {{ number_format($event->price, 2) }}
                                </span>

                                <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center gap-2 text-blue-700 hover:text-blue-900 font-semibold text-sm">
                                    View Details
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 bg-white/90 rounded-3xl shadow-xl border border-white/50">
                        <p class="text-gray-700 text-lg font-semibold">No events found.</p>
                        @if(auth()->user()->role === 'admin')
                            <p class="text-sm text-gray-500 mt-2">Click "Create New Event" to add one.</p>
                        @endif
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
