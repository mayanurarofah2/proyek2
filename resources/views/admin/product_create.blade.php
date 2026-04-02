<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">

@csrf

<div class="mb-4">
Nama Produk
<input type="text" name="name"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
Harga
<input type="number" name="price"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
Stock
<input type="number" name="stock"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
Foto Produk
<input type="file" name="image"
class="w-full border p-3 rounded">
</div>

<button class="bg-orange-500 text-white px-6 py-3 rounded">
Simpan Produk
</button>

</form>

</body>
</html>