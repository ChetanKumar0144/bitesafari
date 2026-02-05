<x-app-layout>
    {{-- Sticky & Minimal Topbar Fix --}}
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 px-2 py-1">
            <div class="flex items-center gap-5">
                {{-- Branded Icon Container --}}
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative w-14 h-14 bg-white dark:bg-zinc-900 rounded-2xl flex items-center justify-center shadow-2xl border border-slate-100 dark:border-zinc-800 rotate-2 group-hover:rotate-0 transition-transform duration-500">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>

                <div class="space-y-0.5">
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Safari Tracks</h2>
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-emerald-500 rounded-full"></span>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] italic">Logistics Hub</p>
                    </div>
                </div>
            </div>

            {{-- Action Button with Glow --}}
            <div class="flex items-center">
                <a href="{{ route('admin.categories.create') }}"
                   class="group relative inline-flex items-center justify-center px-8 py-4 font-black text-white transition-all duration-200 bg-slate-900 rounded-3xl hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-xl active:scale-95">
                    <div class="absolute -inset-1 bg-gradient-to-r from-slate-400 to-slate-500 rounded-3xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    <svg class="w-4 h-4 mr-3 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="text-[10px] uppercase tracking-widest">New Track</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#fcfcfd] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Alert System --}}
            @if(session('success'))
                <div class="mb-8 p-5 bg-white dark:bg-zinc-900 border border-emerald-100 dark:border-emerald-900/30 rounded-[2rem] shadow-sm flex items-center gap-4 animate-in slide-in-from-top-4 duration-500">
                    <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">System Message</p>
                        <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 italic">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Table Container --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[3.5rem] border border-slate-100 dark:border-zinc-800/50 shadow-[0_20px_50px_rgba(0,0,0,0.02)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/30 text-[10px] font-black uppercase tracking-[0.25em] text-slate-400 border-b border-slate-50 dark:border-zinc-800">
                                <th class="px-12 py-8 italic">Identity Manifest</th>
                                <th class="px-12 py-8 text-center italic">Deployment</th>
                                <th class="px-12 py-8 text-center italic">Signal</th>
                                <th class="px-12 py-8 text-right italic">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @forelse($categories as $category)
                            <tr class="group hover:bg-slate-50/30 dark:hover:bg-zinc-800/20 transition-all duration-300">
                                <td class="px-12 py-10">
                                    <div class="flex items-center gap-6">
                                        <div class="w-14 h-14 bg-slate-50 dark:bg-zinc-800 rounded-[1.5rem] flex items-center justify-center text-slate-300 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner italic font-black text-xl">
                                            {{ substr($category->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="text-lg font-black text-slate-800 dark:text-zinc-100 italic tracking-tight group-hover:text-emerald-600 transition-colors">{{ $category->name }}</span>
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1 opacity-60">Path: /{{ $category->slug }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-12 py-10 text-center">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50/50 dark:bg-indigo-900/10 text-indigo-600 dark:text-indigo-400 rounded-2xl border border-indigo-100/50 dark:border-indigo-900/30">
                                        <span class="text-xs font-black italic">{{ $category->foods_count ?? $category->foods->count() }}</span>
                                        <span class="text-[9px] font-black uppercase tracking-tighter">Bites</span>
                                    </div>
                                </td>

                                <td class="px-12 py-10 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="flex items-center gap-2 px-3 py-1.5 {{ $category->status ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }} rounded-full border {{ $category->status ? 'border-emerald-100' : 'border-slate-100' }}">
                                            <span class="relative flex h-2 w-2">
                                                @if($category->status)
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                @endif
                                                <span class="relative inline-flex rounded-full h-2 w-2 {{ $category->status ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                            </span>
                                            <span class="text-[9px] font-black uppercase tracking-widest">{{ $category->status ? 'Online' : 'Stalled' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-12 py-10">
                                    <div class="flex justify-end items-center gap-4">
                                        {{-- Edit Command --}}
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="w-12 h-12 flex items-center justify-center bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-2xl hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2.5"/></svg>
                                        </a>

                                        {{-- Delete Command --}}
                                        <a href="{{ route('admin.categories.delete', $category->id) }}"
                                           onclick="return confirm('Terminate this track?')"
                                           class="w-12 h-12 flex items-center justify-center bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-2xl hover:bg-rose-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2.5"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-32 text-center italic text-slate-300 uppercase tracking-[0.4em] font-black text-xs">
                                    No tracks detected in radar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination Space --}}
            <div class="mt-8 px-10">
                {{-- Add $categories->links() here if using pagination --}}
            </div>
        </div>
    </div>
</x-app-layout>
