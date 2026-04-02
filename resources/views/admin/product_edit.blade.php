<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-2xl font-bold mb-6">
Edit Produk
</h1>

<form action="{{ route('admin.products.update',$product->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-4">

<label>Nama Produk</label>

<input type="text"
name="name"
value="{{ $product->name }}"
class="border p-2 w-full">

</div>

<div class="mb-4">

<label>Harga</label>

<input type="number"
name="price"
value="{{ $product->price }}"
class="border p-2 w-full">

</div>

<div class="mb-4">

<label>Stock</label>

<input type="number"
name="stock"
value="{{ $product->stock }}"
class="border p-2 w-full">

</div>

<button class="bg-orange-500 text-white px-6 py-2 rounded">
Update Produk
</button>

</form>

</body>
</html>