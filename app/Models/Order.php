<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id',     // 🔥 pembeli
    'seller_id',   // 🔥 penjual
    'order_number',
    'total',
    'status',
    'phone',
    'address'
];

// 🔥 PEMBELI
public function buyer()
{
    return $this->belongsTo(User::class, 'user_id');
}

// 🔥 PENJUAL
public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}

// 🔥 ITEMS
public function items()
{
    return $this->hasMany(OrderItem::class);
}


}