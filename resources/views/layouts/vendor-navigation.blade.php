@php
    // Direct Vendor Guard Access (No fallback to Admin)
    $vendor = auth('vendor')->user();

    // Vendor specific mapping (Amber Theme Only)
    $theme = [
        'bg' => 'bg-amber-500',
        'text' => 'text-amber-500',
        'profile' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-600',
        'border' => 'hover:border-amber-200'
    ];
@endphp

<nav x-data="{ open: false }"
     class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#0a0a0a] border-r border-slate-100 dark:border-zinc-800 shadow-xl transition-transform duration-300 ease-out"
     :class="{ 'translate-x-0': open, '-translate-x-full': !open, 'md:translate-x-0': true }">

    <div class="flex flex-col h-full overflow-hidden">

        {{-- Branding Area --}}
        <div class="px-7 py-10 shrink-0">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 {{ $theme['bg'] }} rounded-2xl flex items-center justify-center shadow-lg rotate-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter italic leading-none">BiteSafari</p>
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] {{ $theme['text'] }} mt-1 italic">
                        Merchant Portal
                    </p>
                </div>
            </div>
        </div>

        {{-- Strictly Vendor Links --}}
        <div class="flex-1 overflow-y-auto px-4 py-2 custom-scrollbar">
            {{-- Vendor specific file only --}}
            @include('layouts.vendor-sidebar')
        </div>

        {{-- Vendor Profile & Logout --}}
        <div class="p-6 border-t border-slate-50 dark:border-zinc-800/50 shrink-0 bg-white/50 dark:bg-[#0a0a0a]/50">

            <div class="flex items-center gap-3 p-3 mb-6 bg-slate-50 dark:bg-zinc-900/50 rounded-2xl border border-slate-100 dark:border-zinc-800/50 {{ $theme['border'] }} transition-all">
                <div class="w-10 h-10 rounded-xl {{ $theme['profile'] }} flex items-center justify-center font-black italic text-sm shrink-0">
                    {{ substr($vendor->name ?? 'V', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-[11px] font-black text-slate-800 dark:text-zinc-100 truncate italic leading-none uppercase tracking-tight">
                        {{ $vendor->name ?? 'merchant' }}
                    </p>
                    <p class="text-[8px] font-bold text-slate-400 truncate tracking-widest uppercase mt-1">ID: #{{ $vendor->id ?? '000' }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('vendor.logout') }}">
                @csrf
                <button type="submit"
                        class="group w-full flex items-center justify-center gap-3 px-4 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-rose-500 bg-rose-50/30 hover:bg-rose-500 hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-11V7a3 3 0 01-6 0v1" />
                    </svg>
                    <span>Terminate Session</span>
                </button>
            </form>
        </div>
    </div>
</nav>
