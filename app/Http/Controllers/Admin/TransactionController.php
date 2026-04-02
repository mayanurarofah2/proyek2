<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(6);

        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        $average = Order::avg('total');

        return view('admin.transactions', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'average'
        ));
    }
}