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

        // 🔥 KELOMPOKKAN BERDASARKAN PENJUAL
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

        // 🔥 BUAT ORDER PER PENJUAL
        foreach ($grouped as $sellerId => $items) {

            $orderNumber = 'ORDER-' . time() . '-' . $sellerId;

            $total = 0;

            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // 🔥 SIMPAN ORDER
            $order = Order::create([
                'order_number' => $orderNumber,
                'total' => $total,
                'status' => 'pending',
                'user_id' => $sellerId
            ]);

            // 🔥 SIMPAN ITEMS
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $orders[] = $order;
            $grossAmount += $total;
        }

        // 🔥 MIDTRANS (SATU PAYMENT UNTUK SEMUA ORDER)
        $params = [
            'transaction_details' => [
                'order_id' => 'MULTI-' . time(),
                'gross_amount' => (int) $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->name ?? 'User',
                'email' => $request->email ?? 'user@gmail.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'total' => $grossAmount
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    // 🔥 CALLBACK MIDTRANS
    public function callback(Request $request)
    {
        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found']);
        }

        if ($request->transaction_status == 'settlement') {
            $order->status = 'sukses';
        } elseif ($request->transaction_status == 'pending') {
            $order->status = 'pending';
        } else {
            $order->status = 'gagal';
        }

        $order->save();

        return response()->json(['message' => 'OK']);
    }
}