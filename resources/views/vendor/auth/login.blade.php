<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-500 text-white rounded-2xl shadow-lg shadow-amber-200 mb-4 rotate-3">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight">Merchant Hub</h2>
        <p class="text-slate-500 mt-2 font-medium">Manage your kitchen & orders</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('vendor.login.submit') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Business Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-amber-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 100-4H5a2 2 0 100 4z"/>
                    </svg>
                </div>
                <input id="email"
                    class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-900 rounded-2xl transition-all text-slate-900 dark:text-white placeholder-slate-400 focus:ring-0"
                    type="email" name="email" :value="old('email')"
                    placeholder="store@bitesafari.com"
                    required autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Store Key</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-amber-500">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password"
                    class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 dark:bg-zinc-800 border-2 border-transparent focus:border-amber-500 focus:bg-white dark:focus:bg-zinc-900 rounded-2xl transition-all text-slate-900 dark:text-white placeholder-slate-400 focus:ring-0"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" class="rounded border-slate-300 text-amber-500 shadow-sm focus:ring-amber-500" name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-slate-400 font-medium">Keep me signed in</span>
            </label>
        </div>

        <div class="pt-2">
            <button class="w-full py-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold rounded-2xl shadow-lg shadow-amber-100 dark:shadow-none transition-all active:scale-[0.97] flex items-center justify-center gap-3">
                <span>Open Store Dashboard</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>
    </form>
</x-guest-layout>
