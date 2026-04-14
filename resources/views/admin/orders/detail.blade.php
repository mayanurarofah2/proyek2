<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
</head>

<body>

<h2>📦 Detail Pesanan</h2>

<h3>👤 Pembeli</h3>
<p>Nama: {{ $order->buyer->name }}</p>
<p>Email: {{ $order->buyer->email }}</p>
<p>No HP: {{ $order->phone }}</p>
<p>Alamat: {{ $order->address }}</p>

<hr>

<h3>📦 Produk</h3>
@foreach($order->items as $item)
    <p>{{ $item->product->name }} x {{ $item->quantity }}</p>
@endforeach

<hr>

<h3>💰 Total: Rp {{ number_format($order->total) }}</h3>
<h3>📊 Status: {{ strtoupper($order->status) }}</h3>

</body>
</html>