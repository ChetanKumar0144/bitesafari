<x-guest-layout>
    {{-- Fixed layout to ensure compact look --}}
    <div class="fixed inset-0 bg-[#fcfcfd] dark:bg-[#050505] flex items-center justify-center p-6 overflow-hidden">

        {{-- Subtle Blue Glow for Security Vibe --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>

        <div class="max-w-md w-full text-center space-y-6 relative z-10">

            {{-- Lock Icon Container --}}
            <div class="relative inline-block group">
                <div class="absolute -inset-4 bg-blue-500/20 rounded-full blur-2xl animate-pulse opacity-60"></div>
                <div class="relative w-28 h-28 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-zinc-800 flex items-center justify-center mx-auto transition-transform duration-500 group-hover:scale-105">
                    <svg class="w-14 h-14 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>

            {{-- Message Section --}}
            <div class="space-y-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter italic leading-none">Identify Yourself!</h2>
                <div class="flex items-center justify-center gap-2">
                    <span class="w-6 h-[2px] bg-blue-100 dark:bg-blue-900/30 rounded-full"></span>
                    <p class="text-blue-500/60 text-[9px] font-black uppercase tracking-[0.3em] italic">Authentication Required</p>
                    <span class="w-6 h-[2px] bg-blue-100 dark:bg-blue-900/30 rounded-full"></span>
                </div>
                <p class="text-slate-500 text-[11px] font-bold italic leading-relaxed max-w-[280px] mx-auto pt-1 opacity-80">
                    This trail is reserved for verified explorers. Please sign in to establish your safari credentials.
                </p>
            </div>

            {{-- Action Button --}}
            <div class="pt-4">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[10px] shadow-xl transition-all active:scale-95 gap-3 group">
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Establish Signal (Login)
                </a>
            </div>

            {{-- Footer --}}
            <div class="pt-6 border-t border-slate-50 dark:border-zinc-800/50">
                <p class="text-[7px] font-black text-slate-300 dark:text-zinc-600 uppercase tracking-[0.4em]">ByteSafari Identity Protocol v1.0</p>
            </div>
        </div>
    </div>
</x-guest-layout>
