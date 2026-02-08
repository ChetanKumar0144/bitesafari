<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200 rotate-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Safari Command</h2>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-widest">Manifest #{{ $order->order_no }}</p>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="px-6 py-3 bg-white dark:bg-zinc-800 text-slate-600 rounded-2xl border border-slate-200 font-bold text-xs shadow-sm">← Archive</a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- LEFT: MULTI-VENDOR BREAKDOWN --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Global Status --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm relative overflow-hidden">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6">Global Progression</h3>
                        <div class="flex items-center gap-4">
                            <span class="px-6 py-2 bg-emerald-500 text-white rounded-full text-xs font-black uppercase tracking-widest italic animate-pulse">
                                {{ $order->status }}
                            </span>
                            <span class="text-xs text-slate-400 font-bold italic">Initiated at: {{ $order->created_at->format('h:i A') }}</span>
                        </div>
                        {{-- Decorative background SVG --}}
                        <svg class="absolute top-0 right-0 w-32 h-32 text-emerald-500/5 -mr-10 -mt-10" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
                    </div>

                    {{-- VENDOR-WISE TICKETS --}}
                    @foreach($order->vendors as $ov)
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                        <div class="px-8 py-5 border-b border-slate-50 dark:border-zinc-800 flex justify-between items-center bg-slate-50/50 dark:bg-zinc-800/30">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <h4 class="text-sm font-black text-slate-800 dark:text-zinc-100 uppercase tracking-tighter italic">{{ $ov->vendor->name }}</h4>
                            </div>
                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-[9px] font-black uppercase">{{ $ov->status }}</span>
                        </div>

                        <div class="p-8 space-y-4">
                            @foreach($order->items->where('vendor_id', $ov->vendor_id) as $item)
                            <div class="flex justify-between items-center group">
                                <div class="flex items-center gap-4">
                                    <span class="w-6 h-6 flex items-center justify-center bg-slate-100 dark:bg-zinc-800 rounded text-[10px] font-black text-slate-500 italic">{{ $item->quantity }}x</span>
                                    <p class="text-sm font-bold text-slate-700 dark:text-zinc-300">{{ $item->food_name }}</p>
                                </div>
                                <span class="text-sm font-black text-slate-900 dark:text-white italic">₹{{ number_format($item->price * $item->quantity, 0) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="px-8 py-4 bg-slate-900 text-white flex justify-between items-center">
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-500">Merchant Payout</span>
                            <span class="text-lg font-black italic text-amber-400">₹{{ number_format($ov->vendor_total, 0) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- RIGHT: CUSTOMER & LOGISTICS --}}
                <div class="space-y-8">
                    {{-- Explorer Identity --}}
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500 mb-6 italic">Explorer Identity</h3>
                        <div class="relative z-10 space-y-4">
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Name</p>
                                <p class="text-lg font-bold italic">{{ $order->customer->name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Drop Point</p>
                                <p class="text-sm text-slate-300 leading-relaxed">{{ $order->address_line1 }}, {{ $order->city }}</p>
                            </div>
                        </div>
                        <svg class="absolute -bottom-10 -right-10 w-40 h-40 text-emerald-500/5 group-hover:scale-110 transition-transform duration-700" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
                    </div>

                    {{-- Admin Global Control --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 italic">Global Control</h3>
                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <select name="status" class="w-full bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl py-4 px-6 text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                <option value="pending" @selected($order->status == 'pending')>Pending</option>
                                <option value="accepted" @selected($order->status == 'accepted')>Accepted</option>
                                <option value="preparing" @selected($order->status == 'preparing')>Preparing</option>
                                <option value="delivered" @selected($order->status == 'delivered')>Delivered</option>
                                <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                            </select>
                            <button class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-xl shadow-emerald-100 transition-all active:scale-95">Override Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
