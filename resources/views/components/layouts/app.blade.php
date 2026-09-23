<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'QR SaaS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#080a12] text-slate-100 antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,rgba(124,58,237,.18),transparent_34%)]">
        <header class="border-b border-white/10 bg-[#0b0d17]/80 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-5">
                <a href="{{ route('homeQr') }}" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-600 font-black text-white shadow-lg shadow-violet-600/30">Q</span>
                    <span class="text-lg font-bold text-white">QR SaaS</span>
                </a>
                @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-300 hover:text-white">Dashboard</a>
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.index') }}" class="text-sm font-semibold text-violet-200 hover:text-white">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">@csrf<button class="rounded-xl border border-white/10 px-3 py-2 text-sm font-semibold text-slate-300 hover:border-violet-400/50 hover:text-white">Log out</button></form>
                    </div>
                @else
                    <div class="flex items-center gap-3"><a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white">Log in</a><a href="{{ route('register') }}" class="rounded-xl bg-violet-600 px-4 py-2 text-sm font-bold text-white hover:bg-violet-500">Create account</a></div>
                @endauth
            </div>
        </header>
        <main class="mx-auto max-w-6xl px-6 py-10">{{ $slot }}</main>
    </div>
</body>
</html>
