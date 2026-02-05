<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Catalogue
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-11">Inventory management system</p>
            </div>

            <a href="{{ route('food.create') }}"
               class="px-6 py-3 bg-emerald-500 text-white rounded-2xl hover:bg-emerald-600 transition-all font-bold shadow-lg shadow-emerald-200 dark:shadow-none flex items-center gap-2 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add Item</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- MODERN FILTER BAR --}}
            <div class="mb-8 bg-white dark:bg-zinc-900 p-4 rounded-[1.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
                <form method="GET" class="flex flex-wrap items-center gap-4">

                    {{-- Search Input --}}
                    <div class="flex-1 min-w-[200px] relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Find a bite..."
                            class="w-full pl-10 bg-slate-50 dark:bg-zinc-800 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-700 dark:text-zinc-200 transition-all">
                    </div>

                    {{-- Filters Group --}}
                    <div class="flex flex-wrap items-center gap-3">

                        {{-- Vendor Filter (Added Back) --}}
                        <div class="relative">
                            <select name="vendor_id" class="appearance-none pl-4 pr-10 py-2 bg-slate-50 dark:bg-zinc-800 border-none rounded-xl text-xs font-black uppercase tracking-tighter text-slate-600 dark:text-zinc-400 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                <option value="">All Vendors</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Category Filter --}}
                        <div class="relative">
                            <select name="category_id" class="appearance-none pl-4 pr-10 py-2 bg-slate-50 dark:bg-zinc-800 border-none rounded-xl text-xs font-black uppercase tracking-tighter text-slate-600 dark:text-zinc-400 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2">
                            <button type="submit" class="p-2.5 bg-slate-800 dark:bg-emerald-600 text-white rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-emerald-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </button>

                            @if(request()->hasAny(['search', 'vendor_id', 'category_id']))
                                <a href="{{ route('food.index') }}" class="p-2.5 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-100 transition-colors" title="Clear Filters">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            {{-- DATA TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[2rem] border border-slate-100 dark:border-zinc-800 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <th class="px-6 py-5">Product</th>
                            <th class="px-6 py-5">Category</th>
                            <th class="px-6 py-5">Price</th>
                            <th class="px-6 py-5">Availability</th>
                            <th class="px-6 py-5 text-right">Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                        @forelse($foods as $food)
                        <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/20 rounded-xl overflow-hidden border border-emerald-50 flex items-center justify-center">
                                        @if($food->image)
                                            <img src="{{ asset('storage/' . $food->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-emerald-500 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <span class="text-sm font-bold text-slate-700 dark:text-zinc-200 group-hover:text-emerald-600">{{ $food->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[11px] font-black uppercase tracking-tighter text-slate-500 bg-slate-100 dark:bg-zinc-800 px-2 py-1 rounded-md">
                                    {{ $food->category->name ?? 'None' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-black text-slate-800 dark:text-zinc-100">
                                ₹{{ number_format($food->price, 0) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $food->quantity > 0 ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.5)]' }}"></div>
                                    <span class="text-xs font-bold {{ $food->quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $food->quantity > 0 ? $food->quantity . ' Stock' : 'Out' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('food.edit', $food) }}" class="text-slate-400 hover:text-emerald-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button onclick="deleteFood({{ $food->id }})" class="text-slate-400 hover:text-rose-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $food->id }}" action="{{ route('food.destroy', $food) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <svg class="w-16 h-16 mx-auto text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="mt-4 text-slate-400 font-bold uppercase tracking-widest text-[10px]">No Bites Registered</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
