<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi</title>
    <style>
        body { font-family: sans-serif; }

        .container {
            border: 1px solid #000;
            padding: 20px;
        }

        h2 { text-align: center; }

        .info { margin-bottom: 10px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table td {
            padding: 6px;
            border-bottom: 1px solid #ccc;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="container">

    <div style="text-align:center; margin-bottom:10px;">
        <h3>{{ $order->seller->name ?? 'Toko' }}</h3>
        <p style="font-size:12px;">Struk Pembayaran</p>
    </div>

    <h2>KWITANSI PEMBAYARAN</h2>

    <div class="info">
        <b>No:</b> {{ $order->order_number }} <br>
        <b>Tanggal:</b> {{ optional($order->created_at)->format('d M Y') }}
    </div>

    <hr>

    <div class="info">
        <b>Pembeli:</b> {{ $order->buyer->name ?? '-' }} <br>
        <b>Penjual:</b> {{ $order->seller->name ?? '-' }}
    </div>

    <hr>

    <table>
        @foreach($order->items ?? [] as $item)
        <tr>
            <td>
                {{ $item->product->name ?? '-' }} x{{ $item->quantity }}
            </td>
            <td align="right">
                Rp {{ number_format($item->price ?? 0) }}
            </td>
        </tr>
        @endforeach
    </table>

    <hr>

    <div class="total">
        Total: Rp {{ number_format($order->total ?? 0) }}
    </div>

    <div class="footer">
        <p>______________________</p>
        <p>Tanda Tangan</p>
    </div>

</div>

</body>
</html>