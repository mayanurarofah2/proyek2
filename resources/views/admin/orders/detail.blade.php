@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pesanan</h2>

    <div class="card p-3">
        <h4>🧑 Pembeli</h4>
        <p><b>Nama:</b> {{ $order->user->name }}</p>
        <p><b>Email:</b> {{ $order->user->email }}</p>
        <p><b>Alamat:</b> {{ $order->address }}</p>
        <p><b>No HP:</b> {{ $order->phone }}</p>

        <hr>

        <h4>📦 Produk</h4>
        @foreach($order->items as $item)
            <div>
                {{ $item->product->name }} x {{ $item->quantity }}
            </div>
        @endforeach

        <hr>

        <h4>💰 Total: Rp {{ number_format($order->total) }}</h4>
        <h4>📊 Status: {{ strtoupper($order->status) }}</h4>
    </div>
</div>
@endsection