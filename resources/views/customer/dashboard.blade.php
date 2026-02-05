<x-customer-layout>
    <div class="space-y-10 py-6">

        {{-- 1. SEARCH & GREETING --}}
        <div class="relative overflow-hidden bg-slate-900 rounded-[3rem] p-8 lg:p-12 text-white shadow-2xl">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-black tracking-tight italic mb-2">
                        Happy Safari, <span class="text-indigo-400">{{ explode(' ', auth('customer')->user()->name)[0] }}!</span>
                    </h1>
                    <p class="text-slate-400 font-medium tracking-wide">Ready for today's track?</p>
                </div>

                <div class="w-full md:w-1/3 relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="search"
                        class="w-full pl-12 pr-6 py-4 bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:text-slate-900 transition-all font-bold placeholder-slate-500"
                        placeholder="Search for bites...">
                </div>
            </div>
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        </div>

        {{-- 2. CATEGORY TRACKS --}}
        <div class="space-y-4">
            <h3 class="px-2 text-xs font-black uppercase tracking-[0.3em] text-slate-400 italic">Expedition Categories</h3>
            <div id="categories" class="flex gap-4 overflow-x-auto pb-4 no-scrollbar scroll-smooth">
                {{-- Loaded via AJAX --}}
            </div>
        </div>

        {{-- 3. FOOD GRID --}}
        <div id="foods" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            {{-- Loaded via AJAX --}}
        </div>
    </div>

    {{-- Global Cart Indicator (Floating) --}}
    <div id="cart-float" class="fixed bottom-8 right-8 z-50 hidden">
        <a href="" class="flex items-center gap-3 px-6 py-4 bg-slate-900 text-white rounded-3xl shadow-2xl hover:scale-105 transition-all border border-indigo-500/30">
            <div class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="2.5"/></svg>
                <span id="cart-count" class="absolute -top-2 -right-2 w-5 h-5 bg-indigo-500 text-[10px] font-black rounded-full flex items-center justify-center border-2 border-slate-900">0</span>
            </div>
            <span class="text-xs font-black uppercase tracking-widest italic">View Manifest</span>
        </a>
    </div>

    <script>
        $(document).ready(function () {
            loadCategories();
            loadFoods();

            $('#search').on('keyup', function () {
                let catId = $('.category-btn.active-category').data('id') || '';
                loadFoods($(this).val(), catId);
            });
        });

        function loadCategories() {
            $.ajax({
                url: "{{ route('api.categories.index') }}",
                type: 'GET',
                success: function (res) {
                    let html = `<button class="category-btn active-category shrink-0 px-8 py-3 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-200 transition-all" data-id="">All Tracks</button>`;
                    if (res.status === true) {
                        $.each(res.data, function (i, cat) {
                            html += `<button class="category-btn shrink-0 px-8 py-3 bg-white dark:bg-zinc-900 text-slate-500 border border-slate-100 dark:border-zinc-800 rounded-2xl text-xs font-black uppercase tracking-widest hover:border-indigo-400 transition-all" data-id="${cat.id}">${cat.name}</button>`;
                        });
                    }
                    $('#categories').html(html);
                }
            });
        }

        $(document).on('click', '.category-btn', function () {
            $('.category-btn').removeClass('bg-indigo-600 text-white active-category shadow-lg shadow-indigo-200').addClass('bg-white dark:bg-zinc-900 text-slate-500 border border-slate-100 dark:border-zinc-800');
            $(this).addClass('bg-indigo-600 text-white active-category shadow-lg shadow-indigo-200').removeClass('bg-white dark:bg-zinc-900 text-slate-500 border border-slate-100 dark:border-zinc-800');
            loadFoods($('#search').val(), $(this).data('id'));
        });

        function loadFoods(search = '', category_id = '') {
            $.ajax({
                url: "{{ route('api.foods.index') }}",
                type: 'GET',
                data: { search: search, category_id: category_id },
                beforeSend: function () {
                    $('#foods').html('<div class="col-span-full py-20 text-center text-slate-400 font-black uppercase tracking-widest animate-pulse italic tracking-[0.3em]">Scanning Territory...</div>');
                },
                success: function (res) {
                    let html = '';
                    if (!res.success || res.foods.length === 0) {
                        $('#foods').html('<div class="col-span-full py-20 text-center italic text-slate-400 uppercase tracking-widest">No tracks found.</div>');
                        return;
                    }

                    $.each(res.foods, function (i, food) {
                        html += `
                            <div class="group bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-slate-100 dark:border-zinc-800 overflow-hidden hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 flex flex-col h-full">
                                <div class="relative h-48 overflow-hidden shrink-0">
                                    <img src="${food.image}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/90 backdrop-blur-md text-slate-900 text-[10px] font-black px-3 py-1.5 rounded-xl flex items-center gap-1 uppercase">
                                            <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            ${food.rating}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-lg font-black text-slate-800 dark:text-zinc-100 truncate italic">${food.name}</h3>
                                    <p class="text-slate-400 text-[11px] font-medium line-clamp-2 mt-1 leading-relaxed italic">"${food.description || 'A wild taste.'}"</p>
                                    <div class="mt-auto pt-6 border-t border-slate-50 dark:border-zinc-800">
                                        <div class="flex items-center justify-between gap-4 mb-4">
                                            <span class="text-xl font-black text-slate-900 dark:text-white italic tracking-tighter">₹${food.price}</span>
                                            <div class="flex items-center gap-2 bg-slate-50 dark:bg-zinc-800 p-1 rounded-xl border border-slate-100 dark:border-zinc-700">
                                                <button class="w-7 h-7 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 transition-all decrement" data-id="${food.id}"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 12H4" stroke-width="3"/></svg></button>
                                                <input type="text" readonly value="0" id="qty-${food.id}" class="w-8 text-center bg-transparent border-none text-xs font-black text-slate-800 dark:text-zinc-200 p-0 focus:ring-0">
                                                <button class="w-7 h-7 flex items-center justify-center bg-white dark:bg-zinc-900 rounded-lg text-slate-400 hover:text-indigo-600 transition-all increment" data-id="${food.id}"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg></button>
                                            </div>
                                        </div>
                                        <button class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black uppercase tracking-widest text-[9px] shadow-lg shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98] add-cart" data-id="${food.id}">Secure Bite</button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#foods').html(html);
                }
            });
        }

        $(document).on('click', '.increment', function () {
            let input = $(`#qty-${$(this).data('id')}`);
            input.val(parseInt(input.val()) + 1);
        });

        $(document).on('click', '.decrement', function () {
            let input = $(`#qty-${$(this).data('id')}`);
            let val = parseInt(input.val());
            if(val > 0) input.val(val - 1);
        });

        $(document).on('click', '.add-cart', function () {
            let id = $(this).data('id');
            let qty = parseInt($(`#qty-${id}`).val());
            if(qty <= 0) return alert('Specify quantity!');

            $.ajax({
                url: "{{ route('customer.cart.add', '') }}/" + id,
                type: 'POST',
                data: { quantity: qty, _token: '{{ csrf_token() }}' },
                success: function (res) {
                    $('#cart-float').removeClass('hidden');
                    $('#cart-count').text(res.cart_count || '!');
                    $(`#qty-${id}`).val(0);
                }
            });
        });
    </script>
</x-customer-layout>
