<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BiteSafari') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Custom Safari Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #1e293b; }
    </style>
</head>

<body class="antialiased bg-[#fcfcfc] dark:bg-[#050505] text-slate-900 dark:text-slate-200">
    <div class="flex min-h-screen relative" x-data="{ sidebarOpen: false }">

        {{-- 1. GLOBAL NAVIGATION (SIDEBAR) --}}
        @include('layouts.vendor-navigation')

        {{-- 2. MAIN CONTENT AREA --}}
        <div class="flex-1 transition-all duration-300 md:ml-64 flex flex-col min-w-0">

            {{-- DYNAMIC TOPBAR --}}
            <header class="sticky top-0 z-30 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-slate-100 dark:border-zinc-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-20">

                        {{-- Mobile Toggle Button --}}
                        <div class="flex items-center md:hidden">
                            <button @click="sidebarOpen = true" class="p-2 text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </button>
                            <span class="ml-4 font-black text-xl tracking-tighter text-emerald-600 italic">bitesafari</span>
                        </div>

                        {{-- Desktop Header Slot --}}
                        <div class="hidden md:block">
                            @isset($header)
                                {{ $header }}
                            @endisset
                        </div>

                        {{-- Global Utilities (User Menu, Notifications etc.) --}}
                        <div class="flex items-center gap-3">
                            {{-- Pulse Status Indicator --}}
                            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-50 dark:bg-zinc-800 rounded-full border border-slate-100 dark:border-zinc-700">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Syncing Live</span>
                            </div>

                            {{-- Profile Trigger (Optional shorthand) --}}
                            <div class="w-10 h-10 rounded-2xl bg-white dark:bg-zinc-800 border border-slate-100 dark:border-zinc-700 flex items-center justify-center text-slate-500 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- MAIN PAGE CONTENT --}}
            <main class="flex-1 p-4 md:p-10 animate-in fade-in slide-in-from-bottom-2 duration-700 overflow-y-auto">
                {{ $slot }}
            </main>

            {{-- FOOTER --}}
            <footer class="p-8 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} Bitesafari Command System • All Systems Operational
            </footer>
        </div>

        {{-- MOBILE SIDEBAR OVERLAY --}}
        <div x-show="sidebarOpen"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden"
             x-transition:enter="transition opacity-0 duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity-100 duration-200"
             x-transition:leave-end="opacity-0">
        </div>
    </div>
</body>
</html>
