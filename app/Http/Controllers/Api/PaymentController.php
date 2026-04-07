<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

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
        $orderNumber = 'ORDER-' . time();

        $order = Order::create([
            'order_number' => $orderNumber,
            'total' => (int) $request->total,
            'status' => 'pending',
            'user_id' => $request->user_id
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderNumber,
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => $request->name ?? 'User',
                'email' => $request->email ?? 'user@gmail.com',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'order_number' => $orderNumber
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    // 🔥 CALLBACK
    public function callback(Request $request)
    {
        

        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found']);
        }

        if ($request->transaction_status == 'settlement') {
            $order->status = 'paid';
        } elseif ($request->transaction_status == 'pending') {
            $order->status = 'pending';
        } else {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['message' => 'OK']);
    }
}