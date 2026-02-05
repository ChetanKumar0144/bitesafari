<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-white tracking-tight">
                {{ __('Admin Command Center') }}
            </h2>
            <div class="flex items-center gap-2 text-sm font-medium text-slate-500 bg-white dark:bg-zinc-800 px-4 py-2 rounded-2xl shadow-sm border border-slate-100 dark:border-zinc-700">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                System Live: {{ now()->format('H:i') }}
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- ================= QUICK STATS (Safari Style) ================= --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                @php
                    $stats = [
                        ['Foods', $totalFoods, 'emerald', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['Total Orders', $totalOrders, 'blue', 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                        ['Pending', $pendingOrders, 'amber', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Explorers', $totalCustomers, 'indigo', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['Vendors', $totalVendors, 'rose', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ];
                @endphp

                @foreach($stats as [$label, $value, $color, $icon])
                    <div class="group bg-white dark:bg-zinc-900 rounded-[2rem] p-6 shadow-sm border border-slate-100 dark:border-zinc-800 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-2xl bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 text-{{ $color }}-600 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path></svg>
                            </div>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-400">{{ $label }}</p>
                        <p class="text-3xl font-black mt-1 text-slate-800 dark:text-white">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            {{-- ================= MAIN CONTENT GRID ================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Left: Actions & Summary (8 Columns) --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- Banner --}}
                    <div class="relative overflow-hidden bg-emerald-600 rounded-[2.5rem] p-8 text-white shadow-lg shadow-emerald-200 dark:shadow-none">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-2">Welcome back to the Safari, Admin!</h3>
                            <p class="text-emerald-50 opacity-90 max-w-lg">Everything is looking great. You have {{ $pendingOrders }} orders waiting for review today.</p>
                            <div class="mt-6 flex gap-3">
                                <a href="{{ route('food.create') }}" class="px-6 py-3 bg-white text-emerald-600 rounded-2xl font-bold text-sm hover:shadow-lg transition-all active:scale-95">
                                    + Create New Bite
                                </a>
                            </div>
                        </div>
                        {{-- Decorative SVG Pattern --}}
                        <svg class="absolute right-0 bottom-0 w-64 h-64 text-emerald-500/20 -mr-16 -mb-16" fill="currentColor" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="50"></circle>
                        </svg>
                    </div>

                    {{-- Summary Grid --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6">📊 Today's Pulse</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach([
                                ['Orders', $todayOrders ?? 0, 'bg-slate-50 text-slate-600'],
                                ['Completed', $todayCompletedOrders ?? 0, 'bg-emerald-50 text-emerald-600'],
                                ['Pending', $todayPendingOrders ?? 0, 'bg-amber-50 text-amber-600'],
                                ['Revenue', '₹'.number_format($todayRevenue ?? 0), 'bg-blue-50 text-blue-600']
                            ] as [$l, $v, $c])
                                <div class="{{ $c }} p-5 rounded-3xl">
                                    <p class="text-xs font-bold uppercase opacity-70">{{ $l }}</p>
                                    <p class="text-2xl font-black mt-1">{{ $v }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Trend Chart --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-lg font-bold">📈 Activity Trend</h3>
                            <span class="text-xs font-bold text-slate-400 tracking-tighter uppercase">Last 7 Days</span>
                        </div>
                        <div class="flex items-end justify-between gap-2 h-40">
                            @foreach($orderTrends ?? [30, 45, 25, 60, 40, 70, 55] as $count)
                                <div class="flex-1 group relative">
                                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                        {{ $count }}
                                    </div>
                                    <div class="w-full bg-emerald-500/10 rounded-t-xl overflow-hidden flex items-end" style="height: 140px">
                                        <div class="w-full bg-emerald-500 rounded-t-xl transition-all duration-1000 group-hover:bg-emerald-400"
                                             style="height: {{ ($count / 80) * 100 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Right: Sidebar Actions (4 Columns) --}}
                <div class="lg:col-span-4 space-y-8">

                    {{-- Roles Widget --}}
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white">
                        <h3 class="text-lg font-bold mb-6">Active Roles</h3>
                        <div class="space-y-4">
                            @foreach(['admin' => 'Full Access', 'vendor' => 'Store Only', 'user' => 'Ordering'] as $r => $desc)
                                <div class="flex items-center p-4 bg-white/5 rounded-2xl border border-white/10">
                                    <div class="w-2 h-2 rounded-full {{ auth()->user()->role == $r ? 'bg-emerald-400 shadow-[0_0_10px_#34d399]' : 'bg-white/20' }} mr-4"></div>
                                    <div>
                                        <p class="text-sm font-bold capitalize">{{ $r }}</p>
                                        <p class="text-[10px] opacity-50">{{ $desc }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- System Health --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800">
                        <h3 class="text-lg font-bold mb-4">⚙️ Quick Links</h3>
                        <div class="grid grid-cols-1 gap-3">
                            <a href="{{ route('users.index') }}" class="p-4 rounded-2xl border border-slate-50 dark:border-zinc-800 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors flex items-center gap-3">
                                <span class="text-xl">👥</span>
                                <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">User Management</span>
                            </a>
                            <a href="{{ route('settings.index') }}" class="p-4 rounded-2xl border border-slate-50 dark:border-zinc-800 hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors flex items-center gap-3">
                                <span class="text-xl">🛠️</span>
                                <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">Platform Settings</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
