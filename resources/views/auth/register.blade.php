<!DOCTYPE html>
<html>
<head>
    <title>Registrasi - FluffyBake</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e8e2db] min-h-screen flex items-center justify-center">

<div class="w-full max-w-md text-center">

    <!-- Logo -->
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-orange-500">Marketplace Ruang Kue</h1>
    </div>

    <h2 class="text-3xl font-bold text-[#3b2f2f] mb-8">REGISTRASI</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Nama -->
        <div class="text-left">
            <label class="block text-lg font-semibold text-[#3b2f2f] mb-2">
                Nama
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   class="w-full bg-[#d8cfc2] p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="Nama Lengkap">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="text-left">
            <label class="block text-lg font-semibold text-[#3b2f2f] mb-2">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   class="w-full bg-[#d8cfc2] p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="Masukan email">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="text-left">
            <label class="block text-lg font-semibold text-[#3b2f2f] mb-2">
                Password
            </label>
            <input type="password"
                   name="password"
                   required
                   class="w-full bg-[#d8cfc2] p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="Masukan password email">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="text-left">
            <label class="block text-lg font-semibold text-[#3b2f2f] mb-2">
                Konfirmasi Password
            </label>
            <input type="password"
                   name="password_confirmation"
                   required
                   class="w-full bg-[#d8cfc2] p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="Ulangi password">
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Registrasi -->
        <button type="submit"
                class="w-full bg-orange-500 text-white py-3 rounded-md text-lg font-semibold hover:bg-orange-600 transition">
            REGISTER
        </button>

        <!-- Link Login -->
        <a href="{{ route('login') }}"
           class="block w-full bg-orange-400 text-white py-3 rounded-md text-lg font-semibold hover:bg-orange-500 transition">
            LOGIN
        </a>

    </form>

</div>

</body>
</html>