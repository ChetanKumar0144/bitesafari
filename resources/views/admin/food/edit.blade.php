<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Refine Bite
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Editing: {{ $food->name }}</p>
            </div>

            <a href="{{ route('food.index') }}"
               class="px-5 py-2.5 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-2 font-bold shadow-sm active:scale-95 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Catalogue
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm animate-in fade-in slide-in-from-top-4">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] overflow-hidden">

                <div class="h-2 bg-gradient-to-r from-amber-400 via-emerald-500 to-emerald-600"></div>

                <form action="{{ route('food.update', $food) }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
                    @csrf
                    @method('POST') {{-- Verify if your route is PUT/PATCH then change it accordingly --}}

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                        {{-- Left: Data Entry --}}
                        <div class="lg:col-span-7 space-y-8">

                            <div>
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mb-6">Core Details</h3>
                                <div class="space-y-6">
                                    {{-- Name --}}
                                    <div class="group">
                                        <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Dish Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $food->name) }}" required
                                            class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-emerald-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm" />
                                        @error('name')<span class="text-rose-500 text-xs font-bold mt-2 block ml-2">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-6">
                                        {{-- Price --}}
                                        <div>
                                            <label for="price" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Price (₹)</label>
                                            <input type="number" name="price" id="price" value="{{ old('price', $food->price) }}" step="0.01" required
                                                class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 transition-all text-slate-900 dark:text-white font-black" />
                                        </div>
                                        {{-- Stock --}}
                                        <div>
                                            <label for="quantity" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Stock Count</label>
                                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $food->quantity) }}" required
                                                class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 transition-all text-slate-900 dark:text-white font-black" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mb-6 pt-4 border-t border-slate-50 dark:border-zinc-800">Affiliation</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    {{-- Category --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Category</label>
                                        <select name="category_id" class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl text-sm font-bold text-slate-600 dark:text-zinc-300 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $food->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Vendor --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Vendor/Store</label>
                                        <select name="vendor_id" class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl text-sm font-bold text-slate-600 dark:text-zinc-300 focus:ring-2 focus:ring-emerald-500 cursor-pointer">
                                            <option value="">Select Vendor</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor->id }}" {{ old('vendor_id', $food->vendor_id) == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Visuals --}}
                        <div class="lg:col-span-5 space-y-8">
                            <div>
                                <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mb-6">Visual Presentation</h3>
                                <div class="relative group">
                                    <div class="relative h-72 rounded-[2rem] overflow-hidden border-4 border-slate-50 dark:border-zinc-800 shadow-xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center">
                                        {{-- Preview Image --}}
                                        <img id="image-preview"
                                             src="{{ $food->image ? asset('storage/'.$food->image) : '#' }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 {{ !$food->image ? 'hidden' : '' }}" />

                                        {{-- Default SVG --}}
                                        <div id="preview-svg" class="flex flex-col items-center text-slate-400 {{ $food->image ? 'hidden' : '' }}">
                                            <svg class="w-16 h-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>

                                        {{-- Upload Overlay --}}
                                        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white cursor-pointer">
                                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span class="text-xs font-black uppercase tracking-widest">Update Photo</span>
                                            <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(event)" />
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-4 text-center font-bold uppercase tracking-widest italic">Recommend: 1080x1080px high-res shot</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 ml-1">Menu Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-2 focus:ring-emerald-500 resize-none shadow-inner"
                                    placeholder="Describe the flavors of the wild...">{{ old('description', $food->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-10 flex flex-col sm:flex-row gap-4 border-t border-slate-50 dark:border-zinc-800">
                        <button type="submit"
                            class="flex-[2] py-5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-emerald-100 dark:shadow-none transition-all active:scale-[0.98] flex justify-center items-center gap-3 group">
                            <span>Push Updates to Safari</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                        <a href="{{ route('food.index') }}"
                            class="flex-1 py-5 bg-slate-100 dark:bg-zinc-800 text-slate-500 rounded-[2rem] font-bold text-center hover:bg-slate-200 transition-all flex items-center justify-center">
                            Discard Changes
                        </a>
                    </div>
                </form>
            </div>
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
                svg.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
