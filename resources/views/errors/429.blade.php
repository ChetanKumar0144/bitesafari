<x-guest-layout>
    {{-- Full-screen fixed layout --}}
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Soft Purple/Indigo Glow for 'Calm' Vibe --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>

        <div class="max-w-md w-full text-center space-y-6 relative z-10">

            {{-- Icon Section --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-indigo-500/20 rounded-full blur-2xl animate-pulse opacity-60"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto transition-transform duration-500">
                    {{-- Slowing Down/Clock Icon --}}
                    <svg class="w-14 h-14 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            {{-- Message Section --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Slow Your Pace!</h2>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-[2px] bg-indigo-100 dark:bg-indigo-900/30 rounded-full"></span>
                    <p class="text-indigo-500/60 text-[9px] font-black uppercase tracking-[0.3em] italic">Rate Limit Triggered</p>
                    <span class="w-6 h-[2px] bg-indigo-100 dark:bg-indigo-900/30 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-[11px] font-bold italic leading-relaxed max-w-[280px] mx-auto pt-1 opacity-80">
                    Explorer, you're moving too fast for the trail. Take a breath and let the signal stabilize before continuing.
                </p>
            </div>

            {{-- Action Button --}}
            <div class="pt-4">
                <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[10px] shadow-xl transition-all active:scale-95 gap-3 group">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Re-check Trail
                </button>
            </div>

            {{-- Protocol Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[7px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.4em]">ByteSafari Protocol: 429-TRAFFIC-HOLD</p>
            </div>
        </div>
    </div>
</x-guest-layout>
