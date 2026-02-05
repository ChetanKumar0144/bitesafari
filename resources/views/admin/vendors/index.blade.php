<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Partner Network
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Manage BiteSafari restaurant partners</p>
            </div>

            <a href="{{ route('admin.vendors.create') }}"
               class="px-6 py-3 bg-emerald-500 text-white rounded-2xl hover:bg-emerald-600 transition-all font-bold shadow-lg shadow-emerald-200 dark:shadow-none flex items-center gap-2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Recruit Vendor</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm animate-in fade-in slide-in-from-left-4">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- SEARCH & FILTER BAR --}}
            <div class="bg-white dark:bg-zinc-900 p-4 rounded-[1.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
                <form method="GET" action="{{ route('admin.vendors.index') }}" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[280px] relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search partners by name, email..."
                               class="w-full pl-10 bg-slate-50 dark:bg-zinc-800 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold transition-all">
                    </div>

                    <select name="status" class="bg-slate-50 dark:bg-zinc-800 border-none rounded-xl text-sm font-black uppercase tracking-tighter text-slate-600 dark:text-zinc-400 focus:ring-2 focus:ring-emerald-500">
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active Fleet</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <button type="submit" class="px-8 py-2.5 bg-slate-800 dark:bg-emerald-600 text-white rounded-xl font-bold hover:scale-105 active:scale-95 transition-all">
                        Filter
                    </button>
                </form>
            </div>

            {{-- VENDORS GRID/LIST --}}
            <div class="grid gap-6">
                @forelse($vendors as $vendor)
                <div class="group bg-white dark:bg-zinc-900 p-6 rounded-[2rem] border border-slate-100 dark:border-zinc-800 shadow-sm hover:shadow-xl hover:border-emerald-200 dark:hover:border-emerald-900/30 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                        {{-- Left: Identity --}}
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 bg-slate-50 dark:bg-zinc-800 rounded-2xl flex items-center justify-center text-2xl shadow-inner border border-slate-100 dark:border-zinc-800 group-hover:rotate-3 transition-transform">
                                <span class="font-black text-emerald-500">{{ substr($vendor->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ $vendor->name }}</h3>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-sm font-medium text-slate-500">
                                    <span class="flex items-center gap-1.5 text-xs uppercase tracking-wider">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 100-4H5a2 2 0 100 4z" stroke-width="2"/></svg>
                                        {{ $vendor->email }}
                                    </span>
                                    <span class="flex items-center gap-1.5 text-xs uppercase tracking-wider">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2"/></svg>
                                        {{ $vendor->phone }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Actions & Status --}}
                        <div class="flex items-center justify-between lg:justify-end gap-6 border-t lg:border-t-0 pt-4 lg:pt-0">
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.1em] {{ $vendor->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30' : 'bg-rose-100 text-rose-700 dark:bg-rose-900/30' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                    {{ $vendor->is_active ? 'Online' : 'Offline' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.vendors.edit', $vendor->id) }}"
                                   class="p-3 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST" onsubmit="return confirm('Release this partner from the network?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <div class="py-20 text-center bg-white dark:bg-zinc-900 rounded-[3rem] border border-dashed border-slate-200 dark:border-zinc-800">
                    <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="1.5"/></svg>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">The Safari is empty. Recruit your first partner!</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $vendors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
