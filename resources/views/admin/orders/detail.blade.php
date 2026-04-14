<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #F5EFE6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h2 {
            color: orange;
            text-align: center;
        }

        h3 {
            margin-bottom: 10px;
        }

        .label {
            color: #888;
            font-size: 14px;
        }

        .value {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: orange;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: bold;
            color: white;
        }

        .pending {
            background: orange;
        }

        .sukses {
            background: green;
        }

        .gagal {
            background: red;
        }

        .section-title {
            margin-bottom: 10px;
            font-weight: bold;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>📦 Detail Pesanan</h2>

    <!-- PEMBELI -->
    <div class="card">
        <div class="section-title">👤 Pembeli</div>

        <div class="label">Nama</div>
        <div class="value">{{ $order->buyer->name }}</div>

        <div class="label">Email</div>
        <div class="value">{{ $order->buyer->email }}</div>

        <div class="label">No HP</div>
        <div class="value">{{ $order->phone ?? '-' }}</div>

        <div class="label">Alamat</div>
        <div class="value">{{ $order->address ?? '-' }}</div>
    </div>

    <!-- PRODUK -->
    <div class="card">
        <div class="section-title">📦 Produk</div>

        @foreach($order->items as $item)
            <div class="product">
                <div>{{ $item->product->name }} x{{ $item->quantity }}</div>
                <div>Rp {{ number_format($item->price) }}</div>
            </div>
        @endforeach
    </div>

    <!-- TOTAL -->
    <div class="card">
        <div class="section-title">💰 Total</div>
        <div class="total">Rp {{ number_format($order->total) }}</div>
    </div>

    <!-- STATUS -->
    <div class="card">
        <div class="section-title">📊 Status</div>

        <span class="status 
            @if($order->status == 'pending') pending 
            @elseif($order->status == 'sukses') sukses 
            @else gagal 
            @endif
        ">
            {{ strtoupper($order->status) }}
        </span>
    </div>

    <!-- PENJUAL -->
    <div class="card">
        <div class="section-title">🏪 Penjual</div>
        <div class="value">{{ $order->seller->name }}</div>
    </div>

</div>

</body>
</html>