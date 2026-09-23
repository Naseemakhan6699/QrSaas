<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="QR SaaS pricing for free and Pro plans, including secure Stripe checkout and unlimited QR generation for growing teams.">
    <meta name="keywords" content="QR SaaS pricing, Pro QR plan, Stripe checkout, QR generator pricing">
    <meta property="og:title" content="QR SaaS Pricing">
    <meta property="og:description" content="Start free or upgrade to Pro for unlimited QR generation, analytics, and secure billing.">
    <meta property="og:type" content="website">
    <title>Pricing | QR SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#070b14] text-slate-100 antialiased">
    <div class="mx-auto max-w-6xl px-6 py-10">
        <header class="mb-10 flex items-center justify-between">
            <a href="{{ route('homeQr') }}" class="text-2xl font-black text-white">QR SaaS</a>
            <a href="{{ route('homeQr') }}" class="rounded-full border border-violet-400/30 bg-violet-500/10 px-4 py-2 text-sm font-semibold text-violet-100">Back to home</a>
        </header>

        <section class="rounded-[32px] border border-white/10 bg-slate-900/80 p-8 shadow-[0_30px_80px_rgba(15,23,42,0.7)]">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-200">Plans & billing</p>
                <h1 class="mt-3 text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl">Simple pricing for every stage of growth.</h1>
                <p class="mt-4 text-base text-slate-300">Start free, unlock powerful QR workflows, and keep everything secure with Stripe billing.</p>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-2">
                <div class="rounded-[28px] border border-slate-700 bg-[#0b1220] p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Free plan</p>
                    <h2 class="mt-3 text-4xl font-black text-white">$0</h2>
                    <p class="mt-3 text-sm text-slate-300">Perfect for trying QR generation without committing to a subscription.</p>
                    <ul class="mt-5 space-y-3 text-sm text-slate-200">
                        <li>• 1 QR code</li>
                        <li>• Basic download and share options</li>
                        <li>• Quick access to generated links</li>
                    </ul>
                </div>

                <div class="rounded-[28px] border border-violet-500/40 bg-gradient-to-br from-violet-500/15 via-slate-900 to-slate-900 p-6 ring-1 ring-violet-500/20">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-violet-200">Pro plan</p>
                    <h2 class="mt-3 text-4xl font-black text-white">$19<span class="text-base text-slate-300">/month</span></h2>
                    <p class="mt-3 text-sm text-slate-300">Built for teams and creators who need reusable QR workflows and higher output.</p>
                    <ul class="mt-5 space-y-3 text-sm text-slate-100">
                        <li>• Unlimited QR generation</li>
                        <li>• Advanced analytics and scan tracking</li>
                        <li>• Priority export and branded QR styles</li>
                    </ul>
                    <form action="{{ route('billing.checkout') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-5 py-3 text-base font-bold text-white shadow-[0_16px_35px_rgba(139,92,246,0.45)] transition hover:-translate-y-0.5">
                            Upgrade to Pro
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
