<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-emerald-500 rounded-[1.5rem] flex items-center justify-center shadow-2xl shadow-emerald-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Catalogue</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2 italic">Global Inventory Overview</p>
                </div>
            </div>

            <a href="{{ route('food.create') }}"
               class="px-8 py-4 bg-emerald-500 text-white rounded-2xl hover:bg-emerald-600 transition-all font-black shadow-xl shadow-emerald-200 dark:shadow-none flex items-center gap-3 active:scale-95 text-[10px] uppercase tracking-[0.2em] italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add Item</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- MODERN FILTER BAR --}}
            <div class="bg-white dark:bg-zinc-900 p-5 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
                <form method="GET" class="flex flex-wrap items-center gap-5">
                    {{-- Search Input --}}
                    <div class="flex-1 min-w-[280px] relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-emerald-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Find a bite..."
                            class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-emerald-500/20 text-sm font-bold text-slate-700 dark:text-zinc-200 transition-all shadow-inner">
                    </div>

                    {{-- Filters Group --}}
                    <div class="flex flex-wrap items-center gap-4">
                        <select name="vendor_id" class="pl-5 pr-10 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest text-slate-500 focus:ring-2 focus:ring-emerald-500 cursor-pointer shadow-inner">
                            <option value="">All Partners</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                            @endforeach
                        </select>

                        <select name="category_id" class="pl-5 pr-10 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.2rem] text-[10px] font-black uppercase tracking-widest text-slate-500 focus:ring-2 focus:ring-emerald-500 cursor-pointer shadow-inner">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="px-10 py-4 bg-slate-900 dark:bg-emerald-600 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[10px] hover:scale-105 active:scale-95 transition-all shadow-xl shadow-emerald-500/10">
                            Apply Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- DATA TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">
                                <th class="px-8 py-6">Product Details</th>
                                <th class="px-8 py-6">Category</th>
                                <th class="px-8 py-6">Price</th>
                                <th class="px-8 py-6 text-center">Stock Status</th>
                                <th class="px-8 py-6 text-right">Manage</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800/50">
                            @forelse($foods as $food)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all duration-300">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 bg-emerald-100/50 dark:bg-emerald-900/20 rounded-2xl overflow-hidden border border-emerald-50 dark:border-emerald-900/30 flex items-center justify-center shrink-0">
                                            @if($food->image)
                                                <img src="{{ asset('storage/' . $food->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <svg class="w-7 h-7 text-emerald-500 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="block text-sm font-black text-slate-800 dark:text-white uppercase italic tracking-tight">{{ $food->name }}</span>
                                            <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">By: {{ $food->vendor->name ?? 'Wild Partner' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 bg-slate-100 dark:bg-zinc-800 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-zinc-700">
                                        {{ $food->category->name ?? 'Wild Bite' }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="text-base font-black text-slate-900 dark:text-zinc-100 italic tracking-tighter">₹{{ number_format($food->price, 0) }}</span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest {{ $food->quantity > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current {{ $food->quantity > 0 ? 'animate-ping' : '' }}"></span>
                                        {{ $food->quantity > 0 ? $food->quantity . ' In Stock' : 'Sold Out' }}
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('food.edit', $food) }}" class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-emerald-500 hover:bg-emerald-50 rounded-xl flex items-center justify-center transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <button onclick="deleteFood({{ $food->id }})" class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl flex items-center justify-center transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $food->id }}" action="{{ route('food.destroy', $food) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-40 text-center opacity-25">
                                    <p class="text-sm font-black uppercase tracking-[0.5em] italic">No items found in global trail</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">{{ $foods->links() }}</div>
        </div>
    </div>
</x-app-layout>
