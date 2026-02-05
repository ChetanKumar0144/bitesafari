@php
    // Helper to handle Active classes with Safari Emerald Theme
    $activeCls = 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold shadow-sm border-r-4 border-emerald-500';
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

    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Analytics</p>

    <a href="{{ route('admin.dashboard') }}"
       class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('admin.dashboard', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span>Dashboard</span>
    </a>

    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-6 mb-2">Inventory</p>

    <div x-data="{ open: {{ request()->routeIs(['food.*', 'admin.categories.*']) ? 'true' : 'false' }} }" class="space-y-1">
    {{-- Main Dropdown Button --}}
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-3.5 rounded-[1.25rem] transition-all duration-300 group
            {{ request()->routeIs(['food.*', 'admin.categories.*'])
                ? 'bg-slate-900 text-white shadow-xl shadow-slate-200 dark:shadow-none'
                : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-zinc-800/50 hover:text-slate-900' }}">

            <div class="flex items-center gap-3">
                <div class="relative">
                    {{-- Food Icon --}}
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:scale-110"
                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    {{-- Activity Dot --}}
                    @if(request()->routeIs(['food.*', 'admin.categories.*']))
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                    @endif
                </div>
                <span class="font-black uppercase tracking-widest text-[11px] italic">Kitchen Manifest</span>
            </div>

            {{-- Chevron with dynamic rotation --}}
            <svg class="w-3.5 h-3.5 transition-transform duration-500 transform"
                :class="{ 'rotate-180 text-emerald-400': open, 'text-slate-300': !open }"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        {{-- Collapsible Content --}}
        <div x-show="open"
            x-collapse
            x-cloak
            class="mt-2 ml-6 border-l-2 border-slate-100 dark:border-zinc-800 space-y-1">

            {{-- Catalogue Link --}}
            <a href="{{ route('food.index') }}"
            class="group flex items-center justify-between px-6 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all
            {{ request()->routeIs('food.index') ? 'text-emerald-600 italic' : 'text-slate-400 hover:text-slate-900 hover:translate-x-1' }}">
                <span>Catalogue</span>
                @if(request()->routeIs('food.index'))
                    <span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                @endif
            </a>

            {{-- Create Bite Link --}}
            <a href="{{ route('food.create') }}"
            class="group flex items-center justify-between px-6 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all
            {{ request()->routeIs('food.create') ? 'text-emerald-600 italic' : 'text-slate-400 hover:text-slate-900 hover:translate-x-1' }}">
                <span>Create Bite</span>
                <svg class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
            </a>

            {{-- Categories Link --}}
            <a href="{{ route('admin.categories.index') }}"
            class="group flex items-center justify-between px-6 py-2.5 text-[10px] font-black uppercase tracking-widest transition-all
            {{ request()->routeIs('admin.categories.*') ? 'text-emerald-600 italic' : 'text-slate-400 hover:text-slate-900 hover:translate-x-1' }}">
                <span>Categories</span>
                @if(request()->routeIs('admin.categories.*'))
                    <span class="w-1.5 h-1.5 border-2 border-emerald-500 rounded-full"></span>
                @endif
            </a>
        </div>
    </div>

    <div x-data="{ open: {{ request()->routeIs('orders.*') ? 'true' : 'false' }} }">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('orders.*') ? 'text-emerald-600 bg-emerald-50/50 dark:bg-emerald-900/10' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800/50' }}">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="font-semibold">Orders</span>
            </div>
            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2"/></svg>
        </button>

        <div x-show="open" x-collapse class="mt-1 ml-9 border-l-2 border-slate-100 dark:border-zinc-800 space-y-1">
            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 text-xs {{ subActiveSafari('admin.orders.index') }}">Live Track</a>
            <a href="{{ route('orders.pending') }}" class="block px-4 py-2 text-xs {{ subActiveSafari('orders.pending') }}">Pending Dispatch</a>
        </div>
    </div>

    <a href="{{ route('admin.vendors.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('admin.vendors.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <span>Partners/Vendors</span>
    </a>

    <a href="{{ route('users.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('users.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <span>Safari Explorers</span>
    </a>

    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-6 mb-2">System</p>

    <a href="{{ route('settings.index') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ activeSafari('settings.*', $activeCls, $inactiveCls) }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <span>Settings</span>
    </a>

</div>
