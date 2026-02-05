<x-vendor-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Fulfillment</h2>
                <p class="text-slate-500 text-sm font-medium tracking-wide">Managing your specific kitchen manifest</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Filter Chips --}}
            <div class="flex flex-wrap gap-3">
                @foreach(['all' => null, 'pending' => 'pending', 'accepted' => 'accepted', 'delivered' => 'delivered'] as $label => $val)
                    <a href="{{ route('vendor.orders.index', $val ? ['status' => $val] : []) }}"
                       class="px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest transition-all border {{ request('status') == $val ? 'bg-slate-900 border-slate-900 text-white dark:bg-amber-500 dark:border-amber-500' : 'bg-white border-slate-100 text-slate-500 dark:bg-zinc-900 dark:border-zinc-800 hover:border-amber-400' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-zinc-800/50 border-b border-slate-100 dark:border-zinc-800 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-8 py-6">Manifest ID</th>
                                <th class="px-8 py-6">Items (Your Kitchen)</th>
                                <th class="px-8 py-6 text-center">Your Payout</th>
                                <th class="px-8 py-6 text-right">Status</th>
                                <th class="px-8 py-6 text-right">Command</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-800 dark:text-zinc-100">#{{ $order->order_no }}</span>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mt-0.5">{{ $order->created_at->diffForHumans() }}</p>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-1.5">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center gap-2">
                                                <span class="w-5 h-5 flex items-center justify-center bg-slate-100 dark:bg-zinc-800 rounded text-[9px] font-black text-slate-500">{{ $item->quantity }}x</span>
                                                <span class="text-xs font-bold text-slate-700 dark:text-zinc-300 italic">{{ $item->food_name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <span class="text-sm font-black text-amber-600 italic">
                                        ₹{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0) }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter
                                        {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <a href="{{ route('vendor.orders.show', $order->id) }}"
                                       class="p-3 bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 rounded-xl hover:bg-amber-500 hover:text-white transition-all inline-flex items-center shadow-sm group/btn">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="py-20 text-center opacity-30 font-black uppercase tracking-widest text-xs">No Manifests in this territory</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">{{ $orders->links() }}</div>
        </div>
    </div>
</x-vendor-layout>
