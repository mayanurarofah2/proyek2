<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // 🔥 CREATE TRANSACTION
public function createTransaction(Request $request)
{
    try {

        if (!$request->items || count($request->items) == 0) {
            return response()->json(['error' => 'Items kosong'], 400);
        }

        $orders = [];
        $grossAmount = 0;

        $grouped = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;

            $sellerId = $product->user_id;

            if (!isset($grouped[$sellerId])) {
                $grouped[$sellerId] = [];
            }

            $grouped[$sellerId][] = [
                'product' => $product,
                'quantity' => $item['quantity'] ?? 1,
                'price' => $item['price'] ?? 0
            ];
        }

        // 🔥 ORDER ID UTAMA (INI YANG DIPAKAI MIDTRANS)
        $mainOrderId = 'MULTI-' . time();

        foreach ($grouped as $sellerId => $items) {

            $total = 0;

            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'order_number' => $mainOrderId, // 🔥 SAMAKAN
                'total' => $total,
                'status' => 'pending',
                'user_id' => $request->user_id, // 🔥 INI PEMBELI
                'seller_id' => $sellerId,       // 🔥 TAMBAHAN
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $grossAmount += $total;
        }

        // 🔥 MIDTRANS PARAM
        $params = [
            'transaction_details' => [
                'order_id' => $mainOrderId,
                'gross_amount' => (int) $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->name ?? 'User',
                'email' => $request->email ?? 'user@gmail.com',
            ],
        ];

        // 🔥 DEBUG
        \Log::info("MIDTRANS PARAM:", $params);

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
        ]);

    } catch (\Exception $e) {

        \Log::error("MIDTRANS ERROR: " . $e->getMessage());

        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    // 🔥 CALLBACK MIDTRANS
public function callback(Request $request)
{
    $orders = Order::where('order_number', $request->order_id)->get();

    if ($orders->isEmpty()) {
        return response()->json(['message' => 'Order not found']);
    }

    foreach ($orders as $order) {
        if ($request->transaction_status == 'settlement') {
            $order->status = 'sukses';
        } elseif ($request->transaction_status == 'pending') {
            $order->status = 'pending';
        } else {
            $order->status = 'gagal';
        }

        $order->save();
    }

    return response()->json(['message' => 'OK']);
}
}