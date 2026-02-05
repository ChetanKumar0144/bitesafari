<x-app-layout>
    {{-- Header Slot Fix: Removed extra padding and added relative positioning --}}
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 px-2">
            <div class="flex items-center gap-5">
                {{-- Edit Icon Container --}}
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-orange-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative w-14 h-14 bg-white dark:bg-zinc-900 rounded-2xl flex items-center justify-center shadow-xl border border-slate-100 dark:border-zinc-800 -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-0.5">
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Modify Track</h2>
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-amber-500 rounded-full"></span>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] italic">Active: {{ $category->name }}</p>
                    </div>
                </div>
            </div>

            {{-- Back Link --}}
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-slate-50 transition-all shadow-sm">
                ← Return to Tracks
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#fcfcfd] dark:bg-[#050505] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Form Container with responsive padding --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[3.5rem] border border-slate-100 dark:border-zinc-800/50 shadow-[0_20px_50px_rgba(0,0,0,0.02)] overflow-hidden">

                {{-- Breadcrumb/Status Strip --}}
                <div class="px-12 py-6 bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-50 dark:border-zinc-800 flex justify-between items-center">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Expedition Metadata</span>
                    <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-[8px] font-black uppercase tracking-widest">Editor Active</span>
                </div>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="p-12 space-y-10">
                    @csrf {{-- Manual Route POST Update --}}

                    <div class="grid grid-cols-1 gap-10">
                        {{-- Input Field --}}
                        <div class="space-y-4">
                            <label for="name" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 ml-4 italic">Identity Tag (Name)</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $category->name) }}" {{-- Pre-filled value --}}
                                   class="w-full bg-slate-50 dark:bg-zinc-800 border-none rounded-[2rem] py-6 px-10 text-lg font-bold text-slate-800 dark:text-zinc-100 focus:ring-4 focus:ring-amber-500/10 transition-all shadow-inner border-transparent"
                                   required>
                            @error('name')
                                <p class="text-[10px] font-black uppercase text-rose-500 ml-4 mt-2 tracking-widest">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category Insights --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-8 bg-slate-50/50 dark:bg-zinc-800/30 rounded-[2.5rem] border border-slate-100/50 dark:border-zinc-800 flex items-center gap-5">
                                <div class="w-12 h-12 bg-white dark:bg-zinc-800 rounded-2xl flex items-center justify-center text-slate-400 shadow-sm font-mono font-black italic">/</div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">URL Handle</p>
                                    <p class="text-xs font-bold text-slate-600 dark:text-zinc-400 italic tracking-tight">{{ $category->slug }}</p>
                                </div>
                            </div>

                            <div class="p-8 bg-slate-50/50 dark:bg-zinc-800/30 rounded-[2.5rem] border border-slate-100/50 dark:border-zinc-800 flex items-center gap-5">
                                <div class="w-12 h-12 bg-white dark:bg-zinc-800 rounded-2xl flex items-center justify-center text-indigo-500 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2"/></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Linked Ecosystem</p>
                                    <p class="text-xs font-bold text-slate-600 dark:text-zinc-400 italic tracking-tight">{{ $category->foods->count() }} Signal Items</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Commands --}}
                    <div class="pt-6 flex flex-col sm:flex-row gap-5">
                        <button type="submit" class="group relative flex-1 inline-flex items-center justify-center px-8 py-6 font-black text-white transition-all duration-300 bg-slate-900 rounded-[2rem] hover:bg-black shadow-2xl active:scale-[0.98]">
                            <span class="text-[11px] uppercase tracking-[0.2em] relative z-10">Commit Changes</span>
                            <svg class="w-5 h-5 ml-3 relative z-10 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
