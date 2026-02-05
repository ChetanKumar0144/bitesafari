@php
    $isVendor = auth('vendor')->check();
    $user = $isVendor ? auth('vendor')->user() : auth()->user();

    // Parent Theme Classes
    $themeBase = $isVendor ? 'amber' : 'emerald';
    $panelTitle = $isVendor ? 'Merchant Panel' : 'Admin Panel';
@endphp

<nav x-data="{ open: false }"
     class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#0a0a0a] border-r border-slate-100 dark:border-zinc-800 shadow-[20px_0_40px_-20px_rgba(0,0,0,0.05)] transition-transform duration-300 ease-out"
     :class="{ 'translate-x-0': open, '-translate-x-full': !open, 'md:translate-x-0': true }">

    <div class="flex flex-col h-full overflow-hidden">

        <div class="px-6 py-8 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-{{ $themeBase }}-500 rounded-xl flex items-center justify-center shadow-lg rotate-3 transition-transform hover:rotate-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-black text-slate-800 dark:text-white tracking-tighter italic">bitesafari</p>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-{{ $themeBase }}-500">{{ $panelTitle }}</p>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar">
            @if($isVendor)
                @include('layouts.vendor-sidebar')
            @else
                @include('layouts.admin-sidebar')
            @endif
        </div>

        <div class="p-4 border-t border-slate-100 dark:border-zinc-800 shrink-0 bg-white dark:bg-[#0a0a0a]">
            <div class="flex items-center gap-3 p-3 mb-4 bg-slate-50 dark:bg-zinc-900/50 rounded-2xl border border-slate-100 dark:border-zinc-800">
                <div class="w-8 h-8 rounded-full bg-{{ $themeBase }}-100 dark:bg-{{ $themeBase }}-900/30 text-{{ $themeBase }}-600 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-black text-slate-800 dark:text-zinc-200 truncate">{{ $user->name }}</p>
                    <p class="text-[9px] font-bold text-slate-400 truncate tracking-tighter uppercase">{{ $user->email }}</p>
                </div>
            </div>

            <form method="POST" action="{{ $isVendor ? route('vendor.logout') : route('logout') }}">
                @csrf
                <button type="submit"
                        class="group w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-[0.1em] text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition-all">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-11V7a3 3 0 01-6 0v1" />
                    </svg>
                    <span>Exit Portal</span>
                </button>
            </form>
        </div>
    </div>
</nav>
