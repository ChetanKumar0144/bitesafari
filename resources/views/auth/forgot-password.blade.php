<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-2xl mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Lost your key?</h2>
        <p class="text-slate-500 mt-2 px-4 text-sm">
            {{ __('No worries! Enter your HQ email and we\'ll send you a rescue link to reset your access.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4 text-sm font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-950/30 p-4 rounded-xl text-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Registered Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 100-4H5a2 2 0 100 4z"/>
                    </svg>
                </div>
                <input id="email"
                    class="block w-full pl-10 pr-3 py-3 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 transition-all text-slate-900 dark:text-white placeholder-slate-400"
                    type="email" name="email" :value="old('email')"
                    placeholder="name@bitesafari.com"
                    required autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="flex flex-col gap-4">
            <button class="w-full py-4 bg-slate-800 dark:bg-emerald-600 hover:bg-slate-900 dark:hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                <span>{{ __('Send Reset Link') }}</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>

            <a href="{{ route('login') }}" class="text-center text-sm font-bold text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors">
                ← Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
