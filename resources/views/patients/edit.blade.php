@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Edit Pasien
        </h1>

        <p class="text-sm text-gray-500">
            Ubah data pasien
        </p>
    </div>

    <!-- FORM -->
    <div class="bg-white rounded-xl shadow-sm border p-6">

        <form
            action="{{ route('patients.update', $patient->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- NAMA -->
                <div>
                    <label class="text-sm text-gray-600">Nama</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $patient->name) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]"
                        required>
                </div>

                <!-- NIK -->
                <div>
                    <label class="text-sm text-gray-600">NIK</label>

                    <input type="text"
                        name="nik"
                        value="{{ old('nik', $patient->nik) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- JK -->
                <div>
                    <label class="text-sm text-gray-600">Jenis Kelamin</label>

                    <select
                        name="gender"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                        <option value="male"
                            {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>

                        <option value="female"
                            {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>
                </div>

                <!-- TEMPAT LAHIR -->
                <div>
                    <label class="text-sm text-gray-600">Tempat Lahir</label>

                    <input type="text"
                        name="birth_place"
                        value="{{ old('birth_place', $patient->birth_place) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- TGL LAHIR -->
                <div>
                    <label class="text-sm text-gray-600">Tanggal Lahir</label>

                    <input type="date"
                        name="birth_date"
                        value="{{ old('birth_date', $patient->birth_date) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- AGAMA -->
                <div>
                    <label class="text-sm text-gray-600">Agama</label>

                    <input type="text"
                        name="religion"
                        value="{{ old('religion', $patient->religion) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- PENDIDIKAN -->
                <div>
                    <label class="text-sm text-gray-600">Pendidikan</label>

                    <input type="text"
                        name="education"
                        value="{{ old('education', $patient->education) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- PEKERJAAN -->
                <div>
                    <label class="text-sm text-gray-600">Pekerjaan</label>

                    <input type="text"
                        name="job"
                        value="{{ old('job', $patient->job) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- TELEPON -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Telepon</label>

                    <input type="text"
                        name="phone"
                        value="{{ old('phone', $patient->phone) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                </div>

                <!-- ALAMAT -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Alamat</label>

                    <textarea
                        name="address"
                        rows="3"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('address', $patient->address) }}</textarea>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('patients.show', $patient->id) }}"
                    class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-50">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-5 py-2 rounded-lg">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection