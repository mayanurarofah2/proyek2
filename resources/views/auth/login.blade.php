<!DOCTYPE html>
<html>
<head>
    <title>Login - FluffyBake</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e8e2db] min-h-screen flex items-center justify-center">

<div class="w-full max-w-md text-center">

    <!-- Logo -->
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-orange-500">Marketplace Ruang Kue</h1>
    </div>

    <h2 class="text-3xl font-bold text-[#3b2f2f] mb-8">LOGIN</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div class="text-left">
            <label class="block text-lg font-semibold text-[#3b2f2f] mb-2">
                Email
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   class="w-full bg-[#d8cfc2] p-4 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="Masukan Email">
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

        <!-- Button Login -->
        <button type="submit"
                class="w-full bg-orange-500 text-white py-3 rounded-md text-lg font-semibold hover:bg-orange-600 transition">
            LOGIN
        </button>

        <!-- Button Registrasi -->
        <a href="{{ route('register') }}"
           class="block w-full bg-orange-400 text-white py-3 rounded-md text-lg font-semibold hover:bg-orange-500 transition">
            Registrasi
        </a>

    </form>

</div>

</body>
</html>