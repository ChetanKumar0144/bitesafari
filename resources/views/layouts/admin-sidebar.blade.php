@php
    // Admin Theme (Emerald)
    $activeCls = 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold border-r-4 border-emerald-500';
    $inactiveCls = 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800/50 hover:text-emerald-500';

    function activeSafari($route, $activeCls, $inactiveCls) {
        return request()->routeIs($route) ? $activeCls : $inactiveCls;
    }

    function subActiveSafari($route) {
        return request()->routeIs($route)
            ? 'text-emerald-600 dark:text-emerald-400 font-bold'
            : 'text-slate-500 dark:text-slate-500 hover:text-emerald-500';
    }
@endphp

<div class="px-2 py-4 space-y-1 text-sm">

    <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 italic">Reports</p>

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
       class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('admin.dashboard', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="font-bold tracking-tight">Overview</span>
    </a>

    <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-6 mb-2 italic">Management</p>

    {{-- Food Menu Dropdown --}}
    <div x-data="{ open: {{ request()->routeIs(['food.*', 'admin.categories.*']) ? 'true' : 'false' }} }" class="space-y-1">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 group
            {{ request()->routeIs(['food.*', 'admin.categories.*'])
                ? 'bg-slate-900 text-white shadow-lg'
                : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-zinc-800/50' }}">

            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="font-bold tracking-tight">Food Menu</span>
            </div>

            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div x-show="open" x-collapse x-cloak class="mt-2 ml-6 border-l-2 border-slate-100 dark:border-zinc-800 space-y-1">
            <a href="{{ route('food.index') }}" class="block px-6 py-2 text-[11px] font-bold uppercase tracking-wider {{ request()->routeIs('food.index') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-900' }}">All Dishes</a>
            <a href="{{ route('food.create') }}" class="block px-6 py-2 text-[11px] font-bold uppercase tracking-wider {{ request()->routeIs('food.create') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-900' }}">Add New</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-6 py-2 text-[11px] font-bold uppercase tracking-wider {{ request()->routeIs('admin.categories.*') ? 'text-emerald-600' : 'text-slate-400 hover:text-slate-900' }}">Categories</a>
        </div>
    </div>

    {{-- Orders Dropdown --}}
    <div x-data="{ open: {{ request()->routeIs('orders.*', 'admin.orders.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('orders.*', 'admin.orders.*') ? 'bg-emerald-50/50 text-emerald-600 dark:bg-emerald-900/10' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50' }}">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="font-bold tracking-tight">Orders</span>
            </div>
            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2.5"/></svg>
        </button>

        <div x-show="open" x-collapse class="mt-1 ml-9 border-l-2 border-slate-100 dark:border-zinc-800 space-y-1">
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-[11px] font-bold uppercase tracking-wider {{ subActiveSafari('admin.orders.index') }}">Live Monitor</a>
            <a href="{{ route('orders.pending') }}" class="block px-4 py-2 text-[11px] font-bold uppercase tracking-wider {{ subActiveSafari('orders.pending') }}">Pending</a>
        </div>
    </div>

    {{-- Vendors --}}
    <a href="{{ route('admin.vendors.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('admin.vendors.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <span class="font-bold tracking-tight">Vendors</span>
    </a>

    {{-- Users --}}
    <a href="{{ route('users.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('users.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <span class="font-bold tracking-tight">Customers</span>
    </a>

    <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-6 mb-2 italic">Setup</p>

    {{-- Settings --}}
    <a href="{{ route('settings.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('settings.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span class="font-bold tracking-tight">Site Settings</span>
    </a>

</div>
