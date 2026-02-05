<x-customer-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 rotate-3">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Safari Pantry</h2>
                <p class="text-slate-500 text-sm font-medium">Provisioning your next expedition</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                {{-- ================= MENU SECTION (LEFT) ================= --}}
                <div class="lg:col-span-8 space-y-8">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 italic">Available Tracks</h3>
                        <span class="text-[10px] font-bold text-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1 rounded-full uppercase">{{ $foods->count() }} Bites Spotted</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($foods as $food)
                            <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-6 border border-slate-100 dark:border-zinc-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group">
                                <div class="flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1">
                                            <h4 class="text-xl font-black text-slate-800 dark:text-zinc-100 italic group-hover:text-indigo-600 transition-colors">{{ $food->name }}</h4>
                                            <p class="text-xs text-slate-400 font-medium mt-2 line-clamp-2 italic leading-relaxed">"{{ $food->description ?? 'A wild taste experience.' }}"</p>
                                        </div>
                                    </div>

                                    <div class="mt-auto pt-6 flex items-center justify-between border-t border-slate-50 dark:border-zinc-800">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bounty</span>
                                            <span class="text-2xl font-black text-slate-900 dark:text-white italic tracking-tighter">₹{{ number_format($food->price, 0) }}</span>
                                        </div>

                                        <form method="POST" action="{{ route('customer.cart.add', $food->id) }}" class="cart-action">
                                            @csrf
                                            <button type="submit" class="w-12 h-12 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-100 transition-all active:scale-90 group/btn">
                                                <svg class="w-6 h-6 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center opacity-40 italic font-black uppercase tracking-widest text-slate-400">Territory is currently barren.</div>
                        @endforelse
                    </div>
                </div>

                {{-- ================= CART SECTION (RIGHT) ================= --}}
                <div class="lg:col-span-4">
                    @php
                        $total = 0;
                        foreach($cart as $item) {
                            $total += $item['price'] * $item['qty'];
                        }
                    @endphp
                    <div id="cart-section" class="bg-white dark:bg-zinc-900 rounded-[3rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-2xl sticky top-24 overflow-hidden">
                        {{-- Decor --}}
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-sm font-black uppercase tracking-widest text-slate-800 dark:text-white italic">Current Manifest</h3>
                                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2.5"/></svg>
                                </div>
                            </div>

                            <div id="cart-items" class="space-y-6 max-h-[400px] overflow-y-auto no-scrollbar">
                                @forelse($cart as $item)
                                    <div class="flex justify-between items-center group/item cart-item" data-id="{{ $item['food_id'] }}">
                                        <div class="flex-1">
                                            <p class="text-sm font-black text-slate-800 dark:text-zinc-200">{{ $item['name'] }}</p>
                                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-tighter">₹{{ number_format($item['price'] * $item['qty'], 0) }}</p>
                                        </div>

                                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-zinc-800 p-1.5 rounded-xl border border-slate-100 dark:border-zinc-700">
                                            <button class="qty-btn decrease w-6 h-6 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 shadow-sm transition-all" data-id="{{ $item['food_id'] }}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4" stroke-width="3"/></svg>
                                            </button>
                                            <span class="text-xs font-black text-slate-800 dark:text-white min-w-[12px] text-center">{{ $item['qty'] }}</span>
                                            <button class="qty-btn increase w-6 h-6 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 shadow-sm transition-all" data-id="{{ $item['food_id'] }}">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
                                            </button>
                                        </div>

                                        <button class="remove-btn ml-4 text-slate-300 hover:text-rose-500 transition-colors" data-id="{{ $item['food_id'] }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5"/></svg>
                                        </button>
                                    </div>
                                @empty
                                    <div class="py-10 text-center opacity-30">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Empty Provisions</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-10 pt-8 border-t-2 border-dashed border-slate-50 dark:border-zinc-800">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Estimated Total</span>
                                    <span id="cart-total" class="text-2xl font-black text-slate-900 dark:text-white italic tracking-tighter">₹{{ number_format($total, 0) }}</span>
                                </div>

                                @if(count($cart))
                                    <form method="POST" action="{{ route('customer.checkout') }}">
                                        @csrf
                                        <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-[2rem] font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] flex items-center justify-center gap-3 group">
                                            <span>Secure Provisions</span>
                                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div id="toast" class="fixed bottom-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-8 py-4 rounded-[2rem] shadow-2xl font-black uppercase tracking-widest text-[10px] hidden z-50 animate-in fade-in slide-in-from-bottom-5">
        Manifest Updated
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast');
            function showToast(message) {
                toast.textContent = message;
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 2500);
            }

            async function cartRequest(url) {
                const token = document.querySelector('input[name="_token"]').value;
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': token, 'Accept': 'application/json'}
                });
                return res.json();
            }

            function updateCartUI(data) {
                const cartItemsDiv = document.getElementById('cart-items');
                let html = '';
                if(data.cart.length){
                    data.cart.forEach(item => {
                        html += `
                            <div class="flex justify-between items-center group/item cart-item" data-id="${item.food_id}">
                                <div class="flex-1">
                                    <p class="text-sm font-black text-slate-800 dark:text-zinc-200">${item.name}</p>
                                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-tighter">₹${(item.price * item.qty).toLocaleString()}</p>
                                </div>
                                <div class="flex items-center gap-3 bg-slate-50 dark:bg-zinc-800 p-1.5 rounded-xl border border-slate-100 dark:border-zinc-700">
                                    <button class="qty-btn decrease w-6 h-6 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 shadow-sm transition-all" data-id="${item.food_id}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4" stroke-width="3"/></svg>
                                    </button>
                                    <span class="text-xs font-black text-slate-800 dark:text-white min-w-[12px] text-center">${item.qty}</span>
                                    <button class="qty-btn increase w-6 h-6 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 shadow-sm transition-all" data-id="${item.food_id}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
                                    </button>
                                </div>
                                <button class="remove-btn ml-4 text-slate-300 hover:text-rose-500 transition-colors" data-id="${item.food_id}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2.5"/></svg>
                                </button>
                            </div>
                        `;
                    });
                } else {
                    html = '<div class="py-10 text-center opacity-30"><p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Empty Provisions</p></div>';
                }
                cartItemsDiv.innerHTML = html;
                document.getElementById('cart-total').textContent = `₹${data.total.toLocaleString()}`;
            }

            document.getElementById('cart-section').addEventListener('click', async function(e){
                const target = e.target.closest('button');
                if(!target) return;

                const id = target.dataset.id;
                let url = '';

                if(target.classList.contains('increase')) url = `/customer/cart/increase/${id}`;
                else if(target.classList.contains('decrease')) url = `/customer/cart/decrease/${id}`;
                else if(target.classList.contains('remove-btn')) url = `/customer/cart/remove/${id}`;
                else return;

                const data = await cartRequest(url);
                if(data.success) {
                    updateCartUI(data);
                    showToast('Manifest Updated');
                }
            });

            document.querySelectorAll('.cart-action').forEach(form => {
                form.addEventListener('submit', async function(e){
                    e.preventDefault();
                    const data = await cartRequest(this.action);
                    if(data.success) {
                        updateCartUI(data);
                        showToast('Securely Added');
                    }
                });
            });
        });
    </script>
</x-customer-layout>
