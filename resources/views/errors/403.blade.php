<x-guest-layout>
    {{-- Fixed layout to ensure it never stretches or scrolls --}}
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Subtle Amber Background Glow --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-slate-500/5 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-md w-full text-center space-y-6 relative z-10">

            {{-- Warning Icon Container --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-amber-500/20 rounded-full blur-2xl animate-pulse opacity-60"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto group-hover:scale-105 transition-transform duration-500">
                    <span class="text-4xl font-black italic text-amber-500">403</span>
                </div>
            </div>

            {{-- Message Section --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Restricted Nest!</h2>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-[2px] bg-amber-200 dark:bg-amber-900/30 rounded-full"></span>
                    <p class="text-amber-500/60 text-[9px] font-black uppercase tracking-[0.3em] italic">Access Denied</p>
                    <span class="w-6 h-[2px] bg-amber-200 dark:bg-amber-900/30 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-[11px] font-bold italic leading-relaxed max-w-[280px] mx-auto pt-1 opacity-80">
                    Halt, Explorer! You don't have the clearance to enter this territory. Please turn back to safe grounds.
                </p>
            </div>

            {{-- Action Button --}}
            <div class="pt-4">
                <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[9px] shadow-xl shadow-amber-200 dark:shadow-none transition-all active:scale-95 gap-3 group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retreat to Safety
                </a>
            </div>

            {{-- Minimal Status Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[7px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.4em]">Protocol: NO-CLEARANCE-LEVEL-3</p>
            </div>
        </div>
    </div>
</x-guest-layout>
