<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitesafari | Your Food Journey Starts Here</title>

    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,600,700,800" rel="stylesheet" />

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .safari-gradient {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        }
        .portal-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .portal-card:hover {
            transform: translateY(-8px);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-6xl grid lg:grid-cols-12 bg-white dark:bg-zinc-900 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] rounded-[2.5rem] overflow-hidden">

        <div class="lg:col-span-5 safari-gradient p-10 lg:p-16 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-2xl rotate-3">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-black tracking-tight italic">bitesafari</span>
                </div>

                <h1 class="text-5xl font-extrabold leading-[1.1] mb-6">
                    Eat. Explore. <br> <span class="text-emerald-200">Expand.</span>
                </h1>
                <p class="text-white/90 text-lg leading-relaxed max-w-sm">
                    The ultimate ecosystem for food lovers, restaurant owners, and smart administrators.
                </p>
            </div>

            <div class="relative z-10 bg-black/10 backdrop-blur-md border border-white/20 p-6 rounded-3xl mt-12">
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-400 border-2 border-emerald-600 shadow-lg"></div>
                        <div class="w-9 h-9 rounded-full bg-emerald-300 border-2 border-emerald-600 shadow-lg"></div>
                        <div class="w-9 h-9 rounded-full bg-emerald-200 border-2 border-emerald-600 shadow-lg"></div>
                    </div>
                    <p class="text-sm font-semibold tracking-wide">Join 5,000+ local explorers</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 p-8 lg:p-20 flex flex-col justify-center">
            <div class="mb-12">
                <h2 class="text-4xl font-extrabold text-slate-800 dark:text-white mb-3 tracking-tight">Access Portal</h2>
                <div class="h-1.5 w-20 bg-emerald-500 rounded-full"></div>
            </div>

            <div class="space-y-6">

                <a href="{{ Auth::guard('customer')->check() ? route('customer.dashboard') : route('customer.login') }}"
                   class="portal-card group flex items-center p-6 bg-emerald-50/50 dark:bg-emerald-950/10 border border-emerald-100 dark:border-emerald-900/30 rounded-[2rem] hover:bg-emerald-50 hover:border-emerald-400 transition-all shadow-sm">
                    <div class="w-16 h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-zinc-100">Explorer Login</h3>
                        <p class="text-slate-500 text-sm">Order food & track your safari</p>
                    </div>
                    <svg class="ml-auto w-6 h-6 text-emerald-400 opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

                <a href="{{ Auth::guard('vendor')->check() ? route('vendor.dashboard') : route('vendor.login') }}"
                   class="portal-card group flex items-center p-6 bg-amber-50/50 dark:bg-amber-950/10 border border-amber-100 dark:border-amber-900/30 rounded-[2rem] hover:bg-amber-50 hover:border-amber-400 transition-all shadow-sm">
                    <div class="w-16 h-16 bg-amber-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-amber-200 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-zinc-100">Merchant Hub</h3>
                        <p class="text-slate-500 text-sm">Manage restaurant & grow sales</p>
                    </div>
                    <svg class="ml-auto w-6 h-6 text-amber-400 opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

                <a href="{{ Auth::check() ? route('dashboard') : route('login') }}"
                   class="portal-card group flex items-center p-6 bg-slate-100/50 dark:bg-zinc-800/30 border border-slate-200 dark:border-zinc-700 rounded-[2rem] hover:bg-slate-100 hover:border-slate-400 transition-all shadow-sm">
                    <div class="w-16 h-16 bg-slate-800 text-white rounded-2xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-zinc-100">HQ Control</h3>
                        <p class="text-slate-500 text-sm">System metrics & staff settings</p>
                    </div>
                    <svg class="ml-auto w-6 h-6 text-slate-400 opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

            </div>

            <p class="mt-12 text-center text-slate-400 text-xs tracking-widest uppercase font-bold">
                &copy; 2026 Bitesafari Technologies
            </p>
        </div>
    </div>

</body>
</html>
