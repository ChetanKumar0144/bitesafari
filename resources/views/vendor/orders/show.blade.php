<x-vendor-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Manifest #{{ $order->order_no }}</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 bg-slate-100 dark:bg-zinc-800 text-slate-500 rounded">Expedition Log: {{ $order->created_at->format('d M, h:i A') }}</span>
                        {{-- Global Status Badge --}}
                        <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded">Global: {{ $order->status }}</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('vendor.orders.index') }}" class="px-5 py-2.5 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-100 dark:border-zinc-700 hover:bg-slate-50 transition-all font-bold text-xs uppercase tracking-widest shadow-sm">← Back</a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 🟢 Success/Error Messages --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm animate-in fade-in slide-in-from-top-4">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left: Ticket Items --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-zinc-900 rounded-[3.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden shadow-sm">
                        <div class="px-10 py-8 border-b border-slate-50 dark:border-zinc-800 bg-slate-50/50 dark:bg-zinc-800/50 flex justify-between items-center">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Your Kitchen Manifest</h3>
                            <span class="text-[10px] font-black uppercase text-amber-600 bg-amber-50 px-3 py-1 rounded-full border border-amber-100">Action Required</span>
                        </div>

                        <div class="divide-y divide-slate-50 dark:divide-zinc-800">
                            @foreach($order->items as $item)
                            <div class="p-10 flex items-center justify-between group hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-all">
                                <div class="flex items-center gap-8">
                                    <div class="w-20 h-20 rounded-3xl overflow-hidden bg-slate-100 shadow-inner group-hover:scale-105 transition-transform">
                                        <img src="{{ asset('storage/'.$item->food->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-black text-slate-800 dark:text-zinc-100 italic tracking-tight">{{ $item->food_name }}</h4>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Ref ID: #{{ $item->food_id }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-12 text-right">
                                    <div class="hidden sm:block">
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Quantity</p>
                                        <p class="text-xl font-black text-slate-800 dark:text-white italic">{{ $item->quantity }}x</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Payout</p>
                                        <p class="text-2xl font-black text-amber-600 italic tracking-tighter">₹{{ number_format($item->price * $item->quantity, 0) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Subtotal Card --}}
                        <div class="p-10 bg-slate-900 text-white flex justify-between items-center relative overflow-hidden">
                            <div class="relative z-10">
                                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 block mb-1">Net Earnings for this Order</span>
                                <span class="text-4xl font-black italic tracking-tighter">₹{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0) }}</span>
                            </div>
                            <svg class="absolute right-0 top-0 w-40 h-40 text-white/5 -mr-10 -mt-10" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"></circle></svg>
                        </div>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="space-y-6">
                    {{-- 📍 Expedition Destination --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm relative overflow-hidden">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 italic">Drop Point</h3>
                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-950 rounded-2xl flex items-center justify-center text-indigo-500 shrink-0 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-widest mb-1">{{ $order->label ?? 'Expedition Base' }}</p>
                                <p class="text-xs font-bold text-slate-500 leading-relaxed italic">{{ $order->address_line1 }}, {{ $order->city }}<br>Maharashtra, {{ $order->postal_code }}</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-24 h-24 bg-indigo-500/5 rounded-full blur-2xl"></div>
                    </div>

                    {{-- 🎮 Advance Progression (The Controller) --}}
                    <div class="bg-amber-50 dark:bg-amber-950/10 rounded-[2.5rem] p-8 border border-amber-100 dark:border-amber-900/30 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-600 italic">Kitchen Status</h3>
                            {{-- Check for current status from OrderVendor --}}
                            @php
                                $vendorOrder = $order->vendors->where('vendor_id', auth('vendor')->id())->first();
                                $currentStatus = $vendorOrder ? $vendorOrder->status : $order->status;
                            @endphp
                            <span class="text-[8px] font-black uppercase px-2 py-1 bg-amber-500 text-white rounded">{{ $currentStatus }}</span>
                        </div>

                        <form action="{{ route('vendor.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="relative">
                                <select name="status" class="w-full appearance-none bg-white dark:bg-zinc-800 border-none rounded-2xl py-5 px-6 text-xs font-black uppercase tracking-widest text-slate-700 dark:text-zinc-300 focus:ring-2 focus:ring-amber-500 cursor-pointer shadow-inner">
                                    <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                    <option value="accepted" {{ $currentStatus == 'accepted' ? 'selected' : '' }}>Accept Mission</option>
                                    <option value="preparing" {{ $currentStatus == 'preparing' ? 'selected' : '' }}>In Preparation</option>
                                    <option value="delivered" {{ $currentStatus == 'delivered' ? 'selected' : '' }}>Ready for Pickup</option>
                                    <option value="cancelled" {{ $currentStatus == 'cancelled' ? 'selected' : '' }}>Abort Mission</option>
                                </select>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-5 bg-slate-900 hover:bg-black text-white rounded-3xl font-black uppercase tracking-[0.2em] text-[10px] shadow-xl transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                                Update Progression
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2.5"/></svg>
                            </button>
                        </form>
                    </div>

                    {{-- 💳 Payment Overview --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 italic">Billing Protocol</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-xs font-bold text-slate-500">
                                <span>Method</span>
                                <span class="uppercase text-slate-800 dark:text-white">{{ $order->payment->payment_method ?? 'COD' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs font-bold text-slate-500">
                                <span>Tax Status</span>
                                <span class="text-emerald-500">PAID (GST 9%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-vendor-layout>
