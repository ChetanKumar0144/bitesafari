<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Kitchen Menu
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Manage your live safari recipes</p>
            </div>

            <a href="{{ route('vendor.foods.create') }}"
               class="px-6 py-3 bg-amber-500 text-white rounded-2xl hover:bg-amber-600 transition-all font-bold shadow-lg shadow-amber-200 dark:shadow-none flex items-center gap-2 active:scale-95 text-sm uppercase tracking-widest">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add Recipe</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- SEARCH BAR --}}
            <div class="bg-white dark:bg-zinc-900 p-4 rounded-[1.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
                <form method="GET" class="flex items-center gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Find a recipe by name..."
                               class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 text-sm font-bold transition-all">
                    </div>
                    <button type="submit" class="px-8 py-4 bg-slate-800 dark:bg-amber-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-[1.02] active:scale-95 transition-all">
                        Search
                    </button>
                    @if(request()->has('search'))
                        <a href="{{ route('vendor.foods.index') }}" class="p-4 bg-rose-50 text-rose-500 rounded-2xl hover:bg-rose-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
            </div>

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm animate-in fade-in slide-in-from-left-4">
                    ✨ {{ session('success') }}
                </div>
            @endif

            {{-- FOOD TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-6 py-5">#</th>
                                <th class="px-6 py-5">Dish Presentation</th>
                                <th class="px-6 py-5">Category</th>
                                <th class="px-6 py-5 text-center">Unit Price</th>
                                <th class="px-6 py-5 text-center">In Stock</th>
                                <th class="px-6 py-5 text-center">Feedback</th>
                                <th class="px-6 py-5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @forelse($foods as $food)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                                <td class="px-6 py-4 text-xs font-black text-slate-400">
                                    {{ $loop->iteration + ($foods->currentPage()-1)*$foods->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-slate-100 dark:bg-zinc-800 rounded-2xl overflow-hidden border border-slate-50 dark:border-zinc-800 shadow-sm flex items-center justify-center">
                                            @if($food->image)
                                                <img src="{{ asset('storage/' . $food->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            @endif
                                        </div>
                                        <span class="text-sm font-black text-slate-800 dark:text-zinc-100 group-hover:text-amber-500 transition-colors">{{ $food->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-slate-50 dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-lg text-[10px] font-black uppercase tracking-widest text-slate-500">
                                        {{ $food->category->name ?? 'Unmarked' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center font-black text-slate-900 dark:text-white italic">
                                    ₹{{ number_format($food->price, 0) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $food->quantity > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current {{ $food->quantity > 0 ? 'animate-pulse' : '' }}"></span>
                                        {{ $food->quantity > 0 ? $food->quantity . ' Stock' : 'Sold Out' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-xs font-black text-slate-800 dark:text-zinc-200 tracking-tighter">{{ $food->rating ?? 4.5 }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('vendor.foods.edit', $food) }}" class="p-2.5 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-amber-500 rounded-xl transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <button onclick="deleteFood({{ $food->id }})" class="p-2.5 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-rose-500 rounded-xl transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $food->id }}" action="{{ route('vendor.foods.destroy', $food) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-24 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        <p class="mt-4 text-slate-500 font-black uppercase tracking-[0.3em] text-[10px]">No Bites in the Wild</p>
                                        <a href="{{ route('vendor.foods.create') }}" class="mt-6 px-6 py-2 border-2 border-slate-800 text-slate-800 rounded-full font-black text-[10px] uppercase tracking-widest hover:bg-slate-800 hover:text-white transition-all">Add First Recipe</a>
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
                {{ $foods->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <script>
        function deleteFood(id) {
            if(confirm('Terminating this recipe from the safari?')) {
                document.getElementById('delete-form-'+id).submit();
            }
        }
    </script>
</x-vendor-layout>
