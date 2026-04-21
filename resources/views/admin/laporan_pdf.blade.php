<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Laporan Penjualan</h2>

<p>Nama Toko: {{ $user->name }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $i => $order)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>
                @foreach($order->items as $item)
                    {{ $item->product->name }} x{{ $item->quantity }}<br>
                @endforeach
            </td>
            <td>Rp {{ number_format($order->total) }}</td>
            <td>{{ strtoupper($order->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Total Pendapatan: Rp {{ number_format($totalRevenue) }}</h3>

</body>
</html>