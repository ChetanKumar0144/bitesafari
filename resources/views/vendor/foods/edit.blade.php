<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-amber-500 rounded-[1.5rem] flex items-center justify-center shadow-2xl shadow-amber-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Refine Recipe</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Modifying: <span class="text-amber-500 italic">{{ $food->name }}</span></p>
                </div>
            </div>

            <a href="{{ route('vendor.foods.index') }}"
                class="px-8 py-4 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-3 font-black shadow-sm active:scale-95 text-[10px] uppercase tracking-widest italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Wild
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white dark:bg-zinc-900 shadow-[0_30px_60px_rgba(0,0,0,0.05)] border border-slate-100 dark:border-zinc-800 rounded-[3rem] overflow-hidden">

            {{-- Dynamic Progress Bar --}}
            <div class="h-2.5 bg-gradient-to-r {{ $food->quantity > 0 ? 'from-emerald-400 to-emerald-600' : 'from-rose-400 to-rose-600' }} animate-pulse"></div>

            {{-- Action: POST only, no PUT method --}}
            <form action="{{ route('vendor.foods.update', $food) }}" method="POST" enctype="multipart/form-data" class="p-10 lg:p-16 space-y-12">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                    {{-- Left Side: Identity --}}
                    <div class="lg:col-span-7 space-y-10">
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-8 italic">Dish Configuration</h3>

                            <div class="space-y-8">
                                {{-- Name --}}
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Dish Identity</label>
                                    <input type="text" name="name" value="{{ old('name', $food->name) }}" required
                                        class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500/20 focus:bg-white dark:focus:bg-zinc-950 rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-bold text-lg focus:ring-0 shadow-inner" />
                                </div>

                                {{-- Price & Stock --}}
                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Market Price (₹)</label>
                                        <input type="number" name="price" value="{{ old('price', $food->price) }}" step="0.01" required
                                            class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black text-xl shadow-inner" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">In-Stock Count</label>
                                        <input type="number" name="quantity" value="{{ old('quantity', $food->quantity) }}" required
                                            class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black text-xl shadow-inner" />
                                    </div>
                                </div>

                                {{-- Custom Category Select --}}
                                <div class="space-y-2" x-data="{
                                    open: false,
                                    selected: '{{ $food->category->name ?? 'Select Classification' }}',
                                    selectedId: '{{ $food->category_id }}'
                                }">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Classification</label>
                                    <div class="relative">
                                        <button type="button" @click="open = !open" @click.away="open = false"
                                            class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] text-sm font-black text-slate-800 dark:text-white flex items-center justify-between shadow-inner italic">
                                            <span x-text="selected"></span>
                                            <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 9l-7 7-7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <input type="hidden" name="category_id" :value="selectedId">
                                        <div x-show="open" x-cloak x-transition class="absolute z-50 w-full mt-3 bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-[1.5rem] shadow-2xl py-3 overflow-hidden">
                                            <div class="max-h-60 overflow-y-auto custom-scrollbar">
                                                @foreach($categories as $category)
                                                    <div @click="selected = '{{ $category->name }}'; selectedId = '{{ $category->id }}'; open = false"
                                                        class="px-6 py-4 text-xs font-black uppercase tracking-widest cursor-pointer transition-all flex items-center justify-between hover:bg-amber-50 dark:hover:bg-amber-950/20 hover:text-amber-500"
                                                        :class="selectedId == '{{ $category->id }}' ? 'text-amber-500 bg-amber-50/20' : 'text-slate-500'">
                                                        <span x-text="'{{ $category->name }}'"></span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Side: Visuals --}}
                    <div class="lg:col-span-5 space-y-10">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-8 italic">Dish Presentation</h3>

                        <div class="relative group">
                            <div class="relative h-80 rounded-[2.5rem] overflow-hidden border-8 border-slate-50 dark:border-zinc-800 shadow-2xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center">
                                <img id="image-preview"
                                     src="{{ $food->image ? asset($food->image) : '#' }}"
                                     class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 {{ !$food->image ? 'hidden' : '' }}" />

                                <div id="preview-svg" class="flex flex-col items-center text-slate-300 {{ $food->image ? 'hidden' : '' }}">
                                    <svg class="w-20 h-20 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>

                                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col items-center justify-center text-white cursor-pointer">
                                    <div class="w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-width="2"/></svg>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-[0.3em]">Swap Photography</span>
                                    <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(event)" />
                                </div>
                            </div>
                            @error('image')<span class="text-rose-500 text-[10px] font-black mt-4 block text-center uppercase tracking-widest">{{ $message }}</span>@enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Menu Narrative</label>
                            <textarea name="description" rows="5"
                                class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-medium focus:ring-2 focus:ring-amber-500 resize-none shadow-inner italic"
                                placeholder="Describe the essence of this bite...">{{ old('description', $food->description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="pt-12 flex flex-col sm:flex-row gap-6 border-t border-slate-50 dark:border-zinc-800">
                    <button type="submit"
                        class="flex-[2] py-6 bg-slate-900 dark:bg-amber-500 hover:bg-black dark:hover:bg-amber-600 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl transition-all active:scale-95 flex justify-center items-center gap-4 group">
                        <span>Push Updates to Kitchen</span>
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                    <a href="{{ route('vendor.foods.index') }}"
                        class="flex-1 py-6 bg-slate-100 dark:bg-zinc-800 text-slate-400 dark:text-zinc-500 rounded-[2rem] font-black text-[10px] uppercase tracking-widest text-center hover:bg-slate-200 transition-all flex items-center justify-center italic">
                        Cancel Refinement
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event){
            const preview = document.getElementById('image-preview');
            const svg = document.getElementById('preview-svg');
            const file = event.target.files[0];
            if(file){
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                if(svg) svg.classList.add('hidden');
            }
        }
    </script>
</x-vendor-layout>
