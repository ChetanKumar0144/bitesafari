<x-guest-layout>
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Background Blobs (Optimized position) --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-[100px] -translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>

        {{-- Main Compact Container --}}
        <div class="max-w-md w-full text-center space-y-8 relative z-10">

            {{-- Icon Section --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-gradient-to-r from-emerald-400 to-indigo-500 rounded-full blur-2xl opacity-10"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto rotate-3 group-hover:rotate-0 transition-transform duration-700">
                    <svg class="w-14 h-14 text-slate-900 dark:text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Text Content --}}
            <div class="space-y-4">
                <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Safari Tune-up</h2>
                <div class="flex items-center justify-center gap-3">
                    <span class="w-8 h-[2px] bg-emerald-500 rounded-full"></span>
                    <p class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.4em] italic leading-none">Maintenance</p>
                    <span class="w-8 h-[2px] bg-emerald-500 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-xs font-bold italic leading-relaxed max-w-xs mx-auto opacity-80">
                    Reinforcing the tracks for a smoother experience. Back in a bite!
                </p>
            </div>

            {{-- Compact Progress --}}
            <div class="max-w-[180px] mx-auto space-y-3">
                <div class="h-1.5 w-full bg-slate-100 dark:bg-zinc-800 rounded-full overflow-hidden shadow-inner">
                    <div class="h-full bg-emerald-500 rounded-full w-2/3 animate-pulse"></div>
                </div>
                <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest italic">Signal Strength: 65%</p>
            </div>

            {{-- Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[9px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.3em]">Telemetry: @BiteSafari</p>
            </div>
        </div>
    </div>
</x-guest-layout>
