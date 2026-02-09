<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-2xl shadow-amber-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Kitchen Menu</h2>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-1 italic">Manage Live Safari Recipes</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('vendor.foods.create') }}"
               class="px-8 py-4 bg-amber-500 text-white rounded-2xl hover:bg-amber-600 transition-all font-black shadow-xl shadow-amber-200 dark:shadow-none flex items-center gap-3 active:scale-95 text-[10px] uppercase tracking-[0.2em] italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Dish</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-8">

        {{-- SEARCH BAR --}}
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 shadow-sm">
            <form method="GET" class="flex flex-col md:flex-row items-center gap-4">
                <div class="flex-1 w-full relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by recipe name..."
                           class="w-full pl-14 pr-6 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500/20 rounded-[1.5rem] focus:ring-0 text-sm font-bold transition-all dark:text-white">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none px-10 py-4 bg-slate-900 dark:bg-amber-600 text-white rounded-[1.5rem] font-black uppercase tracking-[0.2em] text-[10px] hover:bg-black transition-all">
                        Search Trail
                    </button>
                    @if(request('search'))
                        <a href="{{ route('vendor.foods.index') }}" class="p-4 bg-rose-50 dark:bg-rose-900/20 text-rose-500 rounded-[1.5rem] hover:bg-rose-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="p-5 bg-emerald-500 text-white rounded-[2rem] font-black text-xs uppercase tracking-widest flex items-center justify-between shadow-xl shadow-emerald-200 dark:shadow-none animate-in slide-in-from-top-4 duration-500">
                <span>🔥 {{ session('success') }}</span>
                <button @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            </div>
        @endif

        {{-- FOOD TABLE --}}
        <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">
                            <th class="px-8 py-6">ID</th>
                            <th class="px-8 py-6">Presentation</th>
                            <th class="px-8 py-6 text-center">In Stock</th>
                            <th class="px-8 py-6 text-center">Safari Price</th>
                            <th class="px-8 py-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-zinc-800/50">
                        @forelse($foods as $food)
                        <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all">
                            <td class="px-8 py-5 text-[10px] font-black text-slate-300">#{{ $loop->iteration }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-5">
                                    <div class="w-16 h-16 bg-slate-100 dark:bg-zinc-800 rounded-2xl overflow-hidden border border-slate-100 dark:border-zinc-800 shadow-inner flex items-center justify-center shrink-0">
                                        @if($food->image)
                                            <img src="{{ asset($food->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        @else
                                            <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="1.5"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest mb-1">{{ $food->category->name ?? 'Wild Bite' }}</p>
                                        <span class="text-sm font-black text-slate-800 dark:text-white italic uppercase tracking-tight">{{ $food->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $food->quantity > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current {{ $food->quantity > 0 ? 'animate-ping' : '' }}"></span>
                                    {{ $food->quantity > 0 ? $food->quantity . ' Available' : 'Empty Nest' }}
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="text-lg font-black text-slate-900 dark:text-white italic tracking-tighter">₹{{ number_format($food->price, 0) }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('vendor.foods.edit', $food) }}" class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-xl flex items-center justify-center transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2.5"/></svg>
                                    </a>
                                    <button onclick="deleteFood({{ $food->id }})" class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl flex items-center justify-center transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2.5"/></svg>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $food->id }}" action="{{ route('vendor.foods.destroy', $food) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-32 text-center">
                                <div class="flex flex-col items-center gap-6 opacity-30">
                                    <svg class="w-24 h-24 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="1"/></svg>
                                    <p class="text-xs font-black uppercase tracking-[0.4em] italic">The Wild is Empty</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-8 flex justify-center">
            {{ $foods->links() }}
        </div>
    </div>

    <script>
        function deleteFood(id) {
            Swal.fire({
                title: 'TERMINATE RECIPE?',
                text: "This dish will be removed from the safari trail. This action is permanent!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b', // Amber-500
                cancelButtonColor: '#64748b',  // Slate-500
                confirmButtonText: 'YES, DELETE IT',
                cancelButtonText: 'CANCEL',
                background: document.documentElement.classList.contains('dark') ? '#18181b' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#000000',
                customClass: {
                    popup: 'rounded-[2rem] border-4 border-slate-100 dark:border-zinc-800 shadow-2xl',
                    title: 'font-black italic tracking-tighter text-2xl',
                    confirmButton: 'rounded-xl font-black px-6 py-3 uppercase tracking-widest text-xs',
                    cancelButton: 'rounded-xl font-black px-6 py-3 uppercase tracking-widest text-xs'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the specific form
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-vendor-layout>
