<x-vendor-layout>
    {{-- Header Content --}}
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
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">BiteSafari Merchant Command Center</p>
            </div>

            <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/30 rounded-2xl">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 italic">Live Kitchen</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- ================= CORE STATS ================= --}}
            @php
                $vendor = auth('vendor')->user();
                $statCards = [
                    ['Kitchen Inventory', $stats['totalFoods'] ?? 0, 'amber', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['Global Orders', $stats['totalOrders'] ?? 0, 'blue', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                    ['Active Expeditions', $stats['pendingOrders'] ?? 0, 'indigo', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['Gross Revenue', '₹ '.number_format($stats['todayRevenue'] ?? 0), 'emerald', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($statCards as [$label, $value, $color, $icon])
                    <div class="group bg-white dark:bg-zinc-900 rounded-[2rem] p-6 border border-slate-100 dark:border-zinc-800 shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-12 h-12 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 text-{{ $color }}-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                        </div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">{{ $label }}</p>
                        <p class="text-2xl font-black mt-1 text-slate-800 dark:text-white italic">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            {{-- ================= PENDING ALERT ================= --}}
            @if(($stats['pendingOrders'] ?? 0) > 0)
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 8000)" x-show="show" x-transition
                    class="bg-amber-500 rounded-[2rem] p-6 flex flex-col md:flex-row items-center gap-6 shadow-lg shadow-amber-200 dark:shadow-none">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <p class="text-white font-black uppercase tracking-widest text-xs italic">Incoming Expeditions</p>
                        <p class="text-white/90 font-bold text-lg leading-tight mt-1">
                            Attention! There are {{ $stats['pendingOrders'] }} orders awaiting your approval.
                        </p>
                    </div>
                    <a href="{{ route('vendor.orders.index', ['status'=>'pending']) }}"
                       class="px-8 py-3 bg-white text-amber-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:shadow-xl transition-all active:scale-95">
                        Manage Now
                    </a>
                </div>
            @endif

            {{-- ================= MIDDLE SECTION ================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- TODAY SUMMARY TABLE STYLE --}}
                <div class="lg:col-span-8 bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 italic">Today's Pulse</h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">{{ now()->format('d M, Y') }}</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        @foreach([
                            ['Orders', $stats['todayOrders'] ?? 0, 'slate'],
                            ['Completed', $stats['todayCompletedOrders'] ?? 0, 'emerald'],
                            ['Pending', $stats['todayPendingOrders'] ?? 0, 'amber'],
                            ['Revenue', '₹'.number_format($stats['todayRevenue'] ?? 0), 'blue']
                        ] as [$l, $v, $c])
                            <div class="p-6 bg-slate-50 dark:bg-zinc-800/50 rounded-3xl border border-slate-100 dark:border-zinc-800 transition-all hover:border-{{ $c }}-400">
                                <p class="text-[10px] font-black uppercase tracking-tighter text-slate-400 mb-1">{{ $l }}</p>
                                <p class="text-xl font-black text-slate-800 dark:text-white italic">{{ $v }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- ORDER TREND MINI CHART --}}
                    <div class="mt-12">
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-8">Activity Graph (7 Days)</h3>
                        <div class="flex items-end justify-between gap-2 h-32">
                            @forelse($stats['orderTrends'] ?? [20, 45, 30, 70, 50, 90, 65] as $count)
                                <div class="flex-1 group relative">
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity font-bold">
                                        {{ $count }} Bites
                                    </div>
                                    <div class="w-full bg-amber-500/10 rounded-t-xl overflow-hidden flex items-end" style="height: 120px">
                                        <div class="w-full bg-amber-500 rounded-t-xl transition-all duration-1000 group-hover:bg-amber-400"
                                             style="height: {{ min($count*2, 100) }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="w-full text-center text-slate-300 italic text-xs">Awaiting data trek...</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- QUICK ACTIONS SIDEBAR --}}
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="text-xl font-black italic mb-6 text-amber-400">Merchant Tools</h3>
                            <div class="space-y-4">
                                <a href="{{ route('vendor.foods.index') }}"
                                   class="flex items-center justify-between p-5 bg-white/5 rounded-2xl border border-white/10 hover:bg-emerald-500 transition-all group">
                                    <span class="text-sm font-black uppercase tracking-widest">Kitchen Menu</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <a href="{{ route('vendor.orders.index') }}"
                                   class="flex items-center justify-between p-5 bg-white/5 rounded-2xl border border-white/10 hover:bg-amber-500 transition-all group">
                                    <span class="text-sm font-black uppercase tracking-widest">Recent Orders</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                        {{-- SVG Decor --}}
                        <svg class="absolute -bottom-10 -left-10 w-40 h-40 text-white/5" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
                    </div>

                    {{-- Operational Status --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm text-center">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Current Identity</p>
                        <p class="text-lg font-black text-slate-800 dark:text-white italic tracking-tight">{{ $vendor->name }}</p>
                        <p class="text-xs font-bold text-emerald-500 mt-1">{{ $vendor->email }}</p>
                    </div>
                </div>

            </div>

            <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.5em] pt-10">
                &copy; {{ date('Y') }} Bitesafari Merchant Network • Secure Session
            </p>
        </div>
    </div>
</x-vendor-layout>
