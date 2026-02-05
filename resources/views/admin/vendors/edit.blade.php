<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">
                        Modify Partner
                    </h2>
                </div>
                <p class="text-slate-500 text-sm font-medium mt-1 ml-13">Updating credentials for: {{ $vendor->name }}</p>
            </div>

            <a href="{{ route('admin.vendors.index') }}"
               class="px-5 py-2.5 bg-white dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 rounded-2xl border border-slate-200 dark:border-zinc-700 hover:bg-slate-50 transition-all flex items-center gap-2 font-bold shadow-sm active:scale-95 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Abort Changes
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] overflow-hidden">

                {{-- Status Identity Bar --}}
                <div class="h-2 bg-gradient-to-r {{ $vendor->is_active ? 'from-emerald-400 to-emerald-600' : 'from-rose-400 to-rose-600' }}"></div>

                <form action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST" class="p-8 lg:p-12 space-y-10">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                        {{-- Left Column: Brand & Auth --}}
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-amber-600 mb-4 italic">Partner Profile</h3>

                            {{-- Vendor Name --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Legal Business Name</label>
                                <input type="text" name="name" value="{{ old('name', $vendor->name) }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm" />
                                @error('name')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Authorized Email</label>
                                <input type="email" name="email" value="{{ old('email', $vendor->email) }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm" />
                                @error('email')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Hotline / Mobile</label>
                                <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm" />
                                @error('phone')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Right Column: Presence --}}
                        <div class="space-y-6">
                            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-amber-600 mb-4 italic">Operational Base</h3>

                            {{-- Address --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">HQ Address</label>
                                <textarea name="address" rows="5" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-950 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-sm resize-none">{{ old('address', $vendor->address) }}</textarea>
                                @error('address')<span class="text-rose-500 text-xs font-bold mt-2 ml-2 block">{{ $message }}</span>@enderror
                            </div>

                            {{-- Status Toggle --}}
                            <div class="pt-4 p-4 bg-slate-50 dark:bg-zinc-800/50 rounded-2xl border border-slate-100 dark:border-zinc-800">
                                <label class="relative inline-flex items-center cursor-pointer group w-full">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $vendor->is_active) ? 'checked' : '' }}>
                                    <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-emerald-500 shadow-inner"></div>
                                    <div class="ml-4 flex flex-col">
                                        <span class="text-sm font-black uppercase tracking-widest text-slate-700 dark:text-zinc-200">System Status</span>
                                        <span class="text-[10px] font-bold text-slate-400 group-hover:text-emerald-500 transition-colors uppercase tracking-tighter">Toggle Network Presence</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-10 flex flex-col sm:flex-row gap-4 border-t border-slate-50 dark:border-zinc-800">
                        <button type="submit"
                            class="flex-[2] py-5 bg-slate-800 dark:bg-emerald-600 hover:bg-black dark:hover:bg-emerald-700 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-slate-200 dark:shadow-none transition-all active:scale-[0.98] flex justify-center items-center gap-3 group">
                            <span>Push Profile Updates</span>
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                        <a href="{{ route('admin.vendors.index') }}"
                            class="flex-1 py-5 bg-slate-100 dark:bg-zinc-800 text-slate-500 dark:text-zinc-400 rounded-[2rem] font-bold text-center hover:bg-slate-200 transition-all flex items-center justify-center italic">
                            Discard
                        </a>
                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                Partner Protocol V2.1 • Bitesafari Network
            </p>
        </div>
    </div>
</x-app-layout>
