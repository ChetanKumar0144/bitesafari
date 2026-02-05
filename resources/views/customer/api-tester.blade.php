<x-customer-layout>
    <div class="py-10 space-y-10">
        {{-- Header Section --}}
        <div class="bg-slate-900 rounded-[3rem] p-10 text-white shadow-2xl relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <h2 class="text-3xl font-black italic tracking-tighter uppercase">Full API Command Center</h2>
                    <p class="text-indigo-400 text-[10px] font-black uppercase tracking-[0.4em] mt-2">BiteSafari Protocol V1.0</p>
                </div>
                <div class="flex flex-wrap gap-4 justify-center">
                    <input type="text" id="api-domain" class="bg-white/10 border-white/10 rounded-2xl text-[10px] font-bold px-4 py-3 w-64 focus:bg-white focus:text-slate-900 transition-all" placeholder="Domain URL">
                    <input type="text" id="api-token" class="bg-white/10 border-white/10 rounded-2xl text-[10px] font-bold px-4 py-3 w-64 focus:bg-white focus:text-slate-900 transition-all" placeholder="Bearer Token">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            {{-- Endpoint Sidebar --}}
            <div class="lg:col-span-4 space-y-6 h-[80vh] overflow-y-auto no-scrollbar pr-2">

                {{-- 1. AUTH & PROFILE --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2 italic">Identity & Access</p>
                    <div class="space-y-1">
                        <button onclick="setEndpoint('POST', 'v1/customer/send-otp', {email: 'chetan@gmail.com'})" class="w-full text-left p-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Send OTP</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                        <button onclick="setEndpoint('POST', 'v1/customer/verify-otp', {email: 'chetan@gmail.com', otp: '123456'})" class="w-full text-left p-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Verify OTP</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                        <button onclick="setEndpoint('GET', 'v1/customer/me')" class="w-full text-left p-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Get Profile (Me)</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                        <button onclick="setEndpoint('GET', 'v1/customer/profile')" class="w-full text-left p-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Full Profile</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                        <button onclick="setEndpoint('POST', 'v1/customer/logout')" class="w-full text-left p-3 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all text-xs font-bold flex justify-between items-center group">
                            <span class="group-hover:text-rose-600">Logout</span> <span class="text-[9px] bg-rose-500/10 text-rose-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                    </div>
                </div>

                {{-- 2. DISCOVERY (Foods & Cats) --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2 italic">Discovery</p>
                    <div class="space-y-1">
                        <button onclick="setEndpoint('GET', 'v1/foods')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>All Foods</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                        <button onclick="setEndpoint('GET', 'v1/categories')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Categories</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                    </div>
                </div>

                {{-- 3. ADDRESSES (CRUD) --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2 italic">Nest Logistics (Addresses)</p>
                    <div class="space-y-1">
                        <button onclick="setEndpoint('GET', 'v1/customer/addresses')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Fetch All Addresses</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                        <button onclick="setEndpoint('POST', 'v1/customer/addresses', {label: 'Home', address_line1: '123 Safari St', city: 'Pune', postal_code: '411001', country: 'India'})" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Add New Address</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                        <button onclick="setEndpoint('POST', 'v1/customer/addresses/3', {label: 'Updated Office'})" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Update Address (ID:3)</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                        <button onclick="setEndpoint('DELETE', 'v1/customer/addresses/1')" class="w-full text-left p-3 hover:bg-rose-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center group">
                            <span class="group-hover:text-rose-600">Delete Address</span> <span class="text-[9px] bg-rose-500/10 text-rose-600 px-2 py-0.5 rounded">DEL</span>
                        </button>
                    </div>
                </div>

                {{-- 4. ORDERS --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2 italic">Orders</p>
                    <div class="space-y-1">
                        <button onclick="setEndpoint('GET', 'v1/customer/orders')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Order History</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>
                        <button onclick="setEndpoint('POST', 'v1/customer/orders', {items: [{food_id: 3, quantity: 2}], address_id: 2, payment_method: 'cod'})" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Place Multi-vendor Order</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                    </div>
                </div>

                {{-- 5. CART (Updated) --}}
                <div class="bg-white dark:bg-zinc-900 rounded-[2.5rem] p-5 border border-slate-100 dark:border-zinc-800 shadow-sm">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-2 italic">Safari Manifest (Cart)</p>
                    <div class="space-y-1">
                        {{-- Index --}}
                        <button onclick="setEndpoint('GET', 'v1/customer/cart')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>View Cart</span> <span class="text-[9px] bg-indigo-500/10 text-indigo-600 px-2 py-0.5 rounded">GET</span>
                        </button>

                        {{-- Add Item --}}
                        <button onclick="setEndpoint('POST', 'v1/customer/cart/add', {food_id: 3, quantity: 1})" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Add to Cart</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>

                        {{-- Update Quantity --}}
                        <button onclick="setEndpoint('POST', 'v1/customer/cart/update/1', {quantity: 5})" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Update Qty (ID:1)</span> <span class="text-[9px] bg-emerald-500/10 text-emerald-600 px-2 py-0.5 rounded">POST</span>
                        </button>

                        {{-- Remove Item --}}
                        <button onclick="setEndpoint('DELETE', 'v1/customer/cart/remove/1')" class="w-full text-left p-3 hover:bg-rose-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center group">
                            <span class="group-hover:text-rose-600">Remove Item</span> <span class="text-[9px] bg-rose-500/10 text-rose-600 px-2 py-0.5 rounded">DEL</span>
                        </button>

                        {{-- Clear Cart --}}
                        <button onclick="setEndpoint('DELETE', 'v1/customer/cart/clear')" class="w-full text-left p-3 hover:bg-rose-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center group">
                            <span class="group-hover:text-rose-600">Clear All</span> <span class="text-[9px] bg-rose-500/10 text-rose-600 px-2 py-0.5 rounded">DEL</span>
                        </button>

                        {{-- Decrement Item --}}
                        <button onclick="setEndpoint('POST', 'v1/customer/cart/decrement/1')" class="w-full text-left p-3 hover:bg-indigo-50 rounded-xl transition-all text-xs font-bold flex justify-between items-center">
                            <span>Decrement Qty (ID:1)</span> <span class="text-[9px] bg-amber-500/10 text-amber-600 px-2 py-0.5 rounded">POST</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Terminal Console --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white dark:bg-zinc-900 rounded-[3rem] p-8 border border-slate-100 dark:border-zinc-800 shadow-sm min-h-[600px] flex flex-col">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-3">
                            <span id="method-tag" class="px-3 py-1 bg-slate-900 text-white rounded-lg text-[10px] font-black uppercase tracking-widest">GET</span>
                            <h3 id="display-path" class="text-xs font-mono font-bold text-slate-500 tracking-tighter italic">v1/foods</h3>
                        </div>
                        <div id="status-pill" class="text-[9px] font-black uppercase px-4 py-1.5 rounded-full bg-slate-100 text-slate-400">Idle</div>
                    </div>

                    <div class="space-y-6 flex-grow">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Request Body (JSON)</p>
                            <textarea id="payload-input" rows="6" class="w-full bg-slate-50 dark:bg-zinc-800 border-none rounded-3xl p-6 text-[11px] font-mono focus:ring-2 focus:ring-indigo-500 text-slate-700 dark:text-zinc-200" placeholder="{}"></textarea>
                        </div>

                        <button onclick="runExpedition()" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-[2rem] font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-indigo-100 transition-all active:scale-95 flex items-center justify-center gap-4">
                            <span>Transmit Signal</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>

                        <div class="pt-6 border-t border-slate-50 dark:border-zinc-800 flex flex-col h-full">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Telemetry Response</p>
                            <pre id="response-box" class="flex-grow w-full bg-slate-900 text-emerald-400 rounded-[2rem] p-8 text-[11px] font-mono overflow-auto leading-relaxed shadow-inner min-h-[300px]">Waiting for expedition results...</pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set default domain
        document.getElementById('api-domain').value = window.location.origin + '/api/';

        function setEndpoint(method, path, payload = null) {
            document.getElementById('method-tag').innerText = method;
            document.getElementById('display-path').innerText = path;
            document.getElementById('payload-input').value = payload ? JSON.stringify(payload, null, 2) : '{}';
            document.getElementById('response-box').innerText = 'System primed. Ready to transmit.';
        }

        async function runExpedition() {
            const domain = document.getElementById('api-domain').value;
            const path = document.getElementById('display-path').innerText;
            const method = document.getElementById('method-tag').innerText;
            const token = document.getElementById('api-token').value;
            const payloadInput = document.getElementById('payload-input').value;

            const responseBox = document.getElementById('response-box');
            const statusPill = document.getElementById('status-pill');

            responseBox.innerText = 'Transmitting signal...';
            statusPill.innerText = 'Active';
            statusPill.className = 'text-[9px] font-black uppercase px-4 py-1.5 rounded-full bg-amber-500 text-white animate-pulse';

            try {
                const config = {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': token ? `Bearer ${token}` : ''
                    }
                };

                // Faqat GET requests mein body nahi jayegi
                if (method !== 'GET') {
                    config.body = payloadInput;
                }

                const res = await fetch(domain + path, config);
                const data = await res.json();

                statusPill.innerText = `Status ${res.status}`;
                statusPill.className = res.ok ?
                    'text-[9px] font-black uppercase px-4 py-1.5 rounded-full bg-emerald-500 text-white' :
                    'text-[9px] font-black uppercase px-4 py-1.5 rounded-full bg-rose-500 text-white';

                responseBox.innerText = JSON.stringify(data, null, 2);

                // Auto-token sync
                if (data.token || (data.data && data.data.token)) {
                    const newToken = data.token || data.data.token;
                    document.getElementById('api-token').value = newToken;
                    // Native alert for developer experience
                    console.log("Telemetry Alert: New token secured.");
                }

            } catch (err) {
                responseBox.innerText = 'Critical Error: ' + err.message;
                statusPill.innerText = 'Signal Lost';
                statusPill.className = 'text-[9px] font-black uppercase px-4 py-1.5 rounded-full bg-rose-500 text-white';
            }
        }
    </script>
</x-customer-layout>
