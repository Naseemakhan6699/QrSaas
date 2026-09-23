<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="QR SaaS helps businesses generate QR codes instantly, track scans, and unlock secure Pro features with simple Stripe billing.">
    <meta name="keywords" content="QR code generator, QR SaaS, Pro QR code, website QR, QR tracking, link shortening">
    <meta property="og:title" content="QR SaaS | Generate QR Codes Instantly">
    <meta property="og:description" content="Create and share QR codes for links, pages, and campaigns in seconds.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <title>QR SaaS | Generate QR Codes Instantly</title>
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
                <a href="{{route('dashboard')}}" class="transition hover:text-white">Home</a>
                <a href="#features" class="transition hover:text-white">Features</a>
                <a href="#generator" class="transition hover:text-white">Generator</a>
                <a href="#pricing" class="transition hover:text-white">Pricing</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="transition hover:text-white">Dashboard</a>
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="transition hover:text-violet-200">Admin</a>
                    @endif
                @endauth
            </nav>
            @auth
                <div class="hidden items-center gap-3 md:flex">
                    <a href="{{ route('dashboard') }}" class="rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-violet-400/50 hover:text-white">Dashboard</a>
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="rounded-full border border-violet-400/40 bg-violet-500/10 px-4 py-2 text-sm font-semibold text-violet-100 transition hover:border-violet-300 hover:bg-violet-500/20">Admin</a>
                    @endif
                </div>
            @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 transition hover:text-white">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-violet-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-400">Create account</a>
                </div>
            @endauth
        </header>

        <main class="mx-auto max-w-6xl px-6 pb-20 pt-8 lg:px-10 lg:pt-12">
            <section class="mb-14 text-center">
                <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.28em] text-violet-200">
                    <span class="h-2 w-2 rounded-full bg-violet-400"></span>
                    fast & simple
                </div>
                <h1 class="mx-auto max-w-4xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl lg:text-7xl">
                    Turn any link into a QR code instantly.
                </h1>
                <p class="mx-auto mt-5 max-w-2xl text-base text-slate-300 sm:text-lg">
                    Generate a clean, ready-to-share QR code for websites, products, and links in seconds.
                </p>
            </section>

            <section id="generator" class="grid gap-6 rounded-[32px] border border-white/10 bg-slate-900/80 p-5 shadow-[0_30px_90px_rgba(124,58,237,0.22)] backdrop-blur-sm md:grid-cols-[1.2fr_0.8fr] md:p-8 lg:p-10">
                <div class="rounded-[28px] border border-white/10 bg-[#0d1320] p-5 sm:p-7">
                    <div class="mb-6 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-medium uppercase tracking-[0.18em] text-slate-400">Generator</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">Create your QR</h2>
                        </div>
                        <div class="rounded-full border border-violet-500/40 bg-violet-500/10 px-3 py-1 text-xs font-semibold text-violet-200">
                            Live
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="mb-5 rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                            {{ $errors->first('url') }}
                        </div>
                    @endif

                    @if (!empty($billingRequired) || session('billing_required'))
                        <div class="mb-5 rounded-2xl border border-amber-500/30 bg-amber-500/10 px-4 py-3 text-sm text-amber-100">
                            {{ $billingMessage ?? session('billing_required') }}
                        </div>
                    @endif

                    <form action="{{ route('qr.generate') }}" method="POST" class="space-y-5" novalidate>
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="qr_type" class="mb-2 block text-sm font-medium text-slate-200">QR Type</label>
                                <select id="qr_type" name="qr_type" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="QR type">
                                    <option value="url" {{ old('qr_type', $qr_type ?? 'url') === 'url' ? 'selected' : '' }}>Website URL</option>
                                    <option value="business_card" {{ old('qr_type', $qr_type ?? 'url') === 'business_card' ? 'selected' : '' }}>Business Card</option>
                                </select>
                            </div>

                            <div id="website-url-group" class="{{ old('qr_type', $qr_type ?? 'url') === 'business_card' ? 'hidden' : '' }}">
                                <label for="url" class="mb-2 block text-sm font-medium text-slate-200">Website URL</label>
                                <input
                                    id="url"
                                    name="url"
                                    type="url"
                                    value="{{ old('url', $url ?? '') }}"
                                    placeholder="https://example.com"
                                    class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 transition duration-200 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20"
                                    aria-label="Website URL"
                                >
                            </div>

                            <div id="business-card-fields" class="{{ old('qr_type', $qr_type ?? 'url') === 'business_card' ? '' : 'hidden' }} space-y-4 rounded-2xl border border-white/10 bg-slate-950/60 p-4">
                                <div>
                                    <label for="name" class="mb-2 block text-sm font-medium text-slate-200">Name</label>
                                    <input id="name" name="name" type="text" value="{{ old('name', $name ?? '') }}" placeholder="Nain khan" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="Business card name">
                                </div>

                                <div>
                                    <label for="phone" class="mb-2 block text-sm font-medium text-slate-200">Phone</label>
                                    <input id="phone" name="phone" type="text" value="{{ old('phone', $phone ?? '') }}" placeholder="+971 000000" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="Business card phone">
                                </div>

                                <div>
                                    <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
                                    <input id="email" name="email" type="email" value="{{ old('email', $email ?? '') }}" placeholder="hello@yourbrand.com" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="Business card email">
                                </div>

                                <div>
                                    <label for="whatsapp" class="mb-2 block text-sm font-medium text-slate-200">WhatsApp</label>
                                    <input id="whatsapp" name="whatsapp" type="text" value="{{ old('whatsapp', $whatsapp ?? '') }}" placeholder="+971 000000000" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="Business card whatsapp">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="customization_mode" class="mb-2 block text-sm font-medium text-slate-200">Customization</label>
                                <select id="customization_mode" name="customization_mode" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="QR customization mode">
                                    <option value="default" {{ old('customization_mode', 'default') === 'default' ? 'selected' : '' }}>Default</option>
                                    <option value="custom" {{ old('customization_mode', 'default') === 'custom' ? 'selected' : '' }}>Custom</option>
                                </select>
                            </div>

                            <div id="customization-fields" class="{{ old('customization_mode', 'default') === 'custom' ? '' : 'hidden' }} space-y-4 rounded-2xl border border-white/10 bg-slate-950/60 p-4">
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label for="foreground_color" class="mb-2 block text-sm font-medium text-slate-200">QR color</label>
                                        <input id="foreground_color" name="foreground_color" type="color" value="{{ old('foreground_color', $foreground_color ?? '#000000') }}" class="h-12 w-full cursor-pointer rounded-xl border border-slate-700 bg-slate-950 p-1" aria-label="QR foreground color">
                                    </div>
                                    <div>
                                        <label for="background_color" class="mb-2 block text-sm font-medium text-slate-200">Background</label>
                                        <input id="background_color" name="background_color" type="color" value="{{ old('background_color', $background_color ?? '#ffffff') }}" class="h-12 w-full cursor-pointer rounded-xl border border-slate-700 bg-slate-950 p-1" aria-label="QR background color">
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label for="size" class="mb-2 block text-sm font-medium text-slate-200">Size</label>
                                        <input id="size" name="size" type="number" min="100" max="900" step="10" value="{{ old('size', $size ?? 320) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 transition duration-200 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="QR size">
                                    </div>
                                    <div>
                                        <label for="margin" class="mb-2 block text-sm font-medium text-slate-200">Margin</label>
                                        <input id="margin" name="margin" type="number" min="0" max="10" step="1" value="{{ old('margin', $margin ?? 2) }}" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white placeholder:text-slate-500 transition duration-200 focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="QR margin">
                                    </div>
                                </div>

                                <div>
                                    <label for="shape" class="mb-2 block text-sm font-medium text-slate-200">Shape</label>
                                    <select id="shape" name="shape" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3.5 text-base text-white focus:border-violet-400 focus:outline-none focus:ring-4 focus:ring-violet-500/20" aria-label="QR shape">
                                        <option value="square" {{ old('shape', $shape ?? 'square') === 'square' ? 'selected' : '' }}>Square</option>
                                        <option value="circle" {{ old('shape', $shape ?? 'square') === 'circle' ? 'selected' : '' }}>Circle</option>
                                        <option value="dot" {{ old('shape', $shape ?? 'square') === 'dot' ? 'selected' : '' }}>Dot</option>
                                        <option value="round" {{ old('shape', $shape ?? 'square') === 'round' ? 'selected' : '' }}>Round</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-r from-violet-500 via-purple-500 to-indigo-500 px-5 py-3.5 text-base font-bold text-white shadow-[0_12px_30px_rgba(139,92,246,0.45)] transition duration-200 hover:-translate-y-0.5 hover:shadow-[0_18px_40px_rgba(139,92,246,0.5)] focus:outline-none focus:ring-4 focus:ring-violet-500/30">
                            Generate QR Code
                        </button>
                    </form>
                </div>

                <div class="flex min-h-[360px] items-center justify-center rounded-[28px] border border-violet-500/20 bg-[linear-gradient(180deg,rgba(15,23,42,0.96),rgba(17,24,39,0.98))] p-5 shadow-inner shadow-violet-500/10">
                    @if (!empty($qrCode))
                        <div class="w-full text-center">
                            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-violet-500/15 to-violet-600/5 text-violet-200 shadow-lg shadow-violet-500/10 ring-1 ring-violet-400/30">
                                <svg viewBox="0 0 24 24" class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M4 7.5A1.5 1.5 0 0 1 5.5 6h3A1.5 1.5 0 0 1 10 7.5v3A1.5 1.5 0 0 1 8.5 12h-3A1.5 1.5 0 0 1 4 10.5v-3Zm9 0A1.5 1.5 0 0 1 14.5 6h3A1.5 1.5 0 0 1 19 7.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 13 10.5v-3Zm-9 9A1.5 1.5 0 0 1 5.5 15h3a1.5 1.5 0 0 1 1.5 1.5v3A1.5 1.5 0 0 1 8.5 21h-3A1.5 1.5 0 0 1 4 19.5v-3Zm13.5-9h1.5v1.5h-1.5V7.5Zm0 3h1.5v1.5h-1.5v-1.5Zm-3-3h1.5v1.5h-1.5V7.5Zm-3 3h1.5v1.5H11v-1.5Zm3 3h1.5v1.5h-1.5v-1.5Zm3 0h1.5v1.5h-1.5v-1.5Zm-3 3h1.5v1.5H11v-1.5Zm3 0h1.5v1.5h-1.5v-1.5Zm3 0h1.5v1.5h-1.5v-1.5Z"/>
                                </svg>
                            </div>
                            <div class="mx-auto flex w-full max-w-[260px] items-center justify-center rounded-[28px] bg-white p-4 shadow-[0_24px_60px_rgba(139,92,246,0.18)]">
                                <img src="{{ $qrCode }}" alt="Generated QR code" class="h-52 w-52 object-contain">
                            </div>
                            @if (($qr_type ?? 'url') === 'business_card')
                                <div class="mt-5 space-y-2 text-sm text-slate-300">
                                    <p><span class="font-semibold text-white">Name:</span> {{ $name ?? 'Nain khan' }}</p>
                                    <p><span class="font-semibold text-white">Phone:</span> {{ $phone ?? '' }}</p>
                                    <p><span class="font-semibold text-white">Email:</span> {{ $email ?? '' }}</p>
                                    <p><span class="font-semibold text-white">WhatsApp:</span> {{ $whatsapp ?? '' }}</p>
                                </div>
                            @else
                                <p class="mt-5 break-all text-sm text-slate-300">{{ $url }}</p>
                            @endif

                            <div class="mt-5 flex items-center justify-center gap-3">
                                @if (($qr_type ?? 'url') === 'business_card')
                                    @php
                                        $businessCardLink = $email ? 'mailto:' . $email : ($phone ? 'tel:' . $phone : ($whatsapp ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp) : '#'));
                                    @endphp
                                    <a href="{{ $businessCardLink }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-xl border border-violet-500/40 bg-violet-500/10 px-4 py-2 text-sm font-semibold text-violet-200 transition hover:bg-violet-500/20">
                                        Open Contact
                                    </a>
                                @else
                                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-xl border border-violet-500/40 bg-violet-500/10 px-4 py-2 text-sm font-semibold text-violet-200 transition hover:bg-violet-500/20">
                                        Open Link
                                    </a>
                                @endif
                                <a href="{{ $qrCode }}" download="qr-code.svg" class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                                    Download QR
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-slate-400">
                            <div class="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-[28px] border border-violet-500/30 bg-slate-900 text-3xl font-bold text-violet-200 shadow-lg shadow-violet-500/10">
                                QR
                            </div>
                            <p class="text-base font-medium text-slate-200">Your QR code will appear here.</p>
                            <p class="mt-2 text-sm text-slate-400">Add a URL and generate instantly.</p>
                        </div>
                    @endif
                </div>
            </section>

            <section id="features" class="mt-14 grid gap-5 md:grid-cols-3">
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">⚡</div>
                    <h3 class="text-lg font-bold text-white">Fast</h3>
                    <p class="mt-2 text-sm text-slate-300">Create a QR code in less than a second.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">🔒</div>
                    <h3 class="text-lg font-bold text-white">Secure</h3>
                    <p class="mt-2 text-sm text-slate-300">Works with valid URLs and checks input before generation.</p>
                </div>
                <div class="rounded-3xl border border-white/10 bg-slate-900/70 p-5">
                    <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-lg text-violet-200">📦</div>
                    <h3 class="text-lg font-bold text-white">Shareable</h3>
                    <p class="mt-2 text-sm text-slate-300">Open or download the generated QR for your audience.</p>
                </div>
            </section>

            <section id="pricing" class="mt-14 rounded-[32px] border border-white/10 bg-slate-900/80 p-6 shadow-[0_30px_80px_rgba(15,23,42,0.7)] md:p-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-200">Plans & billing</p>
                    <h2 class="mt-3 text-3xl font-black tracking-[-0.06em] text-white sm:text-4xl">Simple pricing for business growth.</h2>
                    <p class="mt-3 text-base text-slate-300">Start free for a single QR, then unlock unlimited QR campaigns, links, and branded customer journeys with Pro.</p>
                </div>

                <div class="mt-8 grid gap-6 lg:grid-cols-2">
                    <div class="rounded-[28px] border border-slate-700 bg-[#0b1220] p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Free plan</p>
                        <h3 class="mt-3 text-4xl font-black text-white">$0</h3>
                        <p class="mt-3 text-sm text-slate-300">Best for testing QR links and quick customer access.</p>
                        <ul class="mt-5 space-y-3 text-sm text-slate-200">
                            <li>• 1 QR code</li>
                            <li>• Download and share options</li>
                            <li>• Quick access for restaurants, shops, and events</li>
                        </ul>
                    </div>

                    <div class="rounded-[28px] border border-violet-500/40 bg-gradient-to-br from-violet-500/15 via-slate-900 to-slate-900 p-6 ring-1 ring-violet-500/20">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-violet-200">Pro plan</p>
                        <h3 class="mt-3 text-4xl font-black text-white">$19<span class="text-base text-slate-300">/month</span></h3>
                        <p class="mt-3 text-sm text-slate-300">Built for businesses that need QR menus, contactless leads, bookings, and stronger digital conversion.</p>
                        <ul class="mt-5 space-y-3 text-sm text-slate-100">
                            <li>• Unlimited QR generation</li>
                            <li>• Scan tracking and business analytics</li>
                            <li>• Better conversion for restaurants, shops, events, and campaigns</li>
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

    <script>
        const qrType = document.getElementById('qr_type');
        const websiteUrlGroup = document.getElementById('website-url-group');
        const businessCardFields = document.getElementById('business-card-fields');
        const customizationMode = document.getElementById('customization_mode');
        const customizationFields = document.getElementById('customization-fields');
        const urlInput = document.getElementById('url');

        const toggleQrType = () => {
            const isBusinessCard = qrType && qrType.value === 'business_card';

            if (websiteUrlGroup) {
                websiteUrlGroup.classList.toggle('hidden', isBusinessCard);
            }

            if (businessCardFields) {
                businessCardFields.classList.toggle('hidden', !isBusinessCard);
            }

            if (urlInput) {
                urlInput.required = !isBusinessCard;
            }
        };

        if (qrType) {
            qrType.addEventListener('change', toggleQrType);
            toggleQrType();
        }

        if (customizationMode && customizationFields) {
            const toggleCustomization = () => {
                const isCustom = customizationMode.value === 'custom';
                customizationFields.classList.toggle('hidden', !isCustom);
            };

            customizationMode.addEventListener('change', toggleCustomization);
            toggleCustomization();
        }
    </script>
</body>
</html>
