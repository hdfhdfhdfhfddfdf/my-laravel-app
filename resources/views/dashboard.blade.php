<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $event->description }}</p>

                        <div class="text-sm text-gray-500 mb-4">
                            <p>📅 Date: {{ $event->event_date }}</p>
                            <p>💰 Price: ${{ $event->price }}</p>
                            <p>🎟️ Tickets Left: <strong>{{ $event->available_tickets }}</strong> / {{ $event->total_tickets }}</p>
                        </div>

                        @if($event->available_tickets > 0)
                            <form action="{{ route('events.book', $event->id) }}" method="POST">
                                @csrf
                                <div class="flex items-center gap-2">
                                    <input type="number" name="quantity" value="1" min="1" max="5" class="w-16 border-gray-300 rounded-md shadow-sm">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded">
                                        Buy Ticket
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed">
                                Sold Out
                            </button>
                        @endif
                    </div>
                @endforeach

            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    @forelse($events as $event)
        <div class="border p-4 rounded shadow">
            <h3 class="font-bold text-lg">{{ $event->title }}</h3>
            <p>{{ $event->description }}</p>
            <p class="text-blue-600 font-bold">${{ $event->price }}</p>
        </div>
    @empty
        <div class="p-4 text-center text-gray-500">
            <p>No events found. Please login as Admin to add one!</p>
        </div>
    @endforelse

</div>
        </div>
    </div>
</x-app-layout>