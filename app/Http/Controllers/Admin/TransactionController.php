<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function cetak($id)
{
    $order = Order::with(['items.product', 'buyer', 'seller'])
        ->findOrFail($id);

    $pdf = Pdf::loadView('admin.kwitansi_pdf', [
        'order' => $order
    ]);

    return $pdf->download('kwitansi-'.$order->order_number.'.pdf');
}
}