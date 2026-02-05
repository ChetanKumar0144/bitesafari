<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Safari Explorers
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Monitoring registered customer base</p>
            </div>

            <a href="{{ route('users.export') }}"
               class="px-6 py-3 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all font-bold shadow-sm flex items-center gap-2 active:scale-95 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export Manifest
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- SEARCH BAR --}}
            <div class="bg-white dark:bg-zinc-900 p-4 rounded-[1.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
                <form method="GET" class="flex items-center gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Locate explorer by name, phone or email..."
                               class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold transition-all">
                    </div>
                    <button type="submit" class="px-8 py-4 bg-slate-800 dark:bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] active:scale-95 transition-all">
                        Search
                    </button>
                </form>
            </div>

            {{-- CUSTOMERS TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-6 py-5">Explorer</th>
                                <th class="px-6 py-5">Communication</th>
                                <th class="px-6 py-5 text-center">Nests (Addresses)</th>
                                <th class="px-6 py-5">Onboarded</th>
                                <th class="px-6 py-5 text-right">Access Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @forelse($customers as $customer)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 font-black shadow-inner">
                                            {{ substr($customer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-800 dark:text-zinc-100">{{ $customer->name }}</p>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter italic">ID: #{{ $customer->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="space-y-1">
                                        <p class="text-xs font-bold text-slate-600 dark:text-zinc-300">{{ $customer->email ?? 'N/A' }}</p>
                                        <p class="text-[11px] font-black text-emerald-500 tracking-wider">{{ $customer->phone }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 bg-slate-100 dark:bg-zinc-800 rounded-full text-xs font-black text-slate-500">
                                        {{ $customer->addresses()->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-xs font-bold text-slate-500">
                                    {{ $customer->created_at->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('users.show', $customer->id) }}"
                                           class="p-2.5 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-emerald-500 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        <form method="POST" action="{{ route('users.status', $customer->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="p-2.5 rounded-xl transition-all {{ $customer->is_blocked ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' : 'bg-rose-50 text-rose-500 hover:bg-rose-100' }}">
                                                @if($customer->is_blocked)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-slate-100 dark:text-zinc-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="1.5"></path></svg>
                                        <p class="mt-4 text-slate-400 font-black uppercase tracking-widest text-[10px]">No Explorers Spotted</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
