<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Merchant Portal | {{ config('app.name', 'BiteSafari') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }

        /* Safari Merchant Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #f59e0b; border-radius: 20px; } /* Amber scrollbar */

        .glass-header {
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
        }
    </style>
</head>

<body class="antialiased bg-[#fcfcfc] dark:bg-[#050505] text-slate-900 dark:text-slate-200">
    @php
        // Strictly fetch Vendor data
        $vendor = auth('vendor')->user();
    @endphp

    <div class="flex min-h-screen relative" x-data="{ sidebarOpen: false }">

        {{-- 1. MERCHANT NAVIGATION (SIDEBAR) --}}
        @include('layouts.vendor-navigation')

        {{-- 2. MERCHANT MAIN CONTENT AREA --}}
        <div class="flex-1 transition-all duration-300 md:ml-64 flex flex-col min-w-0">

            {{-- DYNAMIC TOPBAR --}}
            <header class="sticky top-0 z-30 glass-header bg-white/70 dark:bg-zinc-900/70 border-b border-slate-100 dark:border-zinc-800/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-24">

                        <div class="flex items-center gap-4 min-w-0">
                            {{-- Mobile Sidebar Toggle --}}
                            <button @click="sidebarOpen = true" class="md:hidden p-3 text-slate-500 hover:bg-amber-50 rounded-2xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </button>

                            {{-- Vendor Contextual Title --}}
                            <div class="truncate">
                                @isset($header)
                                    {{ $header }}
                                @else
                                    <h2 class="text-2xl font-black tracking-tighter italic uppercase text-slate-800 dark:text-white">Merchant Hub</h2>
                                @endisset
                            </div>
                        </div>

                        {{-- Right Side Utilities --}}
                        <div class="flex items-center gap-4">
                            {{-- Kitchen Pulse --}}
                            <div class="hidden lg:flex items-center gap-3 px-4 py-2 bg-amber-500/5 rounded-2xl border border-amber-500/10">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </span>
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-amber-600">Terminal Online</span>
                            </div>

                            {{-- Vendor Profile Brief --}}
                            <div class="flex items-center gap-3 pl-4 border-l border-slate-100 dark:border-zinc-800">
                                <div class="hidden sm:block text-right">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Merchant ID: #{{ $vendor->id ?? '000' }}</p>
                                    <p class="text-xs font-black text-slate-800 dark:text-white capitalize italic">{{ $vendor->name ?? 'Vendor' }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-amber-500 flex items-center justify-center uppercase text-white font-black italic shadow-lg shadow-amber-200">
                                    {{ substr($vendor->name ?? 'V', 0, 1) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- MERCHANT PAGE CONTENT --}}
            <main class="flex-1 p-6 md:p-12 animate-in fade-in slide-in-from-bottom-3 duration-1000">
                {{ $slot }}
            </main>

            {{-- MERCHANT FOOTER --}}
            <footer class="py-10 px-6 border-t border-slate-50 dark:border-zinc-800/30">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em]">
                        &copy; {{ date('Y') }} Bitesafari Merchant Network • v1.0
                    </p>
                    <div class="flex items-center gap-6">
                        <span class="text-[8px] font-bold text-emerald-500 uppercase tracking-widest">● System Encrypted</span>
                        <span class="text-[8px] font-bold text-slate-300 uppercase tracking-widest italic">Terminal: {{ request()->ip() }}</span>
                    </div>
                </div>
            </footer>
        </div>

        {{-- MOBILE OVERLAY --}}
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden"
             x-transition:enter="transition opacity-0 ease-out duration-300"
             x-transition:leave="transition opacity-100 ease-in duration-200">
        </div>
    </div>
</body>
</html>
