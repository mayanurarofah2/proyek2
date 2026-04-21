<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#f5f6fa]">

<div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white shadow-md p-4 md:p-6 md:h-auto overflow-x-auto">
        <h2 class="text-2xl font-bold text-orange-500 mb-6 md:mb-10">Ruang Kue</h2>

       <ul class="flex md:flex-col gap-4 md:space-y-5 text-gray-600 overflow-x-auto">
            <li class="font-semibold text-orange-500 whitespace-nowrap">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="whitespace-nowrap">
                <a href="/admin/products">Kelola Produk</a>
            </li>
            <li class="whitespace-nowrap">
                <a href="/admin/orders">Update Pesanan</a>
            </li>
            <li class="whitespace-nowrap">
                <a href="/admin/transactions" class="hover:text-orange-500">
                    Riwayat Transaksi
                </a>
            </li>
            <li class="whitespace-nowrap"><a href="#">Laporan Penjualan</a></li>
            <li class="whitespace-nowrap">
                <a href="/admin/profile" class="hover:text-orange-500">
                    Profil
                </a>
            </li>

            <li class="pt-2 md:pt-6 border-t whitespace-nowrap">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-4 md:p-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Laporan Penjualan</h1>
                <p class="text-gray-500">Analisa performa penjualan Ruang Kue.</p>
            </div>

            <a href="{{ route('laporan.export') }}"
               class="bg-[#6b4f4f] text-white px-6 py-2 rounded-lg shadow hover:bg-[#5a3f3f] transition w-full md:w-auto text-center">
                Cetak Laporan
            </a>
        </div>

        <!-- Filter -->
        <div class="bg-white p-4 md:p-6 rounded-xl shadow mb-8">
            <p class="text-sm text-gray-500 mb-3">PILIH PERIODE</p>

            <div class="flex flex-col md:flex-row gap-4">
                <input type="date" class="border rounded-lg px-4 py-2 w-full md:w-60">
                <input type="date" class="border rounded-lg px-4 py-2 w-full md:w-60">

                <button class="bg-gray-300 px-5 py-2 rounded-lg w-full md:w-auto">
                    Tampilkan Data
                </button>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Pendapatan</p>
                <p class="text-2xl font-bold mt-2 text-green-600">
                    Rp {{ number_format($totalRevenue) }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Pesanan Selesai</p>
                <p class="text-2xl font-bold mt-2">
                    {{ $totalOrders }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Produk Terjual</p>
                <p class="text-2xl font-bold mt-2">
                    {{ $totalProducts }}
                </p>
            </div>

        </div>

        <!-- Grafik -->
        <div class="bg-white rounded-xl shadow p-4 md:p-6 mb-10">
            <h2 class="text-lg font-semibold mb-4">Grafik Penjualan Harian</h2>

            <div class="w-full overflow-x-auto">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow p-4 md:p-6">

            <div class="flex justify-between mb-4">
                <h2 class="text-lg font-semibold">Rincian Transaksi</h2>
                <a href="#" class="text-gray-500 text-sm">Lihat Semua →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[600px]">

                    <thead>
                        <tr class="border-b text-gray-500 text-sm">
                            <th class="py-3">ID TRANSAKSI</th>
                            <th>TANGGAL</th>
                            <th>STATUS</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="py-3">#{{ $order->order_number }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-sm
                                    {{ $order->status == 'sukses' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="font-semibold text-right">
                                Rp {{ number_format($order->total) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>

<script>
    const ctx = document.getElementById('salesChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Pendapatan',
                data: [1000000, 3000000, 1500000, 4000000],
                borderColor: '#6b4f4f',
                backgroundColor: 'rgba(107,79,79,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            }
        }
    });
</script>

</body>
</html>