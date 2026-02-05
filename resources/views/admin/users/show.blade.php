<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200 rotate-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Explorer Profile</h2>
                    <p class="text-slate-500 text-sm font-medium">BiteSafari Member ID: #{{ $customer->id }}</p>
                </div>
            </div>

            <a href="{{ route('users.index') }}"
               class="px-6 py-3 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-[1.5rem] border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-2 font-bold shadow-sm active:scale-95 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- LEFT COLUMN: IDENTITY --}}
                <div class="lg:col-span-4 space-y-8">
                    {{-- Basic Card --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm relative overflow-hidden text-center">
                        <div class="absolute top-0 left-0 w-full h-24 bg-emerald-500/10"></div>
                        <div class="relative pt-4">
                            <div class="w-24 h-24 mx-auto bg-white dark:bg-zinc-800 rounded-3xl flex items-center justify-center text-4xl font-black text-emerald-500 shadow-xl border-4 border-slate-50 dark:border-zinc-900 mb-4">
                                {{ substr($customer->name, 0, 1) }}
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 dark:text-white leading-tight">{{ $customer->name }}</h3>
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mt-2 italic">Active Explorer</p>
                        </div>

                        <div class="mt-8 space-y-4 text-left">
                            <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-zinc-800/50 rounded-2xl border border-slate-100 dark:border-zinc-800">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 100-4H5a2 2 0 100 4z"/></svg>
                                <span class="text-sm font-bold text-slate-600 dark:text-zinc-300 truncate">{{ $customer->email ?? 'no-email@bitesafari.com' }}</span>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-zinc-800/50 rounded-2xl border border-slate-100 dark:border-zinc-800">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-sm font-bold text-slate-600 dark:text-zinc-300">{{ $customer->phone }}</span>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-50 dark:border-zinc-800">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Onboarding Date</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 italic">{{ $customer->created_at->format('d F, Y • h:i A') }}</p>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: ACTIVITY & NESTS --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- ADDRESSES (NESTS) --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Safari Nests (Delivery Points)</h3>
                            <span class="px-4 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-[10px] font-black uppercase">
                                {{ $customer->addresses->count() }} Points
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($customer->addresses as $address)
                                <div class="p-6 bg-slate-50 dark:bg-zinc-800/50 rounded-[2rem] border border-slate-100 dark:border-zinc-800 group hover:border-emerald-500 transition-all duration-300">
                                    <div class="flex items-center gap-3 mb-3 text-emerald-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="text-sm font-black uppercase tracking-widest text-slate-800 dark:text-zinc-100 group-hover:text-emerald-500 transition-colors">{{ $address->label }}</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500 dark:text-zinc-400 leading-relaxed italic">
                                        {{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}
                                    </p>
                                </div>
                            @empty
                                <div class="col-span-2 py-10 text-center bg-slate-50 dark:bg-zinc-800 rounded-[2rem] border-2 border-dashed border-slate-200 dark:border-zinc-700">
                                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">No delivery coordinates found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ORDERS HISTORY --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Order Manifest</h3>
                            <span class="px-4 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full text-[10px] font-black uppercase">
                                Total {{ $customer->orders->count() }} Expeditions
                            </span>
                        </div>

                        <div class="space-y-4">
                            @forelse($customer->orders as $order)
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="group flex items-center justify-between p-5 bg-slate-50 dark:bg-zinc-800/50 rounded-2xl border border-transparent hover:border-indigo-400 hover:bg-white dark:hover:bg-zinc-800 transition-all shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2.5"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-800 dark:text-zinc-100 tracking-tighter">Manifest #{{ $order->order_no ?? $order->id }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $order->created_at->format('d M, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-6">
                                        <span class="text-sm font-black text-slate-900 dark:text-white italic">₹{{ number_format($order->total_amount, 0) }}</span>
                                        <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </div>
                                </a>
                            @empty
                                <div class="py-10 text-center">
                                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">No Order History Found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
