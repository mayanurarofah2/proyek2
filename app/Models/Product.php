<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'stock',
        'image'
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
{
    return $this->hasOne(\App\Models\Shop::class, 'user_id', 'user_id');
}
}