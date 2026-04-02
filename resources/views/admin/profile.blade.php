<!DOCTYPE html>
<html>
<head>

<title>Profil Toko</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f6fa;
font-family:'Segoe UI',sans-serif;
}

.banner{
height:150px;
background:linear-gradient(135deg,#ff7a00,#ffb347);
border-radius:15px 15px 0 0;
}

.profile-card{
border-radius:15px;
overflow:hidden;
box-shadow:0 8px 25px rgba(0,0,0,0.1);
background:white;
}

.logo{
width:120px;
height:120px;
border-radius:50%;
object-fit:cover;
border:5px solid white;
margin-top:-60px;
background:white;
}

.stat-card{
background:#fff7f0;
border-radius:10px;
padding:15px;
text-align:center;
}

.stat-number{
font-size:22px;
font-weight:700;
color:#ff7a00;
}

.btn-update{
background:#ff7a00;
border:none;
padding:10px 30px;
font-weight:600;
border-radius:8px;
}

.btn-update:hover{
background:#ff5c00;
}

</style>

</head>

<body>

<div class="container mt-5" style="max-width:900px">

<div class="profile-card">

<div class="banner"></div>

<div class="text-center">

@if($shop->photo)
<img src="/uploads/{{ $shop->photo }}" class="logo">
@else
<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="logo">
@endif

<h4 class="mt-2">{{ $shop->store_name }}</h4>
<p class="text-muted">{{ auth()->user()->email }}</p>

</div>

<hr>

<!-- Statistik Toko -->

<div class="row text-center px-4 mb-4">

<div class="col-md-4">

<div class="stat-card">
Produk
<div class="stat-number">{{ auth()->user()->products()->count() }}</div>
</div>

</div>

<div class="col-md-4">

<div class="stat-card">
Pesanan
<div class="stat-number">{{ auth()->user()->orders()->count() }}</div>
</div>

</div>

<div class="col-md-4">

<div class="stat-card">
Pendapatan
<div class="stat-number">
Rp {{ number_format(auth()->user()->orders()->sum('total')) }}
</div>
</div>

</div>

</div>

<hr>

<!-- Form Edit Profil -->

<div class="p-4">

<h5 class="mb-3">Edit Profil Toko</h5>

<form action="{{ route('shop.profile.update') }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Logo Toko</label>
<input type="file" name="photo" class="form-control">
</div>

<div class="mb-3">
<label>Nama Toko</label>
<input type="text"
name="store_name"
value="{{ $shop->store_name }}"
class="form-control">
</div>

<div class="mb-3">
<label>Alamat</label>
<textarea name="address"
class="form-control"
rows="3">{{ $shop->address }}</textarea>
</div>

<div class="mb-3">
<label>No HP</label>
<input type="text"
name="phone"
value="{{ $shop->phone }}"
class="form-control">
</div>

<div class="text-end">

<button class="btn btn-update">
Update Profil
</button>

</div>

</form>

</div>

</div>

</div>

</body>
</html>