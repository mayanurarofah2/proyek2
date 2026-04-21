<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalRevenue = $user->orders()->sum('total');
        $totalOrders = $user->orders()->count();
        $totalProducts = $user->products()->count();

        $orders = $user->orders()
                    ->latest()
                    ->take(5)
                    ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'orders'
        ));
    }

    public function export(Request $request)
{
    $user = auth()->user();

    $orders = Order::with(['items.product']) // ✅ FIX
        ->where('seller_id', $user->id)
        ->get();

    $totalRevenue = $orders->sum('total');

    $pdf = Pdf::loadView('admin.laporan_pdf', [
        'orders' => $orders,
        'totalRevenue' => $totalRevenue,
        'user' => $user
    ]);

    return $pdf->download('laporan-penjualan.pdf');
}
}