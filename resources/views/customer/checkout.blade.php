{{-- customer/checkout.blade.php --}}
<x-customer-layout>
    <div class="py-10 max-w-5xl mx-auto space-y-12">
        <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic px-4 text-center">Establish Base Camp</h2>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            {{-- Address Selection (from API) --}}
            <div class="lg:col-span-7 space-y-6">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 px-4">Delivery Coordinates</h3>
                <div id="address-list" class="space-y-4 px-4">
                    {{-- Addresses will be loaded via AJAX from api.customer.addresses.index --}}
                </div>
                <button onclick="openAddressModal()" class="w-full mt-4 py-4 border-2 border-dashed border-slate-200 dark:border-zinc-800 rounded-3xl text-slate-400 font-bold uppercase text-[10px] tracking-widest hover:border-indigo-500 hover:text-indigo-500 transition-all">+ Establish New Nest</button>
            </div>

            {{-- Summary & Confirm (to api.customer.orders.store) --}}
            <div class="lg:col-span-5 px-4">
                <div class="bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl sticky top-24 overflow-hidden">
                    <h3 class="text-xl font-black italic text-indigo-400 mb-8">Manifest Summary</h3>

                    <div id="checkout-items" class="space-y-4 mb-8">
                        {{-- Items from Session Cart --}}
                    </div>

                    <div class="pt-8 border-t border-white/10 space-y-6">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-black uppercase tracking-[0.2em] text-slate-400">Total Bounty</span>
                            <span class="text-3xl font-black italic tracking-tighter">₹{{ number_format($total, 0) }}</span>
                        </div>
                        <button onclick="placeOrder()" class="w-full py-5 bg-indigo-500 hover:bg-indigo-600 text-white rounded-[2rem] font-black uppercase tracking-widest text-[10px] shadow-xl transition-all active:scale-95">Confirm Expedition</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Use your API routes here to fetch addresses and submit the order
        function placeOrder() {
            let addressId = $('input[name="address_id"]:checked').val();
            if(!addressId) return alert('Select your delivery nest!');

            $.ajax({
                url: "{{ route('api.customer.orders.store') }}",
                type: 'POST',
                headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }, // If using Sanctum
                data: { address_id: addressId, payment_method: 'cod' },
                success: function(res) {
                    window.location.href = "{{ route('customer.order.success') }}";
                }
            });
        }
    </script>
</x-customer-layout>
