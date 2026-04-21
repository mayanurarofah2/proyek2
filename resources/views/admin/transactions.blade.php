<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f6fa]">

<!-- TOP MENU (HP ONLY) -->
<div class="md:hidden bg-white shadow p-4 mb-4 rounded-lg">

    <h2 class="text-xl font-bold text-orange-500 mb-3">FluffyBake</h2>

    <div class="flex gap-4 overflow-x-auto text-sm">

        <a href="{{ route('admin.dashboard') }}" 
           class="whitespace-nowrap text-gray-600">
            Dashboard
        </a>

        <a href="{{ route('admin.products') }}" 
           class="whitespace-nowrap text-gray-600">
            Kelola Produk
        </a>

        <a href="{{ route('orders.index') }}" 
           class="whitespace-nowrap text-gray-600">
            Update Pesanan
        </a>

        <a href="{{ route('admin.transactions') }}" 
           class="whitespace-nowrap text-orange-500 font-semibold">
            Riwayat Transaksi
        </a>

    </div>

</div>

    <!-- Content -->
    <div class="flex-1 p-4 md:p-10">

        <h1 class="text-2xl md:text-3xl font-bold mb-6">Riwayat Transaksi</h1>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8">

            <div class="bg-white p-4 md:p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Transaksi</p>
                <p class="text-xl md:text-2xl font-bold mt-2">
                    {{ $totalOrders }}
                </p>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-xl shadow">
                <p class="text-gray-500">Pendapatan Bersih</p>
                <p class="text-xl md:text-2xl font-bold mt-2 text-green-600">
                    Rp {{ number_format($totalRevenue) }}
                </p>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-xl shadow">
                <p class="text-gray-500">Rata-rata Penjualan</p>
                <p class="text-xl md:text-2xl font-bold mt-2">
                    Rp {{ number_format($average) }}
                </p>
            </div>

        </div>

        <!-- Table / Card -->
        <div class="bg-white rounded-xl shadow p-4 md:p-6">

            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
                <h2 class="text-lg font-semibold">Daftar Transaksi</h2>
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg w-full md:w-auto">
                    Export Laporan
                </button>
            </div>

            <!-- DESKTOP TABLE -->
            <div class="hidden md:block">
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
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
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
                                <a href="{{ route('kwitansi.cetak', $order->id) }}"
                                   class="bg-[#6b4f4f] text-white px-3 py-1 rounded-lg text-sm hover:bg-[#5a3f3f]">
                                    Cetak Kwitansi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARD -->
            <div class="md:hidden space-y-4">
                @foreach($orders as $order)
                <div class="border rounded-lg p-4 shadow-sm">

                    <div class="font-semibold text-orange-500 mb-1">
                        #{{ $order->order_number }}
                    </div>

                    <div class="text-sm text-gray-500 mb-2">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </div>

                    <div class="mb-2">
                        <span class="px-3 py-1 rounded-full text-sm
                            {{ $order->status == 'sukses' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>

                    <div class="font-semibold mb-3">
                        Rp {{ number_format($order->total) }}
                    </div>

                    <a href="{{ route('kwitansi.cetak', $order->id) }}"
                       class="block text-center bg-[#6b4f4f] text-white py-2 rounded-lg text-sm">
                        Cetak Kwitansi
                    </a>

                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        </div>

    </div>
</div>

</body>
</html>