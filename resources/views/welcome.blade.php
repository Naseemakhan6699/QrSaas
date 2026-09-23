<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="QR SaaS helps businesses generate QR codes instantly, track scans, and unlock secure Pro features with simple Stripe billing.">
    <meta name="keywords" content="QR code generator, QR SaaS, Pro QR code, website QR, QR tracking, link shortening">
    <title>QR SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#070b14] text-slate-100 antialiased">
    <div class="relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top,_rgba(168,85,247,0.22),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(59,130,246,0.18),_transparent_26%)]"></div>
        <div class="absolute inset-x-0 top-0 -z-10 h-px bg-gradient-to-r from-transparent via-violet-500/80 to-transparent"></div>

        <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6 lg:px-10">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-lg font-black text-white shadow-lg shadow-violet-600/30">
                    Q
                </div>
                <div>
                    <div class="text-lg font-semibold tracking-tight text-white">QR SaaS</div>
                </div>
            </div>
            <nav class="hidden items-center gap-6 text-sm text-slate-300 md:flex">
 
                <a href="#features" class="transition hover:text-white">Features</a>
                <a href="#features" class="transition hover:text-white">Plans</a>
                <!-- <a href="#generator" class="transition hover:text-white">Generator</a> -->
                <a href="#pricing" class="transition hover:text-white">Pricing</a>

            </nav>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="hidden text-sm font-semibold text-slate-300 transition hover:text-white md:inline-flex">Login</a>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 pb-20 pt-8 lg:px-10 lg:pt-12">
            <section class="mb-14 text-center">
                <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.28em] text-violet-200">
                    <span class="h-2 w-2 rounded-full bg-violet-400"></span>
                    clean • trusted • conversion-driven
                </div>
                <h1 class="mx-auto max-w-4xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl lg:text-7xl">
                    Try free. Upgrade to Pro when your business grows.
                </h1>
                <p class="mx-auto mt-5 max-w-2xl text-base text-slate-300 sm:text-lg">
                    Start with the free plan to test QR generation, then unlock the full business features with Pro for unlimited QR campaigns, analytics, payments, and customer growth.
                </p>
            </section>

          
            <section id="features" class="mt-14 grid gap-5 md:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">🍽️</div>
                    <h3 class="text-lg font-bold text-white">Restaurants & shops</h3>
                    <p class="mt-2 text-sm text-slate-300">QR codes for menus, offers, contact pages, and instant customer access to your brand.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">📇</div>
                    <h3 class="text-lg font-bold text-white">Business cards</h3>
                    <p class="mt-2 text-sm text-slate-300">Share contact details, WhatsApp, portfolio, and social links through one clean QR profile.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">🎟️</div>
                    <h3 class="text-lg font-bold text-white">Events & bookings</h3>
                    <p class="mt-2 text-sm text-slate-300">Boost bookings, leads, and event conversions with QR links for contactless check-ins and payments.</p>
                </div>
            </section>

            <section class="mt-14 rounded-[32px] border border-violet-500/20 bg-slate-900/75 p-6 md:p-8">
                <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-200">Why businesses choose us</p>
                        <h2 class="mt-3 text-3xl font-black tracking-[-0.06em] text-white sm:text-4xl">Your QR code can be a real customer tool.</h2>
                        <p class="mt-4 max-w-xl text-base text-slate-300">
                            Create QR codes for menus, contact cards, WhatsApp, bookings, Events, lead capture, and payment pages. Keep your brand clean, trusted, and easy to scan.
                        </p>
                        <div class="mt-6 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl border border-white/10 bg-[#0d1320] p-4">
                                <p class="text-sm font-semibold text-violet-200">Dynamic QR Codes</p>
                                <p class="mt-2 text-sm text-slate-300">Edit and reuse digital links anytime without changing your printed QR.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-[#0d1320] p-4">
                                <p class="text-sm font-semibold text-violet-200">Scan statistics</p>
                                <p class="mt-2 text-sm text-slate-300">Track visits and understand which QR campaigns are performing.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-[#0d1320] p-4">
                                <p class="text-sm font-semibold text-violet-200">Business card QR</p>
                                <p class="mt-2 text-sm text-slate-300">Share name, phone, email, portfolio, and WhatsApp in one clean scan.</p>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-[#0d1320] p-4">
                                <p class="text-sm font-semibold text-violet-200">Fast customer action</p>
                                <p class="mt-2 text-sm text-slate-300">Turn scans into orders, bookings, inquiries, and sales in seconds.</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[28px] border border-white/10 bg-[linear-gradient(180deg,rgba(15,23,42,0.95),rgba(17,24,39,1))] p-5 shadow-[0_18px_60px_rgba(124,58,237,0.18)]">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Sample</p>
                                <h3 class="mt-1 text-xl font-bold text-white">Business card QR</h3>
                            </div>
                            <span class="rounded-full border border-emerald-400/40 bg-emerald-500/10 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-emerald-200">Live</span>
                        </div>

                        <div class="rounded-2xl border border-violet-500/20 bg-[#0b1220] p-4">
                            <div class="mx-auto flex h-44 w-44 items-center justify-center rounded-2xl bg-white p-3 shadow-lg shadow-violet-500/10">
                                <div class="grid h-full w-full grid-cols-11 gap-1 rounded-xl bg-white p-2">
                                    @for ($i = 0; $i < 121; $i++)
                                        <span class="block {{ $i % 3 === 0 ? 'bg-slate-900' : ($i % 2 === 0 ? 'bg-slate-900/80' : 'bg-white') }} rounded-[2px]"></span>
                                    @endfor
                                </div>
                            </div>
                            <div class="mt-5 space-y-2 text-sm text-slate-300">
                                <p><span class="font-semibold text-white">Name:</span> Nain khan</p>
                                <p><span class="font-semibold text-white">Phone:</span> +971 000000</p>
                                <p><span class="font-semibold text-white">Email:</span> hello@yourbrand.com</p>
                                <p><span class="font-semibold text-white">WhatsApp:</span> +971 000000000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-14 rounded-[32px] border border-white/10 bg-slate-900/80 p-6 md:p-8">
                <div class="mx-auto max-w-3xl text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-200">QR customization</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.06em] text-white sm:text-4xl">Brand your QR codes with color, logo, and style.</h2>
                    <p class="mt-4 text-base text-slate-300">Turn a plain QR into a branded customer experience with custom colors, logo placement, and polished design options that match your business identity.</p>
                </div>

                <div class="mt-8 grid gap-5 md:grid-cols-3">
                    <div class="rounded-3xl border border-white/10 bg-[#0d1320] p-5">
                        <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">🎨</div>
                        <h3 class="text-lg font-bold text-white">Color styling</h3>
                        <p class="mt-2 text-sm text-slate-300">Match your QR to your brand colors for a premium and memorable look.</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-[#0d1320] p-5">
                        <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">🖼️</div>
                        <h3 class="text-lg font-bold text-white">Logo branding</h3>
                        <p class="mt-2 text-sm text-slate-300">Add your company logo or icon to keep the QR recognizable and trusted.</p>
                    </div>
                    <div class="rounded-3xl border border-white/10 bg-[#0d1320] p-5">
                        <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">✨</div>
                        <h3 class="text-lg font-bold text-white">Premium design</h3>
                        <p class="mt-2 text-sm text-slate-300">Create clean high-contrast QR designs that feel professional on menus, cards, and packaging.</p>
                    </div>
                </div>
            </section>

            <section id="pricing" class="mt-14 rounded-[32px] border border-white/10 bg-slate-900/80 p-6 shadow-[0_30px_80px_rgba(15,23,42,0.7)] md:p-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-200">Business plans</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.06em] text-white sm:text-4xl">Simple pricing for every stage of growth.</h2>
                    <p class="mt-3 text-base text-slate-300">A clean landing page, secure checkout, Arabic/English-ready messaging, and a clear problem-solution offer for modern businesses.</p>
                </div>

                <div class="mt-8 grid gap-6 lg:grid-cols-2">
                    <div class="rounded-[28px] border border-slate-700 bg-[#0b1220] p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Free plan</p>
                        <h3 class="mt-3 text-4xl font-black text-white">$0</h3>
                        <p class="mt-3 text-sm text-slate-300">Perfect for trying the platform and creating your first QR link.</p>
                        <ul class="mt-5 space-y-3 text-sm text-slate-200">
                            <li>• 1 QR code</li>
                            <li>• Basic sharing and download</li>
                            <li>• Great for testing and personal use</li>
                        </ul>
                    </div>

                    <div class="rounded-[28px] border border-violet-500/40 bg-gradient-to-br from-violet-500/15 via-slate-900 to-slate-900 p-6 ring-1 ring-violet-500/20">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-violet-200">Pro plan</p>
                        <h3 class="mt-3 text-4xl font-black text-white">AED 69<span class="text-base text-slate-300">/month</span></h3>
                        <p class="mt-3 text-sm text-slate-300">The real business plan for unlimited QR campaigns, analytics, customer actions, and revenue growth.</p>
                        <ul class="mt-5 space-y-3 text-sm text-slate-100">
                            <li>• Unlimited QR generation</li>
                            <li>• Advanced scan tracking and insights</li>
                            <li>• Export-ready QR codes for teams and campaigns</li>
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
        </main>
    </div>
</body>
</html>
        </main>
    </div>
</body>
</html>
