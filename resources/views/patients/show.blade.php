@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- IDENTITAS PASIEN -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Identitas Pasien ( {{ $patient->medical_record_number }} )
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">

            <div>
                <span class="text-gray-500">Nama</span><br>
                <b>{{ $patient->name }}</b>
            </div>

            <div>
                <span class="text-gray-500">NIK</span><br>
                <b>{{ $patient->nik }}</b>
            </div>

            <div>
                <span class="text-gray-500">Jenis Kelamin</span><br>
                <b>{{ $patient->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Umur</span><br>
                <b>{{ $patient->age ?? '-' }} tahun</b>
            </div>

            <div>
                <span class="text-gray-500">Tanggal Lahir</span><br>
                <b>{{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}</b>
            </div>

            <div>
                <span class="text-gray-500">Tempat Lahir</span><br>
                <b>{{ $patient->birth_place ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Agama</span><br>
                <b>{{ $patient->religion }}</b>
            </div>

             <div>
                <span class="text-gray-500">Pendidikan</span><br>
                <b>{{ $patient->education }}</b>
            </div>

             <div>
                <span class="text-gray-500">Pekerjaan</span><br>
                <b>{{ $patient->job }}</b>
            </div>

            <div>
                <span class="text-gray-500">Alamat</span><br>
                <b>{{ $patient->address ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Telepon</span><br>
                <b>{{ $patient->phone ?? '-' }}</b>
            </div>

        </div>

    </div>

    <!-- HEADER RIWAYAT -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Riwayat Rekam Medis
            </h2>
            <p class="text-sm text-gray-500">Data pemeriksaan pasien</p>
        </div>

        <a href="{{ route('medical-records.create', $patient->id) }}"
           class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah
        </a>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="text-left px-4 py-3">Tanggal</th>
                    <th class="text-left px-4 py-3">Dokter</th>
                    <th class="text-left px-4 py-3">Diagnosa</th>
                    <th class="text-center px-4 py-3 w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($patient->medicalRecords as $record)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 text-gray-700">
                        {{ \Carbon\Carbon::parse($record->tanggal_periksa)->locale('id')->translatedFormat('d F Y') }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $record->doctor->user->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $record->diagnosis }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-3">

                        <!-- DETAIL -->
                        <a href="{{ route('medical-records.show', $record->id) }}"
                            class="text-blue-600 hover:text-blue-700">

                            <i data-lucide="eye" class="w-4 h-4"></i>

                        </a>

                        <!-- EDIT -->
                        <a href="{{ route('medical-records.edit', $record->id) }}"
                            class="text-yellow-600 hover:text-yellow-700">

                            <i data-lucide="pencil" class="w-4 h-4"></i>

                        </a>

                        <!-- DELETE -->
                        @if(auth()->user()->role === 'super_user')

                        <form
                            action="{{ route('medical-records.destroy', $record->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus rekam medis ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-700">

                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                            </button>

                        </form>

                        @endif

                    </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">
                        Belum ada rekam medis
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

</div>

@endsection