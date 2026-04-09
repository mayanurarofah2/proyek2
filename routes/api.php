<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

//baru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//

use App\Http\Controllers\Api\ProductController;

use App\Models\Shop;

use App\Http\Controllers\Api\PaymentController;

Route::post('/payment', [PaymentController::class, 'createTransaction']);
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

Route::get('/shops', function () {
    return Shop::with('user')->get();
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/shop/{user_id}', function ($user_id) {
    return \App\Models\Product::with('user.shop')
        ->where('user_id', $user_id)
        ->get();
});

// 🔥 REGISTER
Route::post('/register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    return response()->json([
        'status' => true,
        'user' => $user
    ]);
});

// 🔥 LOGIN
Route::post('/login', function (Request $request) {

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Login gagal'
        ], 401);
    }

    return response()->json([
        'status' => true,
        'user' => $user
    ]);

});
Route::get('/orders/{user_id}', function ($user_id) {
    return \App\Models\Order::with(['items.product', 'user.shop'])
        ->where('user_id', $user_id)
        ->get();
});