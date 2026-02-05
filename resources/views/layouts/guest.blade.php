<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bitesafari') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .auth-bg {
                background: radial-gradient(circle at 0% 0%, rgba(16, 185, 129, 0.05) 0%, transparent 50%),
                            radial-gradient(circle at 100% 100%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
            }
        </style>
    </head>
    <body class="antialiased auth-bg bg-slate-50 dark:bg-zinc-950 text-slate-900 dark:text-zinc-100">
        <div class="min-h-screen flex flex-col justify-center items-center p-6">

            <div class="w-full sm:max-w-md bg-white dark:bg-zinc-900 shadow-[0_20px_50px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-zinc-800 rounded-[2.5rem] p-8 lg:p-10 relative overflow-hidden">

                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-16 -mt-16"></div>

                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>

            <div class="mt-8 flex gap-6 text-sm font-medium text-slate-400">
                <a href="#" class="hover:text-emerald-500 transition-colors">Help Center</a>
                <span class="opacity-20">|</span>
                <a href="#" class="hover:text-emerald-500 transition-colors">Privacy Policy</a>
            </div>
        </div>
    </body>
</html>
