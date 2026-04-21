<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-4 md:p-10">

<div class="max-w-3xl mx-auto bg-white p-4 md:p-8 rounded shadow">

<h1 class="text-xl md:text-2xl font-bold mb-6">
Edit Produk
</h1>

<form action="{{ route('admin.products.update',$product->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-4">

<label class="block mb-1">Nama Produk</label>

<input type="text"
name="name"
value="{{ $product->name }}"
class="border p-3 w-full rounded">

</div>

<div class="mb-4">

<label class="block mb-1">Harga</label>

<input type="number"
name="price"
value="{{ $product->price }}"
class="border p-3 w-full rounded">

</div>

<div class="mb-4">

<label class="block mb-1">Stock</label>

<input type="number"
name="stock"
value="{{ $product->stock }}"
class="border p-3 w-full rounded">

</div>

<button class="bg-orange-500 text-white px-6 py-3 rounded w-full md:w-auto">
Update Produk
</button>

</form>

</div>

</body>
</html>