<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-4 md:p-10">

<div class="max-w-3xl mx-auto bg-white p-4 md:p-8 rounded shadow">

<h1 class="text-xl md:text-2xl font-bold mb-6">Tambah Produk</h1>

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
<label class="block mb-1">Nama Produk</label>
<input type="text" name="name"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
<label class="block mb-1">Harga</label>
<input type="number" name="price"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
<label class="block mb-1">Stock</label>
<input type="number" name="stock"
class="w-full border p-3 rounded">
</div>

<div class="mb-4">
<label class="block mb-1">Foto Produk</label>
<input type="file" name="image"
class="w-full border p-3 rounded bg-white">
</div>

<button class="bg-orange-500 text-white px-6 py-3 rounded w-full md:w-auto">
Simpan Produk
</button>

</form>

</div>

</body>
</html>