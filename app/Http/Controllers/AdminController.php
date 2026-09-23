<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if (! $user || ! $user->is_admin) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        $totalUsers = User::count();
        $proUsers = User::where('is_pro', true)->count();
        $totalQrCodes = QrCode::count();
        $totalRevenue = $proUsers * 19;

        return view('admin.index', [
            'users' => User::latest()->paginate(10),
            'qrCodes' => QrCode::with('user')->latest()->paginate(10),
            'totalUsers' => $totalUsers,
            'proUsers' => $proUsers,
            'totalQrCodes' => $totalQrCodes,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
