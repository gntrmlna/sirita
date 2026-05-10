@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Dokter</h1>
        <p class="text-sm text-gray-500">Masukkan data dokter baru</p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white p-6 rounded-xl shadow-sm border max-w-xl">

        <form method="POST" action="{{ route('doctors.store') }}" class="space-y-5">
            @csrf

            <!-- NAMA -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1F7A4D]">

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Email (Login)</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1F7A4D]">

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#1F7A4D]">

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-2">

                <a href="{{ route('doctors.index') }}"
                   class="text-sm text-gray-500 hover:underline">
                    ← Kembali
                </a>

                <button class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-5 py-2 rounded-lg">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection