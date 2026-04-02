<!DOCTYPE html>
<html>
<head>
    <title>Biodata Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e8e2db] min-h-screen flex items-center justify-center">

<div class="w-full max-w-md text-center">

    <h1 class="text-3xl font-bold text-orange-500 mb-6">FluffyBake</h1>
    <h2 class="text-2xl font-bold mb-6">Biodata Penjual</h2>

    <form method="POST" action="{{ route('shop.store') }}" class="space-y-4">
        @csrf

        <!-- ERROR MESSAGE -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-md text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FIXED: name diganti dari store_name jadi name -->
        <input type="text" name="store_name"
    placeholder="Nama Toko"
    class="w-full p-4 bg-[#d8cfc2] rounded-md">

        <textarea name="address"
            placeholder="Alamat toko"
            class="w-full p-4 bg-[#d8cfc2] rounded-md">{{ old('address') }}</textarea>

        <input type="text" name="phone"
            placeholder="No handphone"
            value="{{ old('phone') }}"
            class="w-full p-4 bg-[#d8cfc2] rounded-md">

        <button type="submit"
            class="w-full bg-orange-500 text-white py-3 rounded-md font-bold">
            MASUK
        </button>
    </form>

</div>

</body>
</html>