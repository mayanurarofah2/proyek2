<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'address',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi toko (1 user = 1 toko)
    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    // Relasi order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relasi produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}