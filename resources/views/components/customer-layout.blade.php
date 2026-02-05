<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BiteSafari - Explorer Portal</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        /* Custom Indigo Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e0e7ff; border-radius: 20px; }
        .dark ::-webkit-scrollbar-thumb { background: #312e81; }
    </div>
    </style>
</head>

<body class="antialiased bg-[#fcfcfc] dark:bg-[#050505] text-slate-900 dark:text-slate-200 selection:bg-indigo-100 selection:text-indigo-700">

    <div class="min-h-screen flex flex-col">

        {{-- 1. PREMIUM TOPBAR --}}
        {{-- Isko sticky rakha hai taaki actions hamesha samne rahein --}}
        <header class="sticky top-0 z-50 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl border-b border-slate-100 dark:border-zinc-800">
            @include('customer.layouts.topbar')
        </header>

        {{-- 2. MAIN EXPLORER AREA --}}
        {{-- Animate-in effects add kiye hain smooth loading ke liye --}}
        <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
            {{ $slot }}
        </main>

        {{-- 3. MOBILE NAVIGATION (Optional Bottom Bar) --}}
        {{-- Agar aap mobile app wali feel chahte hain toh yahan bottom nav add ho sakti hai --}}

        {{-- 4. MINIMAL FOOTER --}}
        <footer class="py-10 border-t border-slate-100 dark:border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 flex flex-col items-center justify-center gap-4">
                <div class="flex items-center gap-2 opacity-30 grayscale group-hover:grayscale-0 transition-all">
                    <div class="w-6 h-6 bg-indigo-500 rounded-lg rotate-3"></div>
                    <span class="font-black text-sm tracking-tighter italic">bitesafari</span>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">
                    &copy; {{ date('Y') }} Explorer Portal • Secure Expedition
                </p>
            </div>
        </footer>

    </div>

    {{-- Global Success/Error Toast (Agar aap use karte hain) --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
             class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] px-6 py-3 bg-slate-900 text-white rounded-2xl font-bold text-sm shadow-2xl flex items-center gap-3">
            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
            {{ session('success') }}
        </div>
    @endif

</body>
</html>
