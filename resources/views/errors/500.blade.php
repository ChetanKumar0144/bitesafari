<x-guest-layout>
    {{-- Fixed viewport to lock height and prevent stretching --}}
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Subtle Red Background Glow --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-rose-500/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-slate-500/5 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2"></div>

        <div class="max-w-md w-full text-center space-y-6 relative z-10">

            {{-- Error Icon Container --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-rose-500/20 rounded-full blur-2xl animate-pulse opacity-60"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto -rotate-6 group-hover:rotate-0 transition-transform duration-500">
                    <span class="text-4xl font-black italic text-rose-500">500</span>
                </div>
            </div>

            {{-- Message Section --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Engine Stall!</h2>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-[2px] bg-rose-100 dark:bg-rose-900/30 rounded-full"></span>
                    <p class="text-rose-500/60 text-[9px] font-black uppercase tracking-[0.3em] italic">Critical System Failure</p>
                    <span class="w-6 h-[2px] bg-rose-100 dark:bg-rose-900/30 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-[11px] font-bold italic leading-relaxed max-w-[280px] mx-auto pt-1 opacity-80">
                    Our safari jeep hit a major bump. Mechanics are on it, but the trail is temporarily blocked.
                </p>
            </div>

            {{-- Action Button --}}
            <div class="pt-4">
                <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-10 py-4 bg-rose-500 hover:bg-rose-600 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[9px] shadow-xl shadow-rose-200 dark:shadow-none transition-all active:scale-95 gap-3 group">
                    <svg class="w-4 h-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retry Signal
                </button>
            </div>

            {{-- Minimal Status Code Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[7px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.4em]">Error Protocol: ByteSafari-STALL-500</p>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 3s linear infinite;
    }
</style>
