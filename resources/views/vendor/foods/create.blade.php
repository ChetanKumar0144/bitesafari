<x-vendor-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        New Recipe
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Register a new dish to your kitchen</p>
            </div>

            <a href="{{ route('vendor.foods.index') }}"
               class="px-5 py-2.5 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-2 font-bold shadow-sm active:scale-95 text-sm uppercase tracking-widest">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Menu List
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] overflow-hidden">

                {{-- Top Visual Bar --}}
                <div class="h-2 bg-gradient-to-r from-amber-400 via-amber-500 to-emerald-500"></div>

                <form action="{{ route('vendor.foods.store') }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                        {{-- Left Column: Info --}}
                        <div class="lg:col-span-7 space-y-8">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-amber-600 mb-4 italic">Bite Details</h3>

                            {{-- Food Name --}}
                            <div class="group">
                                <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Dish Title</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm"
                                    placeholder="e.g. Spiced Safari Wrap" />
                                @error('name')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                {{-- Price --}}
                                <div>
                                    <label for="price" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Price (₹)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black"
                                        placeholder="0.00" />
                                </div>
                                {{-- Quantity --}}
                                <div>
                                    <label for="quantity" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Initial Stock</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black"
                                        placeholder="10" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                {{-- Category --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Classification</label>
                                    <select name="category_id" class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl text-sm font-bold text-slate-600 dark:text-zinc-300 focus:ring-2 focus:ring-amber-500 cursor-pointer">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Rating --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Initial Rating</label>
                                    <input type="number" name="rating" id="rating" value="{{ old('rating', 4.5) }}" step="0.1" min="0" max="5"
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-black" />
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Media --}}
                        <div class="lg:col-span-5 space-y-6 flex flex-col">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-amber-600 mb-4 italic">Presentation</h3>

                            {{-- Image Dropzone --}}
                            <div class="relative flex-1 group">
                                <div class="relative h-64 lg:h-full min-h-[300px] border-2 border-dashed border-slate-200 dark:border-zinc-700 hover:border-amber-500 dark:hover:border-amber-500 rounded-[2rem] transition-all bg-slate-50 dark:bg-zinc-800/50 flex flex-col items-center justify-center overflow-hidden shadow-inner">
                                    <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20" onchange="previewImage(event)" />

                                    <div id="placeholder-content" class="flex flex-col items-center group-hover:scale-110 transition-transform duration-500">
                                        <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-2xl shadow-xl flex items-center justify-center text-amber-500 mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p class="text-xs font-black uppercase tracking-widest text-slate-500">Upload Plate Shot</p>
                                    </div>

                                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-10" />
                                    <div id="change-hint" class="absolute bottom-4 bg-black/50 backdrop-blur-md text-[10px] text-white font-black uppercase tracking-[0.2em] px-4 py-2 rounded-full hidden z-20">Tap to Change</div>
                                </div>
                                @error('image')<span class="text-rose-500 text-xs font-bold mt-2 block ml-2">{{ $message }}</span>@enderror
                            </div>

                            <div class="mt-4">
                                <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Dish Story</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-2 focus:ring-amber-500 resize-none shadow-inner"
                                    placeholder="Describe the flavors...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-10 flex flex-col sm:flex-row gap-4 border-t border-slate-50 dark:border-zinc-800">
                        <button type="submit"
                            class="flex-[2] py-5 bg-amber-500 hover:bg-amber-600 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-amber-100 dark:shadow-none transition-all active:scale-[0.98] flex justify-center items-center gap-3 group">
                            <span>Publish Bite</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                        <a href="{{ route('vendor.foods.index') }}"
                            class="flex-1 py-5 bg-slate-100 dark:bg-zinc-800 text-slate-500 dark:text-zinc-400 rounded-[2rem] font-bold text-center hover:bg-slate-200 transition-all flex items-center justify-center italic">
                            Discard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event){
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('placeholder-content');
            const hint = document.getElementById('change-hint');
            const file = event.target.files[0];
            if(file){
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                hint.classList.remove('hidden');
            }
        }
    </script>
</x-vendor-layout>
