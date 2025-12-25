<nav x-data="{ open: false }" class="bg-transparent sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="bg-white rounded-2xl shadow-md px-5 py-3 flex items-center justify-between border border-gray-100/70">
            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('eventlist') }}" class="flex items-center gap-2">
                        <div class="bg-[#2f4da5] text-white p-2 rounded-xl shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <div class="leading-tight">
                            <span class="font-bold text-lg text-blue-900 block">IIUM Events</span>
                        </div>
                    </a>
                </div>

                <div class="hidden sm:flex items-center gap-3">
                    @php
                        $pillBase = 'inline-flex items-center rounded-full px-5 py-2 text-sm font-bold shadow-sm transition hover:-translate-y-0.5 hover:shadow-md';
                    @endphp

                    <a href="{{ route('eventlist') }}" class="{{ $pillBase }} {{ request()->routeIs('eventlist') ? 'bg-[#eef2ff] text-[#0a2ea8] border border-[#7b8df5]' : 'bg-white text-[#0b2c8b] border border-[#d7deea]' }}">
                        {{ __('Dashboard') }}
                    </a>

                    <a href="{{ route('my-bookings') }}" class="{{ $pillBase }} {{ request()->routeIs('my-bookings') ? 'bg-[#eef2ff] text-[#0a2ea8] border border-[#7b8df5]' : 'bg-white text-[#0b2c8b] border border-[#d7deea]' }}">
                        {{ __('My Tickets') }}
                    </a>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('events.create') }}" class="{{ $pillBase }} {{ request()->routeIs('events.create') ? 'bg-[#e8f3ff] text-[#0c3b8f] border border-[#9cc3f5]' : 'bg-white text-[#0c3b8f] border border-[#9cc3f5]' }}">
                            {{ __('+ Create Event') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-[#d7deea] text-sm leading-4 font-semibold rounded-full text-slate-800 bg-white shadow-sm hover:-translate-y-0.5 hover:shadow-md transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 border-t border-gray-100 shadow-md">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('eventlist')" :active="request()->routeIs('eventlist')" class="text-[#0a2ea8] font-semibold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('my-bookings')" :active="request()->routeIs('my-bookings')" class="text-[#0a2ea8] font-semibold">
                {{ __('My Tickets') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')" class="text-[#0c3b8f] font-semibold">
                    {{ __('+ Create Event') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
