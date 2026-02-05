<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Performance
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Kitchen health & revenue overview</p>
            </div>

            <div class="flex items-center gap-2 px-4 py-2 bg-amber-50 dark:bg-amber-950/20 border border-amber-100 dark:border-amber-900/30 rounded-2xl">
                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                <span class="text-xs font-black uppercase tracking-widest text-amber-600 italic">Store Live</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ================= MERCHANT STATS ================= --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $vendorStats = [
                        ['Total Revenue', '₹' . number_format($totalRevenue ?? 0), 'emerald', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Active Orders', $pendingOrdersCount ?? 0, 'amber', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                        ['Menu Size', $totalFoodsCount ?? 0, 'blue', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['Store Rating', ($rating ?? 4.8) . '/5', 'indigo', 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                    ];
                @endphp

                @foreach($vendorStats as [$label, $value, $color, $icon])
                    <div class="bg-white dark:bg-zinc-900 rounded-[2rem] p-6 border border-slate-100 dark:border-zinc-800 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-12 h-12 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 text-{{ $color }}-600 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                        </div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">{{ $label }}</p>
                        <p class="text-2xl font-black mt-1 text-slate-800 dark:text-white">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            {{-- ================= ACTION BANNER ================= --}}
            <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 lg:p-12 text-white shadow-2xl shadow-slate-200 dark:shadow-none">
                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div>
                        <h3 class="text-3xl font-black italic tracking-tight mb-3 text-amber-400">Ready to expand your menu?</h3>
                        <p class="text-slate-400 max-w-md font-medium">Add new flavors to attract more explorers. Your current menu has {{ $totalFoodsCount ?? 0 }} items live.</p>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('vendor.foods.create') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest text-xs transition-all active:scale-95 shadow-lg shadow-emerald-500/20">
                            Add New Recipe
                        </a>
                        <a href="{{ route('vendor.orders.index') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white rounded-2xl font-black uppercase tracking-widest text-xs transition-all backdrop-blur-md border border-white/10">
                            View Orders
                        </a>
                    </div>
                </div>
                {{-- Abstract BG SVG --}}
                <svg class="absolute right-0 bottom-0 w-64 h-64 text-white opacity-[0.03] -mr-20 -mb-20" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
            </div>

            {{-- ================= RECENT ACTIVITY GRID ================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Recent Orders --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Incoming Expeditions</h3>
                        <a href="{{ route('vendor.orders.index') }}" class="text-[10px] font-black uppercase tracking-widest text-amber-500 hover:underline">View All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentOrders ?? [] as $order)
                            <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-zinc-800/50 rounded-2xl border border-transparent hover:border-amber-200 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center text-amber-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-800 dark:text-zinc-100 italic">#{{ $order->order_no }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="text-sm font-black text-slate-900 dark:text-white italic">₹{{ number_format($order->total_amount, 0) }}</span>
                            </div>
                        @empty
                            <p class="text-slate-400 text-sm font-bold italic text-center py-10 tracking-widest uppercase opacity-40">No recent orders</p>
                        @endforelse
                    </div>
                </div>

                {{-- Revenue Trend --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Weekly Pulse</h3>
                    </div>
                    <div class="flex items-end justify-between gap-2 h-48">
                        @foreach($revenueTrends ?? [20, 50, 40, 80, 60, 90, 70] as $value)
                            <div class="flex-1 group relative">
                                <div class="w-full bg-amber-500/10 rounded-t-xl flex items-end overflow-hidden" style="height: 160px">
                                    <div class="w-full bg-amber-500 rounded-t-xl transition-all duration-700 group-hover:bg-amber-400"
                                         style="height: {{ $value }}%"></div>
                                </div>
                                <div class="mt-2 text-center text-[10px] font-black text-slate-300 uppercase tracking-tighter">Day</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
