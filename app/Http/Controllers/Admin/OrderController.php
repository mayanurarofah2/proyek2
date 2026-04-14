<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = Order::where('seller_id', $user->id)
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

// 🔥 TAMBAHAN
    if ($request->status == 'sukses') {
        return redirect('/admin/orders/detail/' . $order->id);
    }

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate');
    }
        // 🔥 INI YANG KAMU TANYA (WAJIB TARUH DI SINI)
   public function show($id)
{
    $user = auth()->user();

    $order = Order::with(['buyer', 'seller', 'items.product'])
        ->where('seller_id', $user->id) // 🔥 PENTING BANGET
        ->findOrFail($id);

    return view('admin.orders.detail', compact('order'));
}
}
