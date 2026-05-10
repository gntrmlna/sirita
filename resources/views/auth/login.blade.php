<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIRITA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/sirita.webp') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT (FORM) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-sm border">

            <!-- LOGO -->
            <div class="flex items-center justify-between mb-6">

                <!-- LOGO KIRI -->
                <img src="{{ asset('images/polda.webp') }}" class="w-16 h-16">

                <!-- LOGO TENGAH (SIRITA) -->
                <div class="flex flex-col items-center gap-2">
                    <!-- <img src="{{ asset('images/sirita.webp') }}" class="w-16 h-16"> -->
                    <!-- <span class="font-bold text-lg text-gray-800">SIRITA</span> -->
                </div>

                <!-- LOGO KANAN -->
                <img src="{{ asset('images/dokkes.webp') }}" class="w-16 h-16">

            </div>

            <!-- TITLE -->
            <h1 class="text-xl font-bold text-gray-800 mb-1">Masuk</h1>
            <p class="text-sm text-gray-500 mb-6">Sistem Rekam Medis Terintegrasi</p>

            <!-- SESSION -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm text-gray-600">Password</label>
                
                    <div class="mt-1 flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-[#1F7A4D]">
                
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full px-3 py-2 border-0 focus:ring-0 focus:outline-none">
                
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="px-3 text-gray-500 hover:text-gray-700">
                
                            👁
                
                        </button>
                
                    </div>
                
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- REMEMBER -->
                <!-- <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember" class="rounded">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-gray-500 hover:underline">
                            Lupa password?
                        </a>
                    @endif
                </div> -->

                <!-- BUTTON -->
                <button class="w-full bg-[#1F7A4D] hover:bg-[#16603c] text-white py-2 rounded-lg">
                    Masuk
                </button>

            </form>

        </div>

    </div>

    <!-- RIGHT (BRANDING) -->
    <div class="hidden md:flex w-1/2 bg-[#0F2E1E] text-white items-center justify-center p-10">

        <div class="text-center max-w-sm">

            <img src="{{ asset('images/sirita.webp') }}" class="w-72 mx-auto mb-2">

            <h2 class="text-2xl font-bold mb-2">
                SIRITA
            </h2>

            <p class="text-sm text-gray-300">
                <b>SISTEM INFORMASI REKAM MEDIS TERINTEGRASI</b> <br>
                Untuk mendukung pelayanan kesehatan yang cepat, akurat, dan efisien.
            </p>

        </div>

    </div>

</div>
<script>

function togglePassword() {

    const password = document.getElementById('password');

    password.type =
        password.type === 'password'
            ? 'text'
            : 'password';

}

</script>
</body>
</html>