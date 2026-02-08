<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-indigo-500 rounded-[1.5rem] flex items-center justify-center shadow-2xl shadow-indigo-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Categories</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2 italic">Organize your food menu items</p>
                </div>
            </div>

            <a href="{{ route('admin.categories.create') }}"
               class="px-8 py-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-black shadow-xl shadow-indigo-200 dark:shadow-none flex items-center gap-3 active:scale-95 text-[10px] uppercase tracking-[0.2em] italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Add New Category</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- CATEGORY TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[9px] font-black uppercase tracking-[0.4em] text-slate-400">
                                <th class="px-10 py-7">Category Name</th>
                                <th class="px-10 py-7 text-center">Total Items</th>
                                <th class="px-10 py-7 text-right">Manage</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800/50">
                            @forelse($categories as $category)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/20 transition-all duration-300">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl flex items-center justify-center text-indigo-600 font-black italic shadow-inner">
                                            {{ substr($category->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-black text-slate-800 dark:text-white uppercase italic tracking-tight">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-center">
                                    <span class="px-4 py-1.5 bg-slate-100 dark:bg-zinc-800 text-slate-500 rounded-full text-[10px] font-black italic uppercase tracking-wider">
                                        {{ $category->foods_count ?? 0 }} Items
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl flex items-center justify-center transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <button onclick="deleteCategory({{ $category->id }})"
                                                class="w-11 h-11 bg-slate-50 dark:bg-zinc-800 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl flex items-center justify-center transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-32 text-center opacity-25">
                                    <p class="text-sm font-black uppercase tracking-[0.5em] italic">No categories found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">{{ $categories->links() }}</div>
        </div>
    </div>

    {{-- SweetAlert Logic --}}
    <script>
        function deleteCategory(id) {
            Swal.fire({
                title: 'DELETE CATEGORY?',
                text: "This will remove the category. Items linked to it might become uncategorized!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5', // Indigo-600
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YES, DELETE',
                background: document.documentElement.classList.contains('dark') ? '#18181b' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#000000',
                customClass: { popup: 'rounded-[2rem] border-4 border-slate-100 dark:border-zinc-800 shadow-2xl' }
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); }
            })
        }
    </script>
</x-app-layout>
