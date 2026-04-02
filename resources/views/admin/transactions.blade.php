<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f6fa]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md p-6">
        <h2 class="text-2xl font-bold text-orange-500 mb-10">FluffyBake</h2>

        <ul class="space-y-5 text-gray-600">
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="#">Kelola Produk</a></li>
            <li><a href="#">Update Pesanan</a></li>
            <li class="font-semibold text-orange-500">Riwayat Transaksi</li>
            <li><a href="#">Laporan Penjualan</a></li>
            <li><a href="#">Pengaturan</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-10">

        <h1 class="text-3xl font-bold mb-6">Riwayat Transaksi</h1>

        <!-- Statistik -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Transaksi</p>
                <p class="text-2xl font-bold mt-2">
                    {{ $totalOrders }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Pendapatan Bersih</p>
                <p class="text-2xl font-bold mt-2 text-green-600">
                    Rp {{ number_format($totalRevenue) }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Rata-rata Penjualan</p>
                <p class="text-2xl font-bold mt-2">
                    Rp {{ number_format($average) }}
                </p>
            </div>

        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow p-6">

            <div class="flex justify-between mb-6">
                <h2 class="text-lg font-semibold">Daftar Transaksi</h2>
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">
                    Export Laporan
                </button>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-gray-500 text-sm">
                        <th class="py-3">ID</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="border-b">
                        <td class="py-3 font-semibold text-orange-500">
                            #{{ $order->order_number }}
                        </td>
                        <td>
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>
                        <td>
                            <span class="px-3 py-1 rounded-full text-sm
                                {{ $order->status == 'sukses' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="text-right font-semibold">
                            Rp {{ number_format($order->total) }}
                        </td>
                        <td class="text-right">
                            <button class="bg-gray-200 px-3 py-1 rounded-lg text-sm">
                                Cetak Kwitansi
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        </div>

    </div>
</div>

</body>
</html>