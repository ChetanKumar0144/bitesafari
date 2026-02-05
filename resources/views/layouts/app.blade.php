<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BiteSafari') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #1e293b; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[#f8fafc] dark:bg-[#050505] text-slate-900 dark:text-slate-200">
    <div class="min-h-screen relative" x-data="{ sidebarOpen: false }">

        {{-- 1. Navigation (Sidebar) --}}
        {{-- Admin/Staff Navigation --}}
        @auth
            @include('layouts.navigation')
        @endauth

        {{-- Customer Navigation (If different) --}}
        @auth('customer')
            @include('customer.layouts.navigation') {{-- Check if you want a sidebar for customers too --}}
        @endauth

        {{-- 2. Main Content Area --}}
        <div class="transition-all duration-300 @auth md:ml-64 @endauth @auth('vendor') md:ml-64 @endauth">

            {{-- Topbar / Header --}}
            <header class="sticky top-0 z-30 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-slate-200 dark:border-zinc-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-20">

                        {{-- Mobile Toggle --}}
                        <div class="flex items-center md:hidden">
                            <button @click="sidebarOpen = true" class="text-slate-500 hover:text-emerald-500 transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </button>
                            <span class="ml-4 font-bold text-xl tracking-tight text-emerald-600 italic">bitesafari</span>
                        </div>

                        {{-- Page Title (Slot Header) --}}
                        <div class="hidden md:block">
                            @isset($header)
                                {{ $header }}
                            @else
                                <h2 class="font-bold text-xl text-slate-800 dark:text-white">Dashboard</h2>
                            @endisset
                        </div>

                        {{-- Right Side Actions (Notifications, Profile Dropdown etc) --}}
                        <div class="flex items-center gap-4">
                            {{-- Add Notification Icon here if needed --}}
                            <div class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-zinc-800 flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-4 md:p-8 max-w-7xl mx-auto min-h-[calc(100vh-5rem)]">
                {{-- Breadcrumbs (Optional but MST) --}}
                <nav class="flex mb-6 text-xs font-bold uppercase tracking-widest text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center italic text-emerald-500">
                            BiteSafari
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                                <span class="ml-1 md:ml-2">{{ Request::segment(1) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                {{-- The Main Slot --}}
                <div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                    {{ $slot }}
                </div>
            </main>

            {{-- Mini Footer --}}
            <footer class="p-8 text-center border-t border-slate-100 dark:border-zinc-800 text-slate-400 text-xs tracking-tighter uppercase font-bold">
                &copy; {{ date('Y') }} Bitesafari Command Center. All Rights Reserved.
            </footer>
        </div>
    </div>
</body>
</html>
