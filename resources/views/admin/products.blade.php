<!DOCTYPE html>
<html>
<head>
<title>Kelola Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col md:flex-row">

<!-- SIDEBAR -->
<div class="w-full md:w-64 bg-white shadow md:h-screen p-4 md:p-6 overflow-x-auto">

<div class="text-2xl font-bold text-orange-500 mb-4 md:mb-10">
FluffyBake
</div>

<ul class="flex md:flex-col gap-4 md:space-y-4 text-gray-600 overflow-x-auto">

<li class="whitespace-nowrap">
<a href="/admin" class="text-orange-500 font-semibold">
Dashboard
</a>
</li>

<li class="whitespace-nowrap">
<a href="/admin/products">
Kelola Produk
</a>
</li>

<li class="whitespace-nowrap">
<a href="/admin/transactions">
Riwayat Transaksi
</a>
</li>

<li class="whitespace-nowrap">
<a href="/admin/profile">
Profil
</a>
</li>

<hr class="hidden md:block">

<li class="text-red-500 whitespace-nowrap">
<a href="/logout">Logout</a>
</li>

</ul>

</div>


<!-- CONTENT -->
<div class="flex-1 p-4 md:p-10">

<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

<h1 class="text-xl md:text-2xl font-bold">
Produk Saya
</h1>

<a href="{{ route('admin.products.create') }}"
class="bg-orange-500 text-white px-5 py-2 rounded w-full md:w-auto text-center">
Tambah Produk
</a>

</div>

<!-- TABLE WRAPPER -->
<div class="overflow-x-auto">
<table class="w-full bg-white shadow rounded min-w-[650px]">

<tr class="border-b font-bold text-left">
<td class="p-3">Foto</td>
<td>Nama</td>
<td>Harga</td>
<td>Stock</td>
<td>Aksi</td>
</tr>

@foreach($products as $product)

<tr class="border-b">

<td class="p-3">
@if($product->image)
<img src="/products/{{ $product->image }}" class="w-16 md:w-20 rounded">
@endif
</td>

<td class="whitespace-nowrap">{{ $product->name }}</td>

<td class="whitespace-nowrap">
Rp {{ number_format($product->price) }}
</td>

<td>
{{ $product->stock }}
</td>

<td class="space-x-2 whitespace-nowrap">

<a href="{{ route('admin.products.edit',$product->id) }}"
class="bg-blue-500 text-white px-3 py-1 rounded">
Edit
</a>

<form action="{{ route('admin.products.delete',$product->id) }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button
class="bg-red-500 text-white px-3 py-1 rounded"
onclick="return confirm('Hapus produk?')">

Hapus

</button>

</form>

</td>

</tr>

@endforeach

</table>
</div>

</div>

</body>
</html>