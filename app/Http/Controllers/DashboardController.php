<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;

class DashboardController extends Controller
{
    public function dashboard()
    {
       return view('welcome');
    }
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user =Auth::user();
        $qrCodes = $user->qrCodes()->latest()->paginate(8);
        $totalScans = $user->qrCodes()->withCount('scans')->get()->sum('scans_count');
        $recentScans = $user->qrCodes()->with('scans')->get()->flatMap->scans->sortByDesc('scanned_at')->take(5);

        return view('dashboard', compact('qrCodes', 'totalScans', 'recentScans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'url' => ['required', 'url'],
            'name' => ['nullable', 'string', 'max:100'],
        ]);
        /** @var \App\Models\User $user */
$user= Auth::user();
        $user->qrCodes()->create($validated);

        return redirect()->route('dashboard')->with('status', 'QR code saved to your history.');
    }

    public function destroy(QrCode $qrCode): RedirectResponse
    {
        abort_unless($qrCode->user_id === Auth::id(), 403);
        $qrCode->delete();

        return redirect()->route('dashboard')->with('status', 'QR code deleted.');
    }

    public function download(QrCode $qrCode)
    {
        abort_unless($qrCode->user_id === Auth::id(), 403);

        $svg = QrCodeGenerator::format('svg')->size(640)->generate(route('qr.redirect', $qrCode->slug));

        return response($svg)->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qr-code-'.$qrCode->id.'.svg"');
    }
}
