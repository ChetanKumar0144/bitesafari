<x-vendor-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200 rotate-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight italic">Store Identity</h2>
                    <p class="text-slate-500 text-sm font-medium">Manage your merchant credentials</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-[#f8fafc] dark:bg-[#050505] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-sm animate-in fade-in slide-in-from-top-4">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] overflow-hidden">

                {{-- Brand Accent Line --}}
                <div class="h-2 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12">

                    {{-- Left: Badge/Visual --}}
                    <div class="lg:col-span-4 bg-slate-50 dark:bg-zinc-800/50 p-10 border-r border-slate-100 dark:border-zinc-800 flex flex-col items-center text-center">
                        <div class="w-32 h-32 bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-xl border-4 border-slate-100 dark:border-zinc-800 flex items-center justify-center text-5xl font-black text-amber-500 mb-6 group transition-transform hover:rotate-3">
                            {{ substr($vendor->name, 0, 1) }}
                        </div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight leading-tight">{{ $vendor->name }}</h3>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-600 mt-2 italic">Verified Merchant</p>

                        <div class="mt-10 w-full space-y-3">
                             <div class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-slate-100 dark:border-zinc-800">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Live on Safari</span>
                             </div>
                             <div class="px-4 py-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed italic">
                                Your profile is visible to all explorers in the network.
                             </div>
                        </div>
                    </div>

                    {{-- Right: Form --}}
                    <div class="lg:col-span-8 p-10 lg:p-14">
                        <form action="{{ route('vendor.profile.update') }}" method="POST" class="space-y-8">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                {{-- Business Name --}}
                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Business Name</label>
                                    <input type="text" name="name" value="{{ old('name', $vendor->name) }}" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-950 border-2 border-transparent focus:border-amber-500 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-inner" />
                                </div>

                                {{-- Phone --}}
                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Merchant Hotline</label>
                                    <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}" required
                                        class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-950 border-2 border-transparent focus:border-amber-500 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-inner" />
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Administrative Email</label>
                                <input type="email" name="email" value="{{ old('email', $vendor->email) }}" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-950 border-2 border-transparent focus:border-amber-500 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-inner" />
                            </div>

                            {{-- Address --}}
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Physical Coordinates (HQ)</label>
                                <textarea name="address" rows="4" required
                                    class="w-full px-5 py-4 bg-slate-50 dark:bg-zinc-950 border-2 border-transparent focus:border-amber-500 rounded-2xl transition-all text-slate-900 dark:text-white font-medium focus:ring-0 shadow-inner resize-none">{{ old('address', $vendor->address) }}</textarea>
                            </div>

                            {{-- Action --}}
                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full py-5 bg-amber-500 hover:bg-amber-600 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-amber-100 dark:shadow-none transition-all active:scale-[0.98] flex justify-center items-center gap-3 group">
                                    <span>Synchronize Identity</span>
                                    <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                </button>
                                <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-6">
                                    System Security Protocol • Last Update: {{ now()->format('d M Y') }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-vendor-layout>
