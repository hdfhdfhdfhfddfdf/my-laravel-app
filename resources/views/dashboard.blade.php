<x-app-layout>
    <x-slot name="header">
        <div class="bg-red-500 text-white p-2 text-center">
    DEBUG: My Role is [ {{ auth()->user()->role }} ]
</div>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
            <a href="{{ route('events.create') }}" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-lg shadow transition flex items-center gap-2">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
    Create New Event
</a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 flex flex-col h-full hover:shadow-md transition">
                        
                        <div class="h-40 bg-gray-200 relative">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://placehold.co/600x400/1e3a8a/FFF?text={{ urlencode($event->title) }}" class="w-full h-full object-cover">
                            @endif
                            
                            <span class="absolute top-2 right-2 bg-white/90 text-blue-900 text-xs font-bold px-2 py-1 rounded shadow">
                                {{ $event->category }}
                            </span>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                            
                            <div class="text-sm text-gray-500 space-y-1 mb-4">
                                <p>📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                                <p>📍 {{ $event->venue }}</p>
                                <p>🎟️ {{ $event->available_tickets }} left</p>
                            </div>

                            <div class="mt-auto flex justify-between items-center border-t pt-4 border-gray-100">
                                <span class="font-bold text-lg text-blue-900">
                                    RM {{ $event->price }}
                                </span>

                                <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 bg-white rounded-lg shadow-sm">
                        <p class="text-gray-500 text-lg">No events found.</p>
                        @if(auth()->user()->role === 'admin')
                            <p class="text-sm text-gray-400 mt-2">Click the button above to add one!</p>
                        @endif
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>