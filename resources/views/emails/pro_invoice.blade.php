<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body style="margin:0; padding:0; background:#0b1220; font-family:Arial, sans-serif; color:#e2e8f0;">
    <div style="max-width:600px; margin:0 auto; background:#111827; border:1px solid #334155; border-radius:16px; overflow:hidden;">
        <div style="padding:24px 32px; background:linear-gradient(135deg, #7c3aed, #4f46e5);">
            <h2 style="margin:0; color:#fff; font-size:24px;">QR SaaS Pro</h2>
        </div>
        <div style="padding:32px;">
            <p style="margin:0 0 16px; color:#cbd5e1;">Thank you for your subscription.</p>
            <p style="margin:0 0 24px; color:#cbd5e1;">Your payment has been received successfully.</p>

            <table cellpadding="0" cellspacing="0" border="0" style="width:100%; border-collapse:collapse; margin-bottom:24px;">
                <tr>
                    <td style="padding:10px 0; color:#94a3b8;">Invoice #</td>
                    <td style="padding:10px 0; text-align:right; color:#f8fafc; font-weight:bold;">{{ $invoiceNumber }}</td>
                </tr>
                <tr>
                    <td style="padding:10px 0; color:#94a3b8;">Plan</td>
                    <td style="padding:10px 0; text-align:right; color:#f8fafc; font-weight:bold;">{{ $planName }}</td>
                </tr>
                <tr>
                    <td style="padding:10px 0; color:#94a3b8;">Amount</td>
                    <td style="padding:10px 0; text-align:right; color:#f8fafc; font-weight:bold;">{{ $currency }} {{ number_format($amount, 2) }}</td>
                </tr>
            </table>

            <p style="margin:0; color:#cbd5e1;">This invoice confirms your active Pro subscription and unlocks unlimited QR generation.</p>
        </div>
    </div>
</body>
</html>
