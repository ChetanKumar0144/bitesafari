<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Live Tracking
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Monitoring safari orders in real-time</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ALERT MESSAGES --}}
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- STATUS FILTER CHIPS --}}
            <div class="mb-8 flex flex-wrap gap-3">
                @php
                    $filterItems = [
                        ['label' => 'All Bites', 'slug' => null, 'color' => 'slate'],
                        ['label' => 'Pending', 'slug' => 'pending', 'color' => 'amber'],
                        ['label' => 'Accepted', 'slug' => 'accepted', 'color' => 'blue'],
                        ['label' => 'Delivered', 'slug' => 'delivered', 'color' => 'emerald'],
                    ];
                @endphp

                @foreach($filterItems as $item)
                    <a href="{{ route('orders.index', $item['slug'] ? ['status' => $item['slug']] : []) }}"
                       class="px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-sm border
                       {{ (request('status') == $item['slug'])
                            ? 'bg-slate-800 border-slate-800 text-white dark:bg-emerald-600 dark:border-emerald-600'
                            : 'bg-white border-slate-100 text-slate-500 dark:bg-zinc-900 dark:border-zinc-800 hover:border-emerald-400' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- ORDERS TABLE --}}
            <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-6 py-5">Order ID</th>
                                <th class="px-6 py-5">Status Badge</th>
                                <th class="px-6 py-5 text-center">Amount</th>
                                <th class="px-6 py-5 text-right">Update Progression</th>
                                <th class="px-6 py-5 text-right">Details</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-black text-slate-800 dark:text-zinc-100 tracking-tighter">
                                        #{{ $order->order_no ?? $order->id }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-xs">
                                    @php
                                        $s = $order->status ?? 'pending';
                                        $colors = [
                                            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                            'accepted' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                            'preparing' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
                                            'delivered' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                            'cancelled' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                        ];
                                        $colorClass = $colors[$s] ?? 'bg-slate-100 text-slate-700';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-black uppercase tracking-tighter {{ $colorClass }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                        {{ $s }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="text-sm font-black text-slate-900 dark:text-white italic">
                                        ₹{{ number_format($order->total_amount ?? 0, 0) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()"
                                                class="appearance-none text-[10px] font-black uppercase tracking-widest px-4 py-2 bg-slate-50 dark:bg-zinc-800 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 cursor-pointer disabled:opacity-50"
                                                @disabled(in_array($order->status, ['delivered', 'cancelled']))>
                                            <option value="pending" @selected($order->status==='pending')>Pending</option>
                                            <option value="accepted" @selected($order->status==='accepted')>Accepted</option>
                                            <option value="preparing" @selected($order->status==='preparing')>Preparing</option>
                                            <option value="delivered" @selected($order->status==='delivered')>Delivered</option>
                                            <option value="cancelled" @selected($order->status==='cancelled')>Cancelled</option>
                                        </select>
                                    </form>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="p-2.5 bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-xl hover:bg-emerald-500 hover:text-white transition-all inline-flex items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-slate-100 dark:text-zinc-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p class="mt-4 text-slate-400 font-black uppercase tracking-widest text-[10px]">No Orders Recorded</p>
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
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
