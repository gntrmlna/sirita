@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Pasien</h1>
            <p class="text-sm text-gray-500">Daftar pasien terdaftar</p>
        </div>

        <a href="{{ route('patients.create') }}" 
           class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">

        <input type="text" name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama pasien..."
            class="border rounded-lg px-3 py-2 w-full md:w-64">

        <button class="bg-[#1F7A4D] text-white px-4 py-2 rounded-lg">
            Cari
        </button>

    </form>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-4 py-3">No RM</th>
                    <th class="text-left px-4 py-3">Nama</th>
                    <th class="text-left px-4 py-3">Tanggal Lahir</th>
                    <th class="text-center px-4 py-3 w-28">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($patients as $patient)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $patient->medical_record_number }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $patient->name }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center">

                            <a href="{{ route('patients.show', $patient->id) }}"
                               class="text-blue-600 hover:text-blue-700">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">
                        Belum ada data pasien
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection