<x-vendor-layout>
    <x-slot name="header">
        <div class="flex items-center gap-6">
            <div class="w-14 h-14 bg-amber-500 rounded-2xl flex items-center justify-center shadow-xl shadow-amber-200 rotate-3 transition-all hover:rotate-0 duration-500">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight italic uppercase">Orders</h2>
                <p class="text-slate-400 text-xs font-bold tracking-wide mt-1">Track and manage your kitchen orders</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-12">

        {{-- Simple Filter Chips --}}
        <div class="flex flex-wrap gap-4">
            @php
                $currentStatus = request('status', 'all');
                $statuses = [
                    'all' => ['label' => 'All Orders', 'val' => null],
                    'pending' => ['label' => 'New', 'val' => 'pending'],
                    'accepted' => ['label' => 'Preparing', 'val' => 'accepted'],
                    'ready' => ['label' => 'Ready', 'val' => 'ready'],
                    'delivered' => ['label' => 'Completed', 'val' => 'delivered']
                ];
            @endphp

            @foreach($statuses as $key => $status)
                <a href="{{ route('vendor.orders.index', $status['val'] ? ['status' => $status['val']] : []) }}"
                   class="px-8 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all border
                   {{ $currentStatus == $key ? 'bg-slate-900 border-slate-900 text-white dark:bg-amber-500 dark:border-amber-500 shadow-lg' : 'bg-white border-slate-100 text-slate-400 dark:bg-zinc-900 dark:border-zinc-800 hover:border-amber-400 hover:text-amber-500 shadow-sm' }}">
                    {{ $status['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Clean Table --}}
        <div class="bg-white dark:bg-zinc-900 rounded-[3rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                            <th class="px-12 py-8">Order ID</th>
                            <th class="px-12 py-8">Items</th>
                            <th class="px-12 py-8 text-center">Earnings</th>
                            <th class="px-12 py-8 text-center">Status</th>
                            <th class="px-12 py-8 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-zinc-800/50">
                        @forelse($orders as $order)
                        <tr class="group hover:bg-slate-50/40 dark:hover:bg-zinc-800/20 transition-all duration-300">
                            <td class="px-12 py-8">
                                <div class="space-y-1">
                                    <span class="text-lg font-black text-slate-900 dark:text-white italic tracking-tighter uppercase">#{{ $order->order_no }}</span>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                                        {{ $order->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-12 py-8">
                                <div class="flex flex-col gap-3">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center gap-4">
                                            <span class="px-2 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 rounded-lg text-[11px] font-black min-w-[35px] text-center border border-amber-100 dark:border-amber-900/30">
                                                {{ $item->quantity }}x
                                            </span>
                                            <span class="text-sm font-bold text-slate-700 dark:text-zinc-300 italic">{{ $item->food_name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-12 py-8 text-center">
                                <span class="text-lg font-black text-emerald-600 tracking-tighter">₹{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0) }}</span>
                            </td>

                            <td class="px-12 py-8 text-center">
                                @php
                                    $statusConfig = [
                                        'pending'   => ['label' => 'New', 'css' => 'bg-amber-100 text-amber-700'],
                                        'accepted'  => ['label' => 'Preparing', 'css' => 'bg-blue-100 text-blue-700'],
                                        'ready'     => ['label' => 'Ready', 'css' => 'bg-indigo-100 text-indigo-700'],
                                        'delivered' => ['label' => 'Completed', 'css' => 'bg-emerald-100 text-emerald-700'],
                                    ];
                                    $s = $statusConfig[$order->status] ?? ['label' => $order->status, 'css' => 'bg-slate-100 text-slate-600'];
                                @endphp
                                <span class="px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest {{ $s['css'] }}">
                                    {{ $s['label'] }}
                                </span>
                            </td>

                            <td class="px-12 py-8 text-right">
                                <a href="{{ route('vendor.orders.show', $order->id) }}"
                                   class="px-6 py-3 bg-slate-50 dark:bg-zinc-800 text-slate-600 dark:text-zinc-400 hover:bg-amber-500 hover:text-white rounded-2xl transition-all inline-flex items-center gap-2 shadow-sm font-black text-[10px] uppercase tracking-widest group/btn">
                                    <span>View Bill</span>
                                    <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-40 text-center opacity-25">
                                <p class="text-sm font-black uppercase tracking-[0.5em] italic">No orders found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-12 flex justify-center">{{ $orders->links() }}</div>
    </div>
</x-vendor-layout>
