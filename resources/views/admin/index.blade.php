<x-layouts.app title="Admin Panel | QR SaaS">
    <div class="flex flex-col gap-6">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-[.2em] text-violet-300">Admin panel</p>
                <h1 class="mt-2 text-4xl font-black tracking-tight text-white">Revenue & platform overview</h1>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-xl border border-white/10 px-4 py-2 text-sm font-semibold text-slate-300 hover:border-violet-400/50 hover:text-white">Back to dashboard</a>
        </div>

        <section class="grid gap-4 md:grid-cols-4">
            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5">
                <p class="text-sm text-slate-400">Total users</p>
                <p class="mt-2 text-3xl font-black text-white">{{ $totalUsers }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5">
                <p class="text-sm text-slate-400">Pro users</p>
                <p class="mt-2 text-3xl font-black text-white">{{ $proUsers }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5">
                <p class="text-sm text-slate-400">QR codes</p>
                <p class="mt-2 text-3xl font-black text-white">{{ $totalQrCodes }}</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5">
                <p class="text-sm text-slate-400">Revenue</p>
                <p class="mt-2 text-3xl font-black text-white">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5 sm:p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-2xl font-black text-white">User management</h2>
                    <span class="rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1 text-xs font-semibold text-violet-200">{{ $users->total() }} users</span>
                </div>
                <div class="space-y-3">
                    @forelse ($users as $user)
                        <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <div>
                                <p class="font-semibold text-white">{{ $user->name }}</p>
                                <p class="text-sm text-slate-400">{{ $user->email }}</p>
                            </div>
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $user->is_pro ? 'bg-emerald-500/10 text-emerald-300 border border-emerald-500/30' : 'bg-slate-800 text-slate-300 border border-white/10' }}">
                                {{ $user->is_pro ? 'Pro' : 'Free' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">No users found.</p>
                    @endforelse
                </div>
                <div class="mt-5">{{ $users->links() }}</div>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-5 sm:p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-2xl font-black text-white">QR management</h2>
                    <span class="rounded-full border border-emerald-400/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">{{ $qrCodes->total() }} total</span>
                </div>
                <div class="space-y-3">
                    @forelse ($qrCodes as $qrCode)
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-white">{{ $qrCode->name ?: 'Untitled QR' }}</p>
                                    <p class="mt-1 truncate text-sm text-slate-400">{{ $qrCode->url }}</p>
                                </div>
                                <span class="shrink-0 rounded-full border border-violet-400/30 bg-violet-500/10 px-2.5 py-1 text-xs font-semibold text-violet-200">{{ $qrCode->user->name ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">No QR codes found.</p>
                    @endforelse
                </div>
                <div class="mt-5">{{ $qrCodes->links() }}</div>
            </div>
        </section>
    </div>
</x-layouts.app>
