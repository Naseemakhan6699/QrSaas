<x-layouts.app title="Dashboard | QR SaaS">
    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div><p class="text-sm font-bold uppercase tracking-[.2em] text-violet-300">Workspace</p><h1 class="mt-2 text-4xl font-black tracking-tight text-white">Your QR history</h1><p class="mt-3 text-slate-400">Manage every code you have created.</p></div>
        <a href="{{ route('homeQr') }}" class="inline-flex items-center justify-center rounded-2xl bg-violet-600 px-5 py-3 font-bold text-white hover:bg-violet-500">Create new QR</a>
    </div>
    @if (session('status'))<div class="mt-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">{{ session('status') }}</div>@endif
    <section class="mt-8 grid gap-4 sm:grid-cols-4">
        <div class="rounded-3xl border border-white/10 bg-white/[.05] p-5"><p class="text-sm text-slate-400">Total saved</p><p class="mt-2 text-3xl font-black text-white">{{ $qrCodes->total() }}</p></div>
        <div class="rounded-3xl border border-white/10 bg-white/[.05] p-5"><p class="text-sm text-slate-400">Total scans</p><p class="mt-2 text-3xl font-black text-white">{{ $totalScans }}</p></div>
        <div class="rounded-3xl border border-white/10 bg-white/[.05] p-5"><p class="text-sm text-slate-400">Account</p><p class="mt-2 truncate text-lg font-bold text-white">{{ auth()->user()->email }}</p></div>
        <div class="rounded-3xl border border-white/10 bg-white/[.05] p-5"><p class="text-sm text-slate-400">Status</p><p class="mt-2 text-lg font-bold text-emerald-300">Active</p></div>
    </section>
    <section class="mt-8 rounded-3xl border border-white/10 bg-white/[.04] p-5 sm:p-7">
        <div class="flex items-center justify-between gap-4">
            <div><p class="text-sm font-bold uppercase tracking-[.18em] text-violet-300">Analytics</p><h2 class="mt-2 text-2xl font-black text-white">Recent scans</h2></div>
            <span class="rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-semibold text-emerald-300">Live tracking</span>
        </div>
        <div class="mt-5 space-y-3">
            @forelse ($recentScans as $scan)
                <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                    <div><p class="text-sm font-semibold text-white">{{ $scan->qrCode->name ?: 'Untitled QR code' }}</p><p class="mt-1 text-xs text-slate-500">{{ $scan->qrCode->url }}</p></div>
                    <time class="shrink-0 text-xs text-slate-400">{{ $scan->scanned_at->diffForHumans() }}</time>
                </div>
            @empty
                <p class="py-5 text-sm text-slate-400">No scans yet. Share a dynamic QR code to start collecting analytics.</p>
            @endforelse
        </div>
    </section>
    <section class="mt-8 rounded-3xl border border-white/10 bg-white/[.04] p-5 sm:p-7">
        @forelse ($qrCodes as $qrCode)
            <article class="flex flex-col gap-4 border-b border-white/10 py-5 first:pt-0 last:border-0 last:pb-0 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0"><h2 class="font-bold text-white">{{ $qrCode->name ?: 'Untitled QR code' }}</h2><p class="mt-1 truncate text-sm text-slate-400">{{ $qrCode->url }}</p><p class="mt-2 text-xs text-slate-500">{{ $qrCode->scans()->count() }} scans · {{ $qrCode->created_at->diffForHumans() }}</p><p class="mt-1 truncate text-xs text-violet-300">{{ route('qr.redirect', $qrCode->slug) }}</p></div>
                <div class="flex shrink-0 gap-2"><a href="{{ $qrCode->url }}" target="_blank" rel="noopener" class="rounded-xl border border-white/10 px-3 py-2 text-sm font-semibold text-slate-300 hover:border-violet-400/50 hover:text-white">Open</a><a href="{{ route('qr-codes.download', $qrCode) }}" class="rounded-xl bg-violet-600 px-3 py-2 text-sm font-semibold text-white hover:bg-violet-500">Download</a><form method="POST" action="{{ route('qr-codes.destroy', $qrCode) }}">@csrf @method('DELETE')<button class="rounded-xl border border-rose-500/30 px-3 py-2 text-sm font-semibold text-rose-300 hover:bg-rose-500/10">Delete</button></form></div>
            </article>
        @empty
            <div class="py-14 text-center"><p class="text-lg font-bold text-white">No saved QR codes yet</p><p class="mt-2 text-sm text-slate-400">Generate your first code and it will appear here.</p></div>
        @endforelse
        <div class="mt-5">{{ $qrCodes->links() }}</div>
    </section>
</x-layouts.app>
