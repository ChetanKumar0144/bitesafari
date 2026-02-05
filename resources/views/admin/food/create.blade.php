<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                    🍳 Create New Bite
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Introduce a new delicacy to the safari</p>
            </div>
            <a href="{{ route('food.index') }}"
               class="px-5 py-2.5 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-2 font-bold shadow-sm active:scale-95 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Catalogue
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] overflow-hidden">

                {{-- Decorative Header --}}
                <div class="h-2 bg-gradient-to-r from-emerald-400 via-emerald-600 to-amber-400"></div>

                <form action="{{ route('food.store') }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                        {{-- Left Column: Details --}}
                        <div class="lg:col-span-7 space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mb-4">Basic Information</h3>

                            {{-- Food Name --}}
                            <div class="group">
                                <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1 transition-colors group-focus-within:text-emerald-500">Dish Title</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-emerald-500 focus:bg-white dark:focus:bg-zinc-900 rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-medium focus:ring-0"
                                    placeholder="e.g. Royal Safari Burger" />
                                @error('name')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Price --}}
                                <div>
                                    <label for="price" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Price (₹)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-emerald-500 focus:bg-white dark:focus:bg-zinc-900 rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-bold focus:ring-0"
                                        placeholder="0.00" />
                                </div>
                                {{-- Quantity --}}
                                <div>
                                    <label for="quantity" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Stock Qty</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-emerald-500 focus:bg-white dark:focus:bg-zinc-900 rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-bold focus:ring-0"
                                        placeholder="10" />
                                </div>
                            </div>

                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mt-10 pt-4 mb-4 border-t border-slate-50 dark:border-zinc-800">Classification</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Category --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Category</label>
                                    <select name="category_id" class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] text-sm font-bold text-slate-600 dark:text-zinc-300 focus:ring-2 focus:ring-emerald-500">
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Vendor --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Vendor</label>
                                    <select name="vendor_id" class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] text-sm font-bold text-slate-600 dark:text-zinc-300 focus:ring-2 focus:ring-emerald-500">
                                        <option value="">Select Store</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Media --}}
                        <div class="lg:col-span-5 flex flex-col">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-500 mb-4">Media & Story</h3>

                            {{-- Image Dropzone --}}
                            <div class="relative flex-1 group">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Food Photography</label>
                                <div class="relative h-64 lg:h-full min-h-[300px] border-2 border-dashed border-slate-200 dark:border-zinc-700 hover:border-emerald-500 dark:hover:border-emerald-500 rounded-[2rem] transition-all bg-slate-50 dark:bg-zinc-800/50 flex flex-col items-center justify-center overflow-hidden">
                                    <input type="file" name="image" id="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(event)" />

                                    <div id="preview-placeholder" class="flex flex-col items-center transition-all group-hover:scale-110">
                                        <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-2xl shadow-xl flex items-center justify-center text-emerald-500 mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <p class="text-sm font-bold text-slate-500">Tap to Upload</p>
                                        <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-black">PNG, JPG up to 5MB</p>
                                    </div>

                                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />

                                    {{-- Change Label Overlay --}}
                                    <div id="change-overlay" class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest hidden z-20">Change Photo</div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Short Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] transition-all text-slate-900 dark:text-white font-medium focus:ring-2 focus:ring-emerald-500 resize-none"
                                    placeholder="Tell a story about this dish...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Buttons --}}
                    <div class="pt-10 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-[2] py-5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-[1.5rem] font-black text-lg shadow-xl shadow-emerald-200 dark:shadow-none transition-all active:scale-[0.98] flex justify-center items-center gap-3 group">
                            <span>Register Food to Safari</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                        <a href="{{ route('food.index') }}"
                            class="flex-1 py-5 bg-slate-100 dark:bg-zinc-800 text-slate-500 dark:text-zinc-400 rounded-[1.5rem] font-bold text-center hover:bg-slate-200 transition-all">
                            Save as Draft
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event){
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('preview-placeholder');
            const overlay = document.getElementById('change-overlay');
            const file = event.target.files[0];

            if(file){
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                overlay.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
