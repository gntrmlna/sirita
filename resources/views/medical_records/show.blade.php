@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Detail Rekam Medis</h1>
        <p class="text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($record->tanggal_periksa)->format('d M Y') }}
        </p>
    </div>

    <!-- PASIEN -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-lg font-semibold mb-4">Identitas Pasien ( {{ $record->patient->medical_record_number }} )</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">

            
            <div>
                <span class="text-gray-500">NIK</span><br>
                <b>{{ $record->patient->nik }}</b>
            </div>
            <div><span class="text-gray-500">Nama</span><br><b>{{ $record->patient->name }}</b></div>

            <div>
                <span class="text-gray-500">Jenis Kelamin</span><br>
                <b>{{ $record->patient->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Umur</span><br>
                <b>{{ $record->patient->age ?? '-' }} tahun</b>
            </div>

            <div>
                <span class="text-gray-500">Tanggal Lahir</span><br>
                <b>{{ \Carbon\Carbon::parse($record->patient->birth_date)->format('d M Y') }}</b>
            </div>

            <div>
                <span class="text-gray-500">Agama</span><br>
                <b>{{ $record->patient->religion }}</b>
            </div>

             <div>
                <span class="text-gray-500">Pendidikan</span><br>
                <b>{{ $record->patient->education }}</b>
            </div>

             <div>
                <span class="text-gray-500">Pekerjaan</span><br>
                <b>{{ $record->patient->job }}</b>
            </div>

            <div>
                <span class="text-gray-500">Telepon</span><br>
                <b>{{ $record->patient->phone ?? '-' }}</b>
            </div>

        </div>

    </div>

    <!-- INFO PEMERIKSAAN -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-lg font-semibold mb-4">Informasi Pemeriksaan</h2>

        <p><span class="text-gray-500">Dokter:</span> {{ $record->doctor->user->name ?? '-' }}</p>
        <p><span class="text-gray-500">Tanggal:</span> {{ \Carbon\Carbon::parse($record->tanggal_periksa)->locale('id')->translatedFormat('d F Y') }}</p>
    </div>

    <!-- ANAMNESA -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-lg font-semibold mb-4">Anamnesa</h2>
        <p class="text-gray-700">{{ $record->anamnesa ?? '-' }}</p>
    </div>

    <!-- VITAL SIGN -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-lg font-semibold mb-4">Vital Sign</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">

            <div>
                <span class="text-gray-500">Tekanan Darah</span><br>
                <b>{{ $record->blood_pressure ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Suhu</span><br>
                <b>{{ $record->temperature ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Nadi</span><br>
                <b>{{ $record->pulse ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Respirasi</span><br>
                <b>{{ $record->respiratory_rate ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">SpO₂</span><br>
                <b>{{ $record->spo2 ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Tinggi Badan</span><br>
                <b>{{ $record->height ?? '-' }}</b>
            </div>

            <div>
                <span class="text-gray-500">Berat Badan</span><br>
                <b>{{ $record->weight ?? '-' }}</b>
            </div>

        </div>

    </div>

    <!-- PEMERIKSAAN FISIK -->
<div class="bg-white p-6 rounded-xl shadow-sm border">

    <h2 class="text-lg font-semibold mb-4">
        Pemeriksaan Fisik
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

        <!-- <div>
            Konjungtiva:
            <b>
                {{ is_null($record->conjunctiva_anemic) ? '-' : ($record->conjunctiva_anemic ? 'Anemis' : 'Ananemis') }}
            </b>
        </div>

        <div>
            Sklera:
            <b>
                {{ is_null($record->sclera_icteric) ? '-' : ($record->sclera_icteric ? 'Ikterik' : 'Tidak Ikterik') }}
            </b>
        </div>

        <div>
            Pupil:
            <b>
                {{ $record->pupil_type ?? '-' }}

                @if($record->pupil_diameter)
                    ({{ $record->pupil_diameter }})
                @endif
            </b>
        </div>

        <div>
            Rambut:
            <b>{{ $record->hair ?? '-' }}</b>
        </div>

        <div>
            Telinga:
            <b>{{ $record->rhonchi ?? '-' }}</b>
        </div> -->

        <div>
            Kepala:
            <b>{{ $record->rhonchi ?? '-' }}</b>
        </div>

        <div>
            Leher:
            <b>{{ $record->neck ?? '-' }}</b>
        </div>

        <div>
            Thorax:
            <b>{{ $record->thorax ?? '-' }}</b>
        </div>

        <div>
            Abdomen:
            <b>{{ $record->abdomen ?? '-' }}</b>
        </div>

        <div>
            Anogenital:
            <b>{{ $record->anogenital ?? '-' }}</b>
        </div>

        <div>
            Ekstremitas:
            <b>{{ $record->extremities ?? '-' }}</b>
        </div>

        <div>
            Kulit:
            <b>{{ $record->skin ?? '-' }}</b>
        </div>


    </div>

</div>

<!-- PEMERIKSAAN PENUNJANG -->
<div class="bg-white p-6 rounded-xl shadow-sm border">

    <h2 class="text-lg font-semibold mb-4">
        Pemeriksaan Penunjang
    </h2>

    <div class="space-y-6 text-sm">

        @foreach([
            'ekg' => 'EKG',
            'radiology' => 'Radiologi',
            'lab' => 'Laboratorium',
            'usg' => 'USG',
            'other' => 'Lain-lain'
        ] as $field => $label)

        <div class="border rounded-lg p-4">

            <h3 class="font-semibold mb-2">
                {{ $label }}
            </h3>

            <p class="mb-2">
                {{ $record->{$field . '_result'} ?? '-' }}
            </p>

            @if($record->{$field . '_file'})
                <a
                    href="{{ asset('storage/' . $record->{$field . '_file'}) }}"
                    target="_blank"
                    class="text-blue-600 hover:underline">
                    Lihat File
                </a>
            @endif

        </div>

        @endforeach

    </div>

</div>

    <!-- DIAGNOSA -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-lg font-semibold mb-4">Diagnosa</h2>

        <p><span class="text-gray-500">Diagnosa:</span> {{ $record->diagnosis ?? '-' }}</p>
        <p><span class="text-gray-500">Tindakan:</span> {{ $record->tindakan ?? '-' }}</p>
        <p><span class="text-gray-500">Keterangan:</span> {{ $record->keterangan ?? '-' }}</p>
        <p><span class="text-gray-500">Klasifikasi:</span> {{ $record->diseaseCategory->name ?? '-' }}</p>

    </div>

    <!-- ACTION -->
    <div class="flex items-center justify-between">

        <a href="{{ route('patients.show', $record->patient_id) }}"
            class="text-sm text-gray-500 hover:underline">

            ← Kembali

        </a>

    </div>

</div>

@endsection