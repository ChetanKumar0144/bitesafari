<x-customer-layout>
    <div class="min-h-[80vh] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

        {{-- Login Card --}}
        <div class="max-w-md w-full space-y-8 bg-white dark:bg-zinc-900 p-10 rounded-[3rem] border border-slate-100 dark:border-zinc-800 shadow-[0_20px_50px_rgba(0,0,0,0.05)] relative overflow-hidden">

            {{-- Aesthetic Background Decor --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>

            <div class="text-center relative z-10">
                <div class="inline-flex w-16 h-16 bg-indigo-500 rounded-3xl items-center justify-center shadow-xl shadow-indigo-200 rotate-3 mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-slate-800 dark:text-white tracking-tighter italic">Welcome, Explorer</h2>
                <p class="mt-3 text-sm font-bold text-slate-400 uppercase tracking-widest">Identify yourself to start the safari</p>
            </div>

            {{-- Success/Alert --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-xs animate-in fade-in zoom-in duration-500">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <form class="mt-10 space-y-6 relative z-10" method="POST" action="{{ route('customer.login.sendOtp') }}">
                @csrf

                <div class="space-y-1">
                    <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-2 ml-1">Registered Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </div>
                        <input type="email" name="email" required
                               class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold transition-all"
                               placeholder="explorer@bitesafari.com">
                    </div>
                    @error('email')<p class="mt-2 text-[10px] font-bold text-rose-500 uppercase italic">{{ $message }}</p>@enderror
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-95">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-400 group-hover:text-indigo-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </span>
                        Initialize OTP
                    </button>
                </div>
            </form>

            <div class="text-center pt-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-loose">
                    By proceeding, you agree to our <br>
                    <a href="#" class="text-indigo-500 hover:underline">Safari Guidelines</a> & <span class="text-indigo-500">Privacy Protocols</span>
                </p>
            </div>
        </div>

        {{-- Footer Branding --}}
        <div class="mt-8 flex items-center gap-2 opacity-20">
            <div class="w-5 h-5 bg-indigo-500 rounded-lg"></div>
            <span class="font-black text-xs tracking-tighter italic">bitesafari security</span>
        </div>
    </div>
</x-customer-layout>
