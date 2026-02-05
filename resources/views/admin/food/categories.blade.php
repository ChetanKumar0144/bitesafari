<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Bite Segments
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Organizing the safari flavor-wise</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#f8fafc] dark:bg-[#050505] min-h-[calc(100vh-10rem)] flex items-center justify-center">
        <div class="max-w-4xl w-full mx-auto px-4">

            <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 shadow-xl overflow-hidden relative">

                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full -mr-32 -mt-32"></div>

                <div class="p-10 lg:p-16 relative z-10 grid lg:grid-cols-2 gap-12 items-center">

                    {{-- Left Side: Illustration --}}
                    <div class="flex flex-col items-center justify-center text-center space-y-6">
                        <div class="w-24 h-24 bg-slate-50 dark:bg-zinc-800 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-indigo-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 dark:text-white">Phase 2: Taxonomy</h3>
                            <p class="text-slate-500 font-medium text-sm mt-2 leading-relaxed">
                                We are currently calibrating the classification engine to allow multi-level food categorization.
                            </p>
                        </div>
                    </div>

                    {{-- Right Side: Roadmap --}}
                    <div class="bg-slate-50 dark:bg-zinc-800/50 rounded-[2rem] p-8 space-y-6">
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Development Roadmap</h4>

                        <div class="space-y-4">
                            {{-- Step 1 --}}
                            <div class="flex items-center gap-4 group">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-slate-400 line-through decoration-2">Database Schema Design</span>
                            </div>

                            {{-- Step 2 --}}
                            <div class="flex items-center gap-4 group">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-indigo-200">
                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                </div>
                                <span class="text-sm font-bold text-slate-700 dark:text-zinc-200">Category CRUD Interface</span>
                            </div>

                            {{-- Step 3 --}}
                            <div class="flex items-center gap-4 group opacity-40">
                                <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-zinc-700 flex items-center justify-center text-slate-400 shrink-0">
                                    <span class="text-xs font-black">03</span>
                                </div>
                                <span class="text-sm font-bold text-slate-600 dark:text-zinc-400">Multi-level Nested Tags</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-200 dark:border-zinc-700">
                            <button disabled class="w-full py-4 bg-slate-200 dark:bg-zinc-700 text-slate-400 font-black rounded-2xl cursor-not-allowed uppercase tracking-widest text-[10px]">
                                Module Locked
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
