@php
    $activeCls = 'bg-amber-500 text-white shadow-lg shadow-amber-500/30 font-bold';
    $inactiveCls = 'text-slate-600 dark:text-slate-400 hover:bg-amber-50 dark:hover:bg-amber-900/10 hover:text-amber-600 transition-all duration-300';

    function vendorLinkStyle($route, $active, $inactive) {
        return request()->routeIs($route) ? $active : $inactive;
    }

    function subLinkActive($route) {
        return request()->routeIs($route)
            ? 'text-amber-600 dark:text-amber-400 font-black scale-105'
            : 'text-slate-500 dark:text-slate-500 hover:text-amber-500 transition-colors';
    }
@endphp

<div class="px-4 py-6 space-y-8">

    {{-- KITCHEN CORE SECTION --}}
    <div class="space-y-2">
        <p class="px-4 text-[9px] font-black uppercase tracking-[0.3em] text-slate-400/80 italic mb-4">Command Center</p>

        {{-- Performance --}}
        <a href="{{ route('vendor.dashboard') }}"
           class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl {{ vendorLinkStyle('vendor.dashboard', $activeCls, $inactiveCls) }}">
            <svg class="w-5 h-5 shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            <span class="text-[11px] font-black uppercase tracking-wider">Performance</span>
        </a>

        {{-- Kitchen Menu --}}
        <div x-data="{ open: {{ request()->routeIs('vendor.foods.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('vendor.foods.*') ? 'bg-amber-50 dark:bg-amber-900/5 text-amber-600 border border-amber-100 dark:border-amber-900/20' : $inactiveCls }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-[11px] font-black uppercase tracking-wider">Kitchen Menu</span>
                </div>
                <svg class="w-3 h-3 transition-transform duration-300" :class="{ 'rotate-180 text-amber-500': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>

            <div x-show="open" x-collapse class="mt-2 ml-4 pl-6 border-l-2 border-slate-100 dark:border-zinc-800 space-y-4 py-2">
                <a href="{{ route('vendor.foods.index') }}" class="block text-[10px] font-black uppercase tracking-widest {{ subLinkActive('vendor.foods.index') }}">Live Dishes</a>
                <a href="{{ route('vendor.foods.create') }}" class="block text-[10px] font-black uppercase tracking-widest {{ subLinkActive('vendor.foods.create') }}">Add Recipe</a>
            </div>
        </div>

        {{-- Orders Dropdown (Simplified Text) --}}
        <div x-data="{ open: {{ request()->routeIs('vendor.orders.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full group flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('vendor.orders.*') ? 'bg-amber-50 dark:bg-amber-900/5 text-amber-600 border border-amber-100 dark:border-amber-900/20' : $inactiveCls }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="text-[11px] font-black uppercase tracking-wider">Orders</span>
                </div>
                {{-- Status Indicator --}}
                <div class="flex items-center gap-2">
                    <span class="flex h-2 w-2 rounded-full bg-rose-500 shadow-sm shadow-rose-500/50 animate-pulse"></span>
                    <svg class="w-3 h-3 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </button>

            <div x-show="open" x-collapse class="mt-2 ml-4 pl-6 border-l-2 border-slate-100 dark:border-zinc-800 space-y-4 py-2">
                <a href="{{ route('vendor.orders.index') }}" class="block text-[10px] font-black uppercase tracking-widest {{ subLinkActive('vendor.orders.index') }}">Order History</a>
                <a href="{{ route('vendor.orders.index', ['status' => 'pending']) }}"
                   class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest {{ request()->get('status') === 'pending' ? 'text-amber-600' : 'text-slate-500 hover:text-amber-500 transition-colors' }}">
                    <span>New Orders</span>
                    <span class="bg-rose-500 text-white px-1.5 py-0.5 rounded-md text-[8px] animate-bounce">LIVE</span>
                </a>
            </div>
        </div>
    </div>

    {{-- IDENTITY SECTION --}}
    <div class="space-y-2">
        <p class="px-4 text-[9px] font-black uppercase tracking-[0.3em] text-slate-400/80 italic mb-4">Account</p>

        <a href="{{ route('vendor.profile.edit') }}"
           class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl {{ vendorLinkStyle('vendor.profile.*', $activeCls, $inactiveCls) }}">
            <svg class="w-5 h-5 shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-[11px] font-black uppercase tracking-wider">Store Profile</span>
        </a>
    </div>

</div>
