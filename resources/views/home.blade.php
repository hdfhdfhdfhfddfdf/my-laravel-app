<!-- modified/written by eimaan -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>IIUM Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* modified/written by eimaan */
        :root { --ii-blue-900:#09306b; --ii-blue-500:#0ea5e9; --dot: rgba(255,255,255,0.04);} 
        html, body { height: 100%; overflow: hidden; }
        body { font-family: 'Inter', sans-serif; display: flex; flex-direction: column; }

        /* dotted background */
        .bg-dotted {
            background-color: #23428d;
            background-image:
                radial-gradient(circle at 1px 1px, rgba(255,255,255,0.14) 1px, transparent 0),
                radial-gradient(circle at 15px 15px, rgba(255,255,255,0.08) 1px, transparent 0);
            background-size: 32px 32px;
        }

        /* hero card */
        .hero-card{border-radius:36px;padding:3.5rem;background:linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.03));backdrop-filter: blur(6px);box-shadow: 0 30px 80px rgba(3,9,29,0.55);border:1px solid rgba(255,255,255,0.06);} 
        .badge-pill{display:inline-flex;align-items:center;gap:.6rem;padding:.5rem 1.2rem;border-radius:9999px;background:rgba(255,255,255,0.08);color:#fff;font-weight:600;animation: floaty 3s ease-in-out infinite;}
        .btn-primary{background:#fff;color:var(--ii-blue-900);padding:.84rem 1.8rem;border-radius:9999px;font-weight:700;box-shadow:0 10px 40px rgba(2,6,23,0.28);display:inline-flex;align-items:center;gap:.6rem}
        .btn-outline{background:transparent;border:1px solid rgba(255,255,255,0.25);color:#fff;padding:.72rem 1.6rem;border-radius:9999px;font-weight:600;backdrop-filter: blur(4px);}
        .nav-pill{border:1.25px solid #c3d0e8;border-radius:9999px;padding:.5rem 1.1rem;display:inline-flex;align-items:center;font-weight:700;color:#0f172a;box-shadow:0 6px 18px rgba(12,22,47,0.06);background:rgba(255,255,255,0.7);transition:transform 180ms ease, box-shadow 180ms ease, background-color 180ms ease;}
        .nav-pill:hover{background:#f1f5fb;box-shadow:0 10px 24px rgba(12,22,47,0.12);transform:translateY(-1px);}
        @keyframes floaty {0% {transform: translateY(0);} 50% {transform: translateY(-12px);} 100% {transform: translateY(0);} }
        /* large blurred decoration behind the hero */
        .hero-deco{position:absolute;left:50%;transform:translateX(-50%);top:6.25rem;width:calc(100% - 4rem);max-width:1250px;height:300px;border-radius:56px;background:linear-gradient(110deg, rgba(255,255,255,0.03), rgba(255,255,255,0.015));filter:blur(26px);opacity:.12;pointer-events:none}

        /* subtle rounded outline behind card */
        .hero-outline{position:absolute;left:50%;transform:translateX(-50%);top:7rem;width:calc(100% - 6rem);max-width:1200px;height:260px;border-radius:48px;box-shadow:0 10px 0 rgba(255,255,255,0.02) inset;pointer-events:none;opacity:.06} 

        @media (min-width:1024px){ .hero-card{padding:4.5rem}} 
    </style>
</head>
<body class="bg-dotted min-h-screen text-white">

    <!-- modified/written by eimaan -->
    <header class="sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="bg-white rounded-2xl shadow-md px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl p-2 flex items-center justify-center" style="width:64px;height:64px;">
                        <!-- brand ticket icon updated to requested path -->
                        <svg class="w-11 h-11" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img">
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
                    <a href="{{ route('home') }}" class="nav-pill text-blue-700">Home</a>
                    <a href="{{ route('welcome') }}" class="nav-pill text-gray-700">Events</a>
                    @auth
                        <a href="{{ route('my-bookings') }}" class="nav-pill text-gray-700">My Tickets</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="nav-pill text-red-500 font-semibold">Logout</button></form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-gray-900 border border-gray-300 px-4 py-2 rounded-full font-medium hover:bg-gray-50">Login</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pb-10">
        <div class="relative w-full">
            <div class="hero-deco" aria-hidden="true"></div>
            <div class="hero-outline" aria-hidden="true"></div>
            <section class="max-w-7xl mx-auto py-16 sm:py-18 md:py-20 flex items-center justify-center">
                <div class="mx-auto max-w-5xl">
                    <div class="flex justify-center mb-6">
                        <div class="badge-pill">
                            <!-- icon updated to star/sparkle badge -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 32 32" fill="none" aria-hidden="true" role="img">
                                <path d="M8 16.5c4.5-.7 7.8-4 8.5-8.5.7 4.5 4 7.8 8.5 8.5-4.5.7-7.8 4-8.5 8.5-.7-4.5-4-7.8-8.5-8.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="22.5" cy="10.5" r="1.2" fill="currentColor"/>
                                <circle cx="10.5" cy="22.5" r="1" fill="currentColor" opacity=".9"/>
                                <circle cx="12.6" cy="23.4" r="0.8" fill="currentColor" opacity=".8"/>
                            </svg>
                            <span class="text-sm">Welcome to IIUM Event Ticket Place</span>
                        </div>
                    </div>

                    <div class="hero-card text-center">
                        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">IIUM Event Ticketing System</h1>
                        <p class="text-center text-white/90 mt-6 text-lg md:text-xl">Discover and book tickets for exciting events happening at International Islamic University Malaysia</p>

                        <div class="mt-12 flex justify-center gap-6">
                            <a href="{{ route('welcome') }}" class="btn-primary">Browse Events</a>
                            <a href="{{ route('login') }}" class="btn-outline">Login</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

</body>
</html>
