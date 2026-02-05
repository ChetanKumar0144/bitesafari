<x-vendor-layout>
    @php
        $vendor = auth('vendor')->user();

        // Manual color mapping for Tailwind safety
        $colors = [
            'amber' => 'bg-amber-50 dark:bg-amber-900/20 text-amber-600',
            'blue' => 'bg-blue-50 dark:bg-blue-900/20 text-blue-600',
            'indigo' => 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600',
            'emerald' => 'bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600',
        ];

        $statCards = [
            ['Kitchen Inventory', $stats['totalFoods'] ?? 0, 'amber', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
            ['Global Orders', $stats['totalOrders'] ?? 0, 'blue', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
            ['Active Expeditions', $stats['pendingOrders'] ?? 0, 'indigo', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['Gross Revenue', '₹'.number_format($stats['todayRevenue'] ?? 0), 'emerald', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ];
    @endphp

    {{-- Header Content --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-2xl shadow-amber-200 rotate-3 group-hover:rotate-0 transition-transform duration-500">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase">Performance</h2>
                </div>
            </div>

            <div class="flex items-center gap-3 px-5 py-2.5 bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-[1.5rem] shadow-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-600 italic">Live Kitchen Radar</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-10">

        {{-- ================= CORE STATS ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($statCards as [$label, $value, $colorKey, $icon])
                <div class="group bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800/50 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 {{ $colors[$colorKey] }} rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform duration-500 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="{{ $icon }}"></path>
                        </svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 italic mb-1">{{ $label }}</p>
                    <p class="text-3xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        {{-- ================= PENDING ALERT ================= --}}
        @if(($stats['pendingOrders'] ?? 0) > 0)
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                class="relative bg-gradient-to-r from-amber-500 to-orange-600 rounded-[2.5rem] p-8 flex flex-col md:flex-row items-center gap-8 shadow-2xl shadow-amber-200 dark:shadow-none overflow-hidden group">
                {{-- Decorative SVG --}}
                <svg class="absolute right-0 bottom-0 w-64 h-64 text-white/10 -mb-20 -mr-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2L3 14h9v8l10-12h-9l9-8z"/></svg>

                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center shrink-0 border border-white/30 rotate-3">
                    <svg class="w-8 h-8 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="flex-1 text-center md:text-left z-10">
                    <h4 class="text-white font-black uppercase tracking-[0.3em] text-[10px] italic opacity-80 mb-1">Unprocessed Signals</h4>
                    <p class="text-white font-black text-2xl tracking-tight leading-tight">
                        Critical Alert! You have {{ $stats['pendingOrders'] }} new expeditions awaiting kitchen approval.
                    </p>
                </div>
                <a href="{{ route('vendor.orders.index', ['status'=>'pending']) }}"
                   class="z-10 px-10 py-5 bg-white text-orange-600 rounded-[2rem] font-black uppercase tracking-widest text-[11px] hover:shadow-2xl hover:scale-105 transition-all active:scale-95 shadow-lg">
                    Manage Dashboard
                </a>
            </div>
        @endif

        {{-- ================= MIDDLE SECTION ================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- TODAY SUMMARY & CHART --}}
            <div class="lg:col-span-8 bg-white dark:bg-zinc-900 rounded-[3.5rem] p-12 border border-slate-100 dark:border-zinc-800 shadow-[0_20px_50px_rgba(0,0,0,0.02)]">
                <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                    <div class="text-center sm:text-left">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 italic mb-2">Daily Pulse Monitor</h3>
                        <p class="text-2xl font-black text-slate-800 dark:text-white uppercase italic">{{ now()->format('D, d M Y') }}</p>
                    </div>
                    <div class="h-12 w-[1px] bg-slate-100 hidden sm:block"></div>
                    <div class="flex gap-4">
                         {{-- Today mini stats --}}
                         <div class="text-center px-4">
                            <p class="text-[9px] font-black text-slate-300 uppercase italic">Daily Hits</p>
                            <p class="text-lg font-black text-slate-700 dark:text-zinc-200">{{ $stats['todayOrders'] ?? 0 }}</p>
                         </div>
                    </div>
                </div>

                {{-- Chart Area --}}
                <div class="mt-12">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300 mb-10 text-center">Velocity Tracking (Last 7 Days)</h3>
                    <div class="flex items-end justify-between gap-4 h-48 px-4">
                        @foreach($stats['orderTrends'] ?? [20, 45, 30, 70, 50, 90, 65] as $count)
                            <div class="flex-1 group relative h-full flex items-end">
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-3 py-1.5 rounded-xl opacity-0 group-hover:opacity-100 transition-all font-black uppercase tracking-widest z-20 whitespace-nowrap">
                                    {{ $count }} Bites Today
                                </div>
                                <div class="w-full bg-slate-50 dark:bg-zinc-800/50 rounded-2xl overflow-hidden flex items-end h-full group-hover:bg-slate-100 dark:group-hover:bg-zinc-800 transition-colors">
                                    <div class="w-full bg-gradient-to-t from-amber-500 to-amber-300 rounded-t-xl transition-all duration-1000 group-hover:from-amber-400 group-hover:to-amber-200"
                                         style="height: {{ min($count * 1.5, 100) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- QUICK ACTIONS SIDEBAR --}}
            <div class="lg:col-span-4 space-y-10">
                <div class="bg-slate-900 dark:bg-zinc-800 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center mb-6 rotate-6 shadow-xl shadow-amber-500/20 group-hover:rotate-0 transition-transform">
                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4a2 2 0 114 0v1a2 2 0 002 2 2 2 0 110 4H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 002-2V4z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3 class="text-2xl font-black italic mb-8 tracking-tighter uppercase leading-none">Merchant Tools</h3>
                        <div class="space-y-4">
                            <a href="{{ route('vendor.foods.index') }}"
                               class="flex items-center justify-between p-6 bg-white/5 rounded-[2rem] border border-white/10 hover:bg-emerald-500 hover:border-transparent transition-all group/link">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Kitchen Menu</span>
                                <svg class="w-5 h-5 group-hover/link:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="{{ route('vendor.orders.index') }}"
                               class="flex items-center justify-between p-6 bg-white/5 rounded-[2rem] border border-white/10 hover:bg-amber-500 hover:border-transparent transition-all group/link">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Active Orders</span>
                                <svg class="w-5 h-5 group-hover/link:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        </div>
                    </div>
                    {{-- Large BG Icon --}}
                    <svg class="absolute -bottom-10 -left-10 w-48 h-48 text-white/[0.03] rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>

                {{-- Operational Profile --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[3.5rem] p-10 border border-slate-100 dark:border-zinc-800 shadow-sm text-center">
                    <div class="w-20 h-20 bg-slate-50 dark:bg-zinc-800 rounded-[2rem] flex items-center justify-center mx-auto mb-6 border border-slate-100 dark:border-zinc-700">
                         <span class="text-3xl font-black italic text-slate-300 uppercase">{{ substr($vendor->name, 0, 1) }}</span>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-300 mb-1">Authenticated Merchant</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white italic tracking-tighter">{{ $vendor->name }}</p>
                    <div class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 rounded-full">
                         <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                         <span class="text-[8px] font-black uppercase tracking-widest">Signal Locked</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-vendor-layout>
