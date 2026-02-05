<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-amber-500 rounded-[1.5rem] flex items-center justify-center shadow-2xl shadow-amber-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">New Recipe</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Drafting a fresh Safari Bite</p>
                </div>
            </div>

            <a href="{{ route('vendor.foods.index') }}"
                class="px-8 py-4 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-3 font-black shadow-sm active:scale-95 text-[10px] uppercase tracking-widest italic">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Kitchen
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white dark:bg-zinc-900 shadow-[0_30px_60px_rgba(0,0,0,0.05)] border border-slate-100 dark:border-zinc-800 rounded-[3rem] overflow-hidden">

            {{-- Safari Progress Line --}}
            <div class="h-2 bg-gradient-to-r from-amber-400 via-amber-500 to-emerald-500"></div>

            <form action="{{ route('vendor.foods.store') }}" method="POST" enctype="multipart/form-data" class="p-10 lg:p-16 space-y-12">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                    {{-- Left Side: Identity & Math --}}
                    <div class="lg:col-span-7 space-y-10">
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-8 italic">Bite Configuration</h3>

                            <div class="space-y-8">
                                {{-- Name --}}
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Dish Title</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500/20 focus:bg-white dark:focus:bg-zinc-950 rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-bold text-lg focus:ring-0 shadow-inner"
                                        placeholder="e.g. Signature Safari Burger" />
                                    @error('name')<span class="text-rose-500 text-[10px] font-black mt-2 ml-2 block uppercase">{{ $message }}</span>@enderror
                                </div>

                                {{-- Price & Quantity --}}
                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Market Price (₹)</label>
                                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" required
                                            class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black text-xl shadow-inner" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Initial Stock</label>
                                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" required
                                            class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black text-xl shadow-inner" />
                                    </div>
                                </div>

                                {{-- Custom Category Select (Alpine.js) --}}
                                <div class="space-y-2" x-data="{ open: false, selected: 'Select Classification', selectedId: '' }">
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

                                        <div x-show="open" x-cloak x-transition class="absolute z-50 w-full mt-3 bg-white dark:bg-zinc-900 border border-slate-100 dark:border-zinc-800 rounded-[1.5rem] shadow-2xl py-3 max-h-60 overflow-y-auto">
                                            @foreach($categories as $category)
                                                <div @click="selected = '{{ $category->name }}'; selectedId = '{{ $category->id }}'; open = false"
                                                     class="px-6 py-4 text-xs font-black uppercase tracking-widest cursor-pointer hover:bg-amber-50 dark:hover:bg-amber-950/20 hover:text-amber-500 transition-all flex items-center justify-between">
                                                    <span>{{ $category->name }}</span>
                                                    <template x-if="selectedId == '{{ $category->id }}'">
                                                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                    </template>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('category_id')<span class="text-rose-500 text-[10px] font-black mt-2 ml-2 block uppercase">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Side: Media --}}
                    <div class="lg:col-span-5 space-y-10">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-8 italic">Presentation</h3>

                        {{-- Image Dropzone --}}
                        <div class="relative group">
                            <div class="relative h-80 rounded-[2.5rem] border-4 border-dashed border-slate-200 dark:border-zinc-800 hover:border-amber-500 transition-all bg-slate-50 dark:bg-zinc-800/30 flex items-center justify-center overflow-hidden shadow-inner">
                                <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(event)" />

                                <div id="placeholder-content" class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-2xl shadow-xl flex items-center justify-center text-amber-500 mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2"/></svg>
                                    </div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">Capture Plate</p>
                                </div>

                                <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-10" />
                            </div>
                            @error('image')<span class="text-rose-500 text-[10px] font-black mt-4 block text-center uppercase tracking-widest">{{ $message }}</span>@enderror
                        </div>

                        {{-- Story --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Menu Narrative</label>
                            <textarea name="description" rows="5"
                                class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-medium focus:ring-2 focus:ring-amber-500 resize-none shadow-inner italic"
                                placeholder="What makes this dish unique?">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="pt-12 flex flex-col sm:flex-row gap-6 border-t border-slate-50 dark:border-zinc-800">
                    <button type="submit"
                        class="flex-[2] py-6 bg-slate-900 dark:bg-amber-500 hover:bg-black dark:hover:bg-amber-600 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl transition-all active:scale-95 flex justify-center items-center gap-4 group">
                        <span>Publish New Bite</span>
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                    <a href="{{ route('vendor.foods.index') }}"
                        class="flex-1 py-6 bg-slate-100 dark:bg-zinc-800 text-slate-400 dark:text-zinc-500 rounded-[2rem] font-black text-[10px] uppercase tracking-widest text-center hover:bg-slate-200 transition-all flex items-center justify-center italic">
                        Discard Draft
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event){
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-content');
            const file = event.target.files[0];
            if(file){
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }
    </script>
</x-vendor-layout>
