<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-amber-500 rounded-[1.5rem] flex items-center justify-center shadow-2xl shadow-amber-200 rotate-3 transition-transform hover:rotate-0 duration-500">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter italic uppercase leading-none">Store Profile</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2 italic">Manage your merchant account</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8">

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="mb-8 p-5 bg-emerald-500 text-white rounded-[2rem] font-black text-xs uppercase tracking-widest flex items-center justify-between shadow-xl shadow-emerald-200 dark:shadow-none animate-in slide-in-from-top-4 duration-500">
                <span>🔥 {{ session('success') }}</span>
                <button @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            </div>
        @endif

        <div class="bg-white dark:bg-zinc-900 shadow-[0_30px_60px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[3rem] overflow-hidden">

            {{-- Brand Accent Line --}}
            <div class="h-2.5 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12">

                {{-- Left: Badge/Visual --}}
                <div class="lg:col-span-4 bg-slate-50/50 dark:bg-zinc-800/30 p-12 border-r border-slate-50 dark:border-zinc-800/50 flex flex-col items-center text-center">
                    <div class="w-36 h-36 bg-white dark:bg-zinc-900 rounded-[3rem] shadow-2xl border-8 border-slate-50 dark:border-zinc-800 flex items-center justify-center text-6xl font-black text-amber-500 mb-8 transition-transform hover:scale-105 duration-500 italic">
                        {{ substr($vendor->name, 0, 1) }}
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic leading-tight">{{ $vendor->name }}</h3>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-amber-500 mt-3 italic">Verified Merchant</p>

                    <div class="mt-12 w-full space-y-4">
                         <div class="flex items-center gap-4 px-6 py-4 bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-slate-100 dark:border-zinc-800 transition-all hover:border-emerald-200 group">
                            <svg class="w-5 h-5 text-emerald-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-zinc-400">Account Active</span>
                         </div>
                         <p class="px-4 text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed italic">
                            Your store is visible on the Bitesafari trail.
                         </p>
                    </div>
                </div>

                {{-- Right: Form --}}
                <div class="lg:col-span-8 p-12 lg:p-20">
                    <form action="{{ route('vendor.profile.update') }}" method="POST" class="space-y-10">
                        @csrf
                        {{-- Laravel Multi-Auth typically uses POST for profile updates in standard setups --}}

                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-10 italic">Account Settings</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                {{-- Business Name --}}
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Store Name</label>
                                    <input type="text" name="name" value="{{ old('name', $vendor->name) }}" required
                                        class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-bold text-lg shadow-inner" />
                                </div>

                                {{-- Phone --}}
                                {{-- <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Contact Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}" required
                                        class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-bold text-lg shadow-inner" />
                                </div> --}}
                                {{-- Phone --}}
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Contact Number</label>
                                    <input type="text"
                                        name="phone"
                                        value="{{ old('phone', $vendor->phone) }}"
                                        required
                                        maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                        placeholder="10 digit number"
                                        class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-bold text-lg shadow-inner" />
                                    @error('phone')<span class="text-rose-500 text-[10px] font-black mt-1 ml-2">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                            <input type="email"
                                name="email"
                                value="{{ old('email', $vendor->email) }}"
                                required
                                oninput="this.value = this.value.replace(/\s/g, '').toLowerCase()"
                                placeholder="merchant@bitesafari.com"
                                class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-bold text-lg shadow-inner" />

                            @error('email')
                                <span class="text-rose-500 text-[10px] font-black mt-1 ml-2 block uppercase tracking-tighter">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Store Location (Full Address)</label>
                            <textarea name="address" rows="4" required
                                class="w-full px-6 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-[1.5rem] focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white font-medium shadow-inner resize-none italic"
                                placeholder="Enter your full store address...">{{ old('address', $vendor->address) }}</textarea>
                        </div>

                        {{-- Action Button --}}
                        <div class="pt-8 border-t border-slate-50 dark:border-zinc-800">
                            <button type="submit"
                                class="w-full py-6 bg-slate-900 dark:bg-amber-500 hover:bg-black dark:hover:bg-amber-600 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl transition-all active:scale-95 flex justify-center items-center gap-4 group">
                                <span>Save Profile Changes</span>
                                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </button>

                            <p class="text-center text-[10px] font-bold text-slate-300 uppercase tracking-widest mt-8 italic">
                                Last updated: {{ now()->format('D, d M Y') }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-vendor-layout>
