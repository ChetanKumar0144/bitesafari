<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-500 text-white rounded-2xl shadow-lg mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Admin Portal</h2>
        <p class="text-slate-500 mt-2">Bitesafari HQ Control Center</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">HQ Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                </div>
                <input id="email"
                    class="block w-full pl-10 pr-3 py-3 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 transition-all text-slate-900 dark:text-white"
                    type="email" name="email" :value="old('email')"
                    placeholder="admin@bitesafari.com"
                    required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div>
            <div class="flex justify-between mb-1">
                <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Access Key</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-emerald-500 hover:text-emerald-600 transition-colors" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <input id="password"
                    class="block w-full pl-10 pr-3 py-3 bg-slate-50 dark:bg-zinc-800 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 transition-all text-slate-900 dark:text-white"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
            <span class="ms-2 text-sm font-medium text-slate-600 dark:text-slate-400">Trust this workstation</span>
        </div>

        <button class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <span>Secure Login</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </button>
    </form>
</x-guest-layout>
