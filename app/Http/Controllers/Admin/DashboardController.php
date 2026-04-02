<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

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
}