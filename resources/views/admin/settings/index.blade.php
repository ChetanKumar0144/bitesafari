<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center shadow-lg rotate-3">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Command Prefs
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Calibrating BiteSafari core parameters</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] dark:bg-[#050505] min-h-[calc(100vh-10rem)]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Main Setup Card --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 shadow-xl overflow-hidden">

                <div class="grid lg:grid-cols-12">

                    {{-- Sidebar Placeholder --}}
                    <div class="lg:col-span-4 bg-slate-50 dark:bg-zinc-800/50 p-8 border-r border-slate-100 dark:border-zinc-800">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Configuration</h3>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 p-4 bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-emerald-500/20 text-emerald-600">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-xs font-black uppercase tracking-widest italic">General</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 text-slate-400 opacity-50">
                                <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                <span class="text-xs font-black uppercase tracking-widest italic">Gateway</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 text-slate-400 opacity-50">
                                <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                <span class="text-xs font-black uppercase tracking-widest italic">Dispatch</span>
                            </div>
                        </div>
                    </div>

                    {{-- Main Content Placeholder --}}
                    <div class="lg:col-span-8 p-10 lg:p-16 relative overflow-hidden flex flex-col items-center justify-center text-center">

                        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>

                        <div class="relative z-10 space-y-6">
                            <div class="w-20 h-20 mx-auto bg-slate-100 dark:bg-zinc-800 rounded-3xl flex items-center justify-center">
                                <svg class="w-10 h-10 text-slate-300 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="animation: spin 8s linear infinite;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a2 2 0 002 2h1a2 2 0 110 4h-1a2 2 0 00-2 2v1a2 2 0 11-4 0v-1a2 2 0 00-2-2H9a2 2 0 110-4h1a2 2 0 002-2V4z"></path>
                                </svg>
                            </div>

                            <div>
                                <h4 class="text-2xl font-black text-slate-800 dark:text-white italic tracking-tight">Under Calibration</h4>
                                <p class="text-slate-500 font-medium text-sm mt-3 max-w-sm mx-auto leading-relaxed">
                                    The core system preferences are currently being locked for the Phase-2 rollout. System integrity is our priority.
                                </p>
                            </div>

                            <div class="pt-6">
                                <div class="inline-flex items-center gap-3 px-6 py-2 bg-emerald-50 dark:bg-emerald-950/20 rounded-full border border-emerald-100 dark:border-emerald-900/50">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 italic">Auto-Optimization Live</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <p class="mt-8 text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                Bitesafari System Core V1.0.4 • Phase 2 Pending
            </p>
        </div>
    </div>
</x-app-layout>
