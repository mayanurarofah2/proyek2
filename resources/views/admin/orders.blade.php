<!DOCTYPE html>
<html>
<head>
<title>Update Pesanan</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

<!-- ================= SIDEBAR (DESKTOP) ================= -->
<div class="hidden md:block w-64 bg-white shadow-md p-6">
<h2 class="text-2xl font-bold text-orange-500 mb-10">FluffyBake</h2>

<ul class="space-y-5 text-gray-600">
<li><a href="/admin">Dashboard</a></li>
<li><a href="/admin/products">Kelola Produk</a></li>
<li class="font-semibold text-orange-500">
<a href="/admin/orders">Update Pesanan</a>
</li>
<li><a href="/admin/transactions">Riwayat Transaksi</a></li>
<li><a href="/admin/profile">Profil</a></li>
</ul>
</div>

<!-- ================= CONTENT ================= -->
<div class="flex-1">

<!-- ================= TOP MENU (HP ONLY) ================= -->
<div class="md:hidden bg-white shadow p-4">

<h2 class="text-xl font-bold text-orange-500 mb-3">FluffyBake</h2>

<div class="flex gap-4 overflow-x-auto text-sm">

<a href="/admin" class="whitespace-nowrap text-gray-600">Dashboard</a>

<a href="/admin/products" class="whitespace-nowrap text-gray-600">
Kelola Produk
</a>

<a href="/admin/orders"
class="whitespace-nowrap text-orange-500 font-semibold">
Update Pesanan
</a>

<a href="/admin/transactions" class="whitespace-nowrap text-gray-600">
Riwayat Transaksi
</a>

<a href="/admin/profile" class="whitespace-nowrap text-gray-600">
Profil
</a>

</div>

</div>

<!-- ================= MAIN ================= -->
<div class="p-4 md:p-10">

<h1 class="text-2xl md:text-3xl font-bold mb-6">Update Pesanan</h1>

<div class="bg-white rounded-xl shadow p-4 md:p-6">

<!-- DESKTOP TABLE -->
<div class="hidden md:block">
<table class="w-full text-left">

<thead>
<tr class="border-b text-gray-500">
<th>ID ORDER</th>
<th>TOTAL</th>
<th>STATUS</th>
<th>AKSI</th>
</tr>
</thead>

<tbody>

@foreach($orders as $order)

<tr class="border-b">

<td class="py-3">
#{{ $order->order_number }}
</td>

<td>
Rp {{ number_format($order->total) }}
</td>

<td>
<span class="px-3 py-1 rounded-full text-sm
{{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
{{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-600' : '' }}
{{ $order->status == 'sukses' ? 'bg-green-100 text-green-600' : '' }}">
{{ strtoupper($order->status) }}
</span>
</td>

<td>
<form action="/admin/orders/update/{{ $order->id }}" method="POST">
@csrf

<select name="status" class="border px-2 py-1 rounded">
<option value="pending">Pending</option>
<option value="diproses">Diproses</option>
<option value="sukses">Selesai</option>
</select>

<button class="bg-orange-500 text-white px-3 py-1 rounded ml-2">
Update
</button>

</form>
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

<div class="font-semibold mb-1 text-orange-500">
#{{ $order->order_number }}
</div>

<div class="mb-2 font-medium">
Rp {{ number_format($order->total) }}
</div>

<div class="mb-3">
<span class="px-3 py-1 rounded-full text-sm
{{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
{{ $order->status == 'diproses' ? 'bg-blue-100 text-blue-600' : '' }}
{{ $order->status == 'sukses' ? 'bg-green-100 text-green-600' : '' }}">
{{ strtoupper($order->status) }}
</span>
</div>

<form action="/admin/orders/update/{{ $order->id }}" method="POST" class="space-y-2">
@csrf

<select name="status" class="border w-full px-3 py-2 rounded">
<option value="pending">Pending</option>
<option value="diproses">Diproses</option>
<option value="sukses">Selesai</option>
</select>

<button class="bg-orange-500 text-white w-full py-2 rounded">
Update
</button>

</form>

</div>

@endforeach

</div>

</div>

</div>

</div>

</div>

</body>
</html>