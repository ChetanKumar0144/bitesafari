<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            {{-- Icon with rotate effect --}}
            <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 -rotate-3 group hover:rotate-0 transition-transform duration-500">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic uppercase">Forge New Track</h2>
                <p class="text-slate-500 text-sm font-medium italic">Adding a new territory to the food safari</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Manual Store Route --}}
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="bg-white dark:bg-zinc-900 rounded-[3rem] p-10 border border-slate-100 dark:border-zinc-800 shadow-sm space-y-8">

                    {{-- Category Name Input --}}
                    <div class="space-y-3">
                        <label for="name" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2 italic">Track Identity (Name)</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Continental, Desi Tadka"
                               class="w-full bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl py-5 px-8 text-sm font-bold text-slate-700 dark:text-zinc-200 focus:ring-2 focus:ring-indigo-500 transition-all shadow-inner"
                               required>
                        @error('name')
                            <p class="text-[10px] font-black uppercase text-rose-500 ml-2 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info Card --}}
                    <div class="p-6 bg-indigo-50 dark:bg-indigo-950/30 rounded-[2rem] border border-indigo-100 dark:border-indigo-900/30 flex items-start gap-4">
                        <svg class="w-5 h-5 text-indigo-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 leading-relaxed italic">
                            System will automatically generate a <span class="underline">URL Slug</span> for this track based on the identity you provide.
                        </p>
                    </div>

                    {{-- Command Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" class="flex-1 py-5 bg-slate-900 hover:bg-black text-white rounded-3xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                            Confirm Manifest
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="py-5 px-10 bg-white dark:bg-zinc-800 text-slate-400 hover:text-slate-600 rounded-3xl font-black uppercase tracking-[0.2em] text-[10px] border border-slate-100 dark:border-zinc-800 text-center transition-all">
                            Abort
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
