<nav x-data="{ open: false }"
     class="fixed inset-y-0 left-0 z-50 w-64
            bg-white dark:bg-[#0a0a0a]
            border-r border-slate-100 dark:border-zinc-800
            shadow-[20px_0_40px_-20px_rgba(0,0,0,0.05)]
            transition-transform duration-300 ease-out"
     :class="{
        'translate-x-0': open,
        '-translate-x-full': !open,
        'md:translate-x-0': true
     }">

    <div class="flex flex-col h-full">

        <div class="px-6 py-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 rotate-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xl font-black text-slate-800 dark:text-white tracking-tighter italic">
                        bitesafari
                    </p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-500">
                        {{ auth()->user()->role }} Panel
                    </p>
                </div>
            </div>
        </div>

        <div class="px-4 mb-6">
            <div class="bg-slate-50 dark:bg-zinc-900/50 rounded-2xl p-4 border border-slate-100 dark:border-zinc-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-slate-800 dark:text-zinc-200 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 px-4 overflow-y-auto space-y-1 custom-scrollbar">

            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Main Menu</p>

            @if(auth()->user()->role === 'admin')
                @include('layouts.admin-sidebar')
            @elseif(auth('vendor')->user())
                @include('layouts.vendor-sidebar')
            @else
                <a href="{{ route('user.dashboard') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                          {{ request()->routeIs('user.dashboard')
                            ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30 font-bold'
                            : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-zinc-800 hover:text-emerald-500' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="text-sm">Dashboard</span>
                </a>
                {{-- Add more user links here --}}
            @endif
        </div>

        <div class="p-4 border-t border-slate-100 dark:border-zinc-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="group w-full flex items-center gap-3 px-4 py-3 rounded-xl
                               text-sm font-bold text-slate-500 hover:text-red-500
                               hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-11V7a3 3 0 01-6 0v1" />
                    </svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="fixed bottom-6 right-6 md:hidden z-50">
    <button @click="open = !open"
            class="w-14 h-14 rounded-2xl bg-emerald-500 text-white shadow-2xl shadow-emerald-500/40 flex items-center justify-center active:scale-90 transition-all">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
        <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
</div>

<div x-show="open"
     x-transition:enter="transition opacity-0 ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition opacity-100 ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="open = false"
     class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm md:hidden z-40">
</div>
