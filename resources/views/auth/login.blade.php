<x-layouts.app title="Log in | QR SaaS">
    <div class="mx-auto max-w-md">
        <div class="mb-8 text-center">
            <p class="text-sm font-bold uppercase tracking-[.2em] text-violet-300">Welcome back</p>
            <h1 class="mt-3 text-4xl font-black tracking-tight text-white">Log in to QR SaaS</h1>
            <p class="mt-3 text-slate-400">Access your saved QR codes and history.</p>
        </div>
        <form method="POST" action="{{ route('login.store') }}" class="space-y-5 rounded-3xl border border-white/10 bg-white/[.05] p-7 shadow-2xl shadow-violet-950/20">
            @csrf
            @if ($errors->any())
                <div class="rounded-2xl border border-rose-500/30 bg-rose-500/10 p-3 text-sm text-rose-200">{{ $errors->first() }}</div>
            @endif
            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-200">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none focus:border-violet-400 focus:ring-4 focus:ring-violet-500/20">
            </div>
            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-slate-200">Password</label>
                <input id="password" name="password" type="password" required class="w-full rounded-2xl border border-white/10 bg-slate-950 px-4 py-3 text-white outline-none focus:border-violet-400 focus:ring-4 focus:ring-violet-500/20">
            </div>
            <label class="flex items-center gap-2 text-sm text-slate-400"><input type="checkbox" name="remember" class="rounded border-white/20 bg-slate-900 text-violet-600"> Remember me</label>
            <button class="w-full rounded-2xl bg-violet-600 px-5 py-3.5 font-bold text-white shadow-lg shadow-violet-600/25 hover:bg-violet-500">Log in</button>
            <p class="text-center text-sm text-slate-400">New here? <a href="{{ route('register') }}" class="font-semibold text-violet-300 hover:text-violet-200">Create an account</a></p>
        </form>
    </div>
</x-layouts.app>
