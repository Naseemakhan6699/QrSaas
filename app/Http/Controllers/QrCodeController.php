<?php

namespace App\Http\Controllers;

use App\Mail\ProPlanInvoiceMail;
use App\Models\QrCode as SavedQrCode;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

class QrCodeController extends Controller
{
    public function indexQrCode()
    {
        return view('welcome_qrCode');
    }

    public function billing()
    {
        return view('welcome_qrCode', [
            'billingRequired' => true,
            'billingMessage' => session('billing_required', 'Your free plan allows one QR code. Upgrade to create more.'),
        ]);
    }

    public function billingSuccess()
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->update(['is_pro' => true]);

            Mail::to($user->email)->send(new ProPlanInvoiceMail(
                invoiceNumber: 'INV-' . strtoupper(substr(md5((string) now()->timestamp), 0, 8)),
                planName: 'QR SaaS Pro',
                amount: 19.00,
                currency: 'USD'
            ));
        }

        return redirect()->route('dashboard')->with('status', 'Your Pro plan is active. Welcome aboard!');
    }

    public function billingCancel()
    {
        return redirect()->route('homeQr')->with('billing_required', 'Payment was cancelled. You can try again anytime.');
    }

    public function stripeWebhook(Request $request): JsonResponse
    {
        $secret = config('services.stripe.webhook_secret');

        if (empty($secret)) {
            return response()->json(['status' => 'missing_webhook_secret'], 400);
        }

        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $signature, $secret);
        } catch (\UnexpectedValueException|\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['status' => 'invalid_signature'], 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $userId = $session->metadata->user_id ?? null;

            if ($userId) {
                $user = User::find($userId);

                if ($user) {
                    $user->update(['is_pro' => true]);

                    Mail::to($user->email)->send(new ProPlanInvoiceMail(
                        invoiceNumber: 'INV-' . strtoupper(substr(md5((string) now()->timestamp . $user->id), 0, 8)),
                        planName: 'QR SaaS Pro',
                        amount: 19.00,
                        currency: 'USD'
                    ));
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->is_pro) {
            return redirect()->route('dashboard')->with('status', 'Your Pro plan is already active.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'mode' => 'subscription',
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'QR SaaS Pro Plan',
                        'description' => 'Unlimited QR code generation and advanced features',
                    ],
                    'unit_amount' => 1900,
                    'recurring' => [
                        'interval' => 'month',
                    ],
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'user_id' => $user->id,
            ],
            'success_url' => route('billing.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('billing.cancel', [], true),
        ]);

        return redirect()->away($session->url, 303);
    }

    public function generate(Request $request)
    {
        $qrType = $request->input('qr_type', 'url');

        $rules = [
            'qr_type' => ['nullable', 'in:url,business_card'],
            'foreground_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'background_color' => ['nullable', 'regex:/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/'],
            'size' => ['nullable', 'integer', 'min:100', 'max:900'],
            'margin' => ['nullable', 'integer', 'min:0', 'max:10'],
            'shape' => ['nullable', 'in:square,circle,dot,round'],
        ];

        if ($qrType === 'business_card') {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['phone'] = ['nullable', 'string', 'max:255'];
            $rules['email'] = ['nullable', 'email', 'max:255'];
            $rules['whatsapp'] = ['nullable', 'string', 'max:255'];
            $rules['url'] = ['nullable', 'url'];
        } else {
            $rules['url'] = ['required', 'url'];
        }

        $validated = $request->validate($rules, [
            'url.required' => 'Please enter a website URL.',
            'url.url' => 'Please enter a valid URL such as https://example.com.',
            'name.required' => 'Please enter the contact name for the business card.',
        ]);

        $name = trim((string) ($validated['name'] ?? ''));
        $phone = trim((string) ($validated['phone'] ?? ''));
        $email = trim((string) ($validated['email'] ?? ''));
        $whatsapp = trim((string) ($validated['whatsapp'] ?? ''));

        if ($qrType === 'business_card') {
            $vCard = "BEGIN:VCARD\r\nVERSION:3.0\r\n";
            $vCard .= "FN:{$name}\r\n";

            if ($phone !== '') {
                $vCard .= "TEL;TYPE=CELL:{$phone}\r\n";
            }

            if ($email !== '') {
                $vCard .= "EMAIL:{$email}\r\n";
            }

            if ($whatsapp !== '') {
                $vCard .= "X-WHATSAPP:{$whatsapp}\r\n";
            }

            $vCard .= "END:VCARD";

            $url = $email !== '' ? 'mailto:' . $email : ($phone !== '' ? 'tel:' . $phone : ($whatsapp !== '' ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp) : 'https://example.com'));
            $encodedValue = $vCard;
        } else {
            $url = trim((string) $validated['url']);

            if (! preg_match('/^https?:\/\//i', $url)) {
                $url = 'https://' . $url;
            }

            $encodedValue = $url;
        }

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (! $user->is_pro) {
                $qrCount = $user->qrCodes()->count();

                if ($qrCount >= 1) {
                    return redirect()->route('billing')->with('billing_required', 'Your free plan allows one QR code. Upgrade to create more.');
                }
            }

            $savedQrCode = $user->qrCodes()->create([
                'url' => $url,
                'name' => $name,
            ]);
            $encodedUrl = route('qr.redirect', $savedQrCode->slug);
        } else {
            $encodedUrl = $encodedValue;
        }

        $foregroundHex = $validated['foreground_color'] ?? '#000000';
        $backgroundHex = $validated['background_color'] ?? '#ffffff';
        $size = (int) ($validated['size'] ?? 320);
        $margin = (int) ($validated['margin'] ?? 2);
        $shape = $validated['shape'] ?? 'square';

        $foreground = $this->hexToRgb($foregroundHex);
        $background = $this->hexToRgb($backgroundHex);

        $generator = QrCode::format('svg')
            ->size($size)
            ->margin($margin)
            ->color($foreground['r'], $foreground['g'], $foreground['b'])
            ->backgroundColor($background['r'], $background['g'], $background['b']);

        if ($shape === 'circle') {
            $generator->eye('circle');
        } elseif ($shape === 'dot' || $shape === 'round') {
            $generator->style($shape === 'dot' ? 'dot' : 'round');
        }

        $dataUri = 'data:image/svg+xml;base64,' . base64_encode($generator->generate($encodedUrl));

        return view('welcome_qrCode', [
            'qr_type' => $qrType,
            'url' => $url,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'qrCode' => $dataUri,
            'foreground_color' => $foregroundHex,
            'background_color' => $backgroundHex,
            'size' => $size,
            'margin' => $margin,
            'shape' => $shape,
        ]);
    }

    private function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = implode('', array_map(fn ($char) => $char . $char, str_split($hex)));
        }

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }

    public function redirect(SavedQrCode $qrCode, Request $request)
    {
        $qrCode->scans()->create([
            'ip_hash' => $request->ip() ? hash_hmac('sha256', $request->ip(), (string) config('app.key')) : null,
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer'),
        ]);

        return redirect()->away($qrCode->url);
    }
}
