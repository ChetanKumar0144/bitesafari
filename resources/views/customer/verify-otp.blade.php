<x-customer-layout>
    <div class="min-h-[80vh] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

        {{-- Verification Card --}}
        <div class="max-w-md w-full space-y-8 bg-white dark:bg-zinc-900 p-10 rounded-[3rem] border border-slate-100 dark:border-zinc-800 shadow-[0_20px_50px_rgba(0,0,0,0.05)] relative overflow-hidden">

            {{-- Background Glow --}}
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl"></div>

            <div class="text-center relative z-10">
                <div class="inline-flex w-16 h-16 bg-indigo-500 rounded-3xl items-center justify-center shadow-xl shadow-indigo-200 -rotate-3 mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-slate-800 dark:text-white tracking-tighter italic">Identity Check</h2>
                <p class="mt-3 text-sm font-bold text-slate-400 uppercase tracking-widest">Digital key sent to <br> <span class="text-indigo-500 lowercase">{{ $email }}</span></p>
            </div>

            {{-- Alert --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 rounded-r-2xl font-bold text-xs animate-in fade-in slide-in-from-top-4">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <form class="mt-10 space-y-8 relative z-10" method="POST" action="{{ route('customer.otp.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="space-y-4">
                    <label class="block text-center text-xs font-black uppercase tracking-[0.3em] text-slate-500">Security Code</label>
                    <div class="relative">
                        <input type="text" name="otp" required maxlength="6"
                               class="w-full px-4 py-5 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-2xl font-black tracking-[0.5em] text-center text-slate-900 dark:text-white transition-all shadow-inner"
                               placeholder="******">
                    </div>
                    @error('otp')<p class="mt-2 text-center text-[10px] font-bold text-rose-500 uppercase italic">{{ $message }}</p>@enderror
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-5 px-4 bg-slate-900 dark:bg-indigo-600 hover:bg-black dark:hover:bg-indigo-700 text-white text-sm font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl transition-all active:scale-95">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Authorize Access
                    </button>
                </div>
            </form>

            <div class="text-center pt-2">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-loose">
                    Didn't receive the code? <br>
                    <a href="{{ route('customer.login') }}" class="text-indigo-500 hover:underline">Re-initialize Safari Request</a>
                </p>
            </div>
        </div>

        {{-- Help Text --}}
        <p class="mt-8 text-[10px] font-bold text-slate-400 uppercase tracking-[0.4em] opacity-40">
            Encrypted Session • BiteSafari HQ
        </p>
    </div>
</x-customer-layout>
