<x-guest-layout>
    {{-- Fixed positioning to override layout stretching --}}
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Subtle Background Glow --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>

        <div class="max-w-md w-full text-center space-y-6 relative z-10">
            {{-- Animated Error Icon - Scaled down slightly --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-emerald-500/20 rounded-full blur-2xl animate-pulse opacity-50"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto rotate-12 group-hover:rotate-0 transition-transform duration-500">
                    <span class="text-4xl font-black italic text-emerald-500">404</span>
                </div>
            </div>

            {{-- Compact Message Section --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Signal Lost!</h2>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-[2px] bg-slate-200 dark:bg-zinc-800 rounded-full"></span>
                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em] italic">Unknown Territory</p>
                    <span class="w-6 h-[2px] bg-slate-200 dark:bg-zinc-800 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-[11px] font-bold italic leading-relaxed max-w-[280px] mx-auto pt-1 opacity-80">
                    Explorer, you've wandered off the track. This trail hasn't been mapped yet.
                </p>
            </div>

            {{-- Action Button --}}
            <div class="pt-4">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 bg-slate-900 hover:bg-black text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[9px] shadow-xl transition-all active:scale-95 gap-3 group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Return to Base
                </a>
            </div>

            {{-- Minimal Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[7px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.4em]">BiteSafari Expedition Protocol</p>
            </div>
        </div>
    </div>
</x-guest-layout>
