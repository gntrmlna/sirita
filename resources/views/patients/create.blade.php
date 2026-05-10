@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pasien</h1>
        <p class="text-sm text-gray-500">Masukkan data pasien baru</p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white p-6 rounded-xl shadow-sm border max-w-3xl">

        <form method="POST" action="{{ route('patients.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                

                <!-- NAMA -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">NIK</label>
                    <input type="text" name="nik" placeholder="NIK" value="{{ old('nik', $patient->nik ?? '') }}" 
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- GENDER -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Jenis Kelamin</label>
                    <select name="gender"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- TEMPAT LAHIR -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Tempat Lahir</label>
                    <input type="text" name="birth_place"
                        value="{{ old('birth_place') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- TANGGAL LAHIR -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Tanggal Lahir</label>
                    <input type="date" name="birth_date"
                        value="{{ old('birth_date') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Agama</label>
                    <input type="text" name="religion" placeholder="Agama" value="{{ old('religion', $patient->religion ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Pendidikan</label>
                    <select name="education" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                        <option value="">Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="S1">S1</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Pekerjaan</label>
                    <input type="text" name="job" placeholder="Pekerjaan" value="{{ old('job', $patient->job ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- STATUS -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Status Pernikahan</label>
                    <input type="text" name="marital_status"
                        value="{{ old('marital_status') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- TELEPON -->
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Telepon</label>
                    <input type="text" name="phone"
                        value="{{ old('phone') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- ALAMAT -->
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-600 mb-1">Alamat</label>
                    <textarea name="address"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('address') }}</textarea>
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center">

                <a href="{{ route('patients.index') }}"
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