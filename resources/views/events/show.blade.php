<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event->title }} - IIUM Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center font-bold text-xl text-blue-900">IIUM Events</div>
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-gray-900 font-medium">Home</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="rounded-3xl overflow-hidden h-64 md:h-96 w-full relative mb-8">
            <img src="https://placehold.co/1200x500/1e3a8a/FFF?text={{ urlencode($event->title) }}" class="w-full h-full object-cover">
            <span class="absolute top-6 left-6 bg-amber-200 text-amber-900 px-4 py-1 rounded-full text-sm font-bold uppercase">
                {{ $event->category }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <h1 class="text-4xl font-bold text-gray-900">{{ $event->title }}</h1>
                
                <div class="flex flex-wrap gap-6 text-gray-600 bg-white p-4 rounded-xl border border-gray-100">
                    <div class="flex items-center">
                        <span class="bg-blue-100 p-2 rounded-lg mr-3">📅</span>
                        <div>
                            <p class="text-xs text-gray-400">Date</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-blue-100 p-2 rounded-lg mr-3">⏰</span>
                        <div>
                            <p class="text-xs text-gray-400">Time</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-blue-100 p-2 rounded-lg mr-3">📍</span>
                        <div>
                            <p class="text-xs text-gray-400">Venue</p>
                            <p class="font-semibold">{{ $event->venue }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold mb-4">About This Event</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $event->description }}</p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold mb-6">Organizer Information</h3>
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 rounded-full p-3">👤</div>
                        <div>
                            <p class="text-sm text-gray-400">Organizer</p>
                            <p class="font-bold text-gray-900">Dr. Ahmad Bin Abdullah</p>
                            <p class="text-gray-500 mt-1">ahmad@iium.edu.my</p>
                            <p class="text-gray-500">+60 3-6196 4000</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-lg p-8 sticky top-24 border border-gray-100">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-3xl font-bold text-blue-900">RM {{ $event->price }}</span>
                            <span class="text-gray-500 text-sm">/ per ticket</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center text-gray-500 text-sm mb-8">
                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                        {{ $event->available_tickets }} tickets available
                    </div>

                    <form action="{{ route('events.checkout', $event->id) }}" method="GET">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Number of Tickets</label>
                            <div class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200">
                                <input type="number" name="quantity" value="1" min="1" max="5" class="w-full bg-transparent border-none text-center font-bold text-lg focus:ring-0">
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">RM {{ $event->price }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xl font-bold text-blue-900">
                                <span>Total</span>
                                <span>RM {{ $event->price }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 rounded-xl shadow-lg transition duration-200">
                            Book Ticket
                        </button>
                    </form>
                    
                    <p class="text-center text-xs text-gray-400 mt-4">Secure booking powered by IIUM</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>