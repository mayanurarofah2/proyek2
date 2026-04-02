<!DOCTYPE html>
<html>
<head>
<title>Kelola Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

<!-- SIDEBAR -->
<div class="w-64 bg-white h-screen shadow">

<div class="p-6 text-2xl font-bold text-orange-500">
FluffyBake
</div>

<ul class="space-y-4 p-6">

<li>
<a href="/admin" class="text-orange-500 font-semibold">
Dashboard
</a>
</li>

<li>
<a href="/admin/products">
Kelola Produk
</a>
</li>

<li>
<a href="/admin/transactions">
Riwayat Transaksi
</a>
</li>

<li>
<a href="/admin/profile">
Profil
</a>
</li>

<hr>

<li class="text-red-500">
<a href="/logout">Logout</a>
</li>

</ul>

</div>


<!-- CONTENT -->
<div class="flex-1 p-10">

<div class="flex justify-between mb-6">

<h1 class="text-2xl font-bold">
Produk Saya
</h1>

<a href="{{ route('admin.products.create') }}"
class="bg-orange-500 text-white px-5 py-2 rounded">
Tambah Produk
</a>

</div>


<table class="w-full bg-white shadow rounded">

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
<img src="/products/{{ $product->image }}" width="80">
@endif

</td>

<td>{{ $product->name }}</td>

<td>
Rp {{ number_format($product->price) }}
</td>

<td>
{{ $product->stock }}
</td>

<td class="space-x-2">

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

</body>
</html>