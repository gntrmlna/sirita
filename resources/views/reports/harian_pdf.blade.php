<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Harian</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .text-center { text-align: center; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 4px;
            font-size: 11px;
        }

        .no-border,
        .no-border th,
        .no-border td {
            border: none !important;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div style="display:inline-block; text-align:center; margin-left:0; margin-bottom:20px;">
    <div style="font-size:14px;">
        KEPOLISIAN NEGARA REPUBLIK INDONESIA
    </div>

    <div style="font-size:14px;">
        DAERAH PAPUA BARAT
    </div>

    <div style="font-size:14px; border-bottom:2px solid black; display:inline-block; padding-bottom:2px;">
        BIDANG KEDOKTERAN DAN KEPOLISIAN
    </div>
</div>

<!-- <div style="text-align:center; margin:15px 0;">
    <img src="{{ public_path('images/logo.png') }}" style="width:80px;">
</div> -->
<div style="text-align:center; margin-bottom:20px;">
    <div style="font-size:14px; font-weight:bold; border-bottom:2px solid black; display:inline-block; padding-bottom:2px;">
        LAPORAN HASIL PELAKSANAAN KEGIATAN RIKKES TAHANAN
    </div>
</div>

<!-- RUJUKAN -->
<p><b>I. RUJUKAN :</b></p>
<p>a. Undang-Undang Nomor 2 Tahun 2002 tentang Kepolisian Negara Republik Indonesia;</p>
<p>b. Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 4 Tahun 2015;</p>
<p>c. Rencana Kerja Biddokkes Polda Papua Barat;</p>

<!-- PELAKSANAAN -->
<p><b>II. PELAKSANAAN :</b></p>

<p><b>A. Personel :</b></p>

<table class="no-border">
<tr>
    <td>1. Katim</td>
    <td>:</td>
    <td>{{ $ketua['nama'] }} – {{ $ketua['jabatan'] }}
<br>
{{ $ketua['identity_type'] }} {{ $ketua['identity_number'] }}</td>
</tr>

<tr>
    <td>2. Anggota</td>
    <td style="vertical-align: top;">:</td>
    <td>
        @foreach($anggota as $a)
            - {{ $a['nama'] }} – ({{ $a['identity_type'] }} {{ $a['identity_number'] }})<br>
        @endforeach
    </td>
</tr>
</table>

<p><b>B. Waktu dan tempat :</b></p>
<p>Tanggal {{ $tanggalFormatted }} di Direktorat Tahanan dan Barang Bukti Polda Papua Barat.</p>

<p><b>C. Sasaran :</b></p>
<p>Melakukan pemeriksaan dan pemberian obat terhadap tahanan di Direktorat Tahanan dan Barang Bukti Polda Papua Barat.</p>

<p><b>D. Kegiatan yang dilakukan :</b></p>

<p>
Pukul 09.00 WIT tim rikkes tahanan melaksanakan kegiatan pemeriksaan kesehatan kepada para tahanan.
Pemeriksaan meliputi anamnesa, pemeriksaan fisik, dan pemberian obat.
</p>

<p>
Jumlah tahanan yang diperiksa berjumlah <b>{{ $total }}</b> orang dengan hasil pemeriksaan sebagai berikut:
</p>

<!-- TABEL -->
<table style="width:100%; border-collapse:collapse; font-size:10px;">

    <thead>

        <tr>

            <th>No</th>

            <th>Nama</th>

            <th>Umur</th>

            <th>JK</th>

            <th>TD</th>

            <th>Nadi</th>

            <th>Suhu</th>

            <th>RR</th>

            <th>SpO2</th>

            <th>TB</th>

            <th>BB</th>

            <th>Keluhan</th>

            <th>Diagnosa</th>

            <th>Keterangan</th>

        </tr>

    </thead>

    <tbody>

        @foreach($records as $i => $r)

        @php

            $birth = \Carbon\Carbon::parse($r->patient->birth_date);

            $years = $birth->diffInYears(now());

            $months = $birth->copy()
                ->addYears($years)
                ->diffInMonths(now());

        @endphp

        <tr>

            <td>{{ $i + 1 }}</td>

            <!-- NAMA -->
            <td>

                {{ $r->patient->name ?? '-' }}

            </td>

            <!-- UMUR -->
            <td>

                {{ $years }} th
                {{ $months }} bln

            </td>

            <!-- JK -->
            <td>

                @if(($r->patient->gender ?? '') == 'male')
                    L
                @else
                    P
                @endif

            </td>

            <!-- TD -->
            <td>{{ $r->blood_pressure ?? '-' }}</td>

            <!-- NADI -->
            <td>{{ $r->pulse ?? '-' }}</td>

            <!-- SUHU -->
            <td>{{ $r->temperature ?? '-' }}</td>

            <!-- RR -->
            <td>{{ $r->respiratory_rate ?? '-' }}</td>

            <!-- SPO2 -->
            <td>{{ $r->spo2 ?? '-' }}</td>

            <!-- TB -->
            <td>

                {{ $r->height ?? '-' }}

            </td>

            <!-- BB -->
            <td>

                {{ $r->weight ?? '-' }}

            </td>

            <!-- KELUHAN -->
            <td>

                {{ $r->anamnesa ?? '-' }}

            </td>

            <!-- DIAGNOSA -->
            <td>

                {{ $r->diagnosis ?? '-' }}

            </td>

            <!-- KETERANGAN -->
            <td>

                {{ $r->keterangan ?? '-' }}

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<p>
Pelaksanaan kegiatan pemeriksaan kesehatan tahanan dapat dilaksanakan dengan lancar tanpa hambatan berarti.
</p>

<!-- PENUTUP -->
<p><b>IV. PENUTUP</b></p>

<p>
Demikian laporan ini dibuat sebagai bahan laporan kepada pimpinan.
</p>

<br><br>

<table class="no-border">
<tr>
    <td style="width: 60%"></td>
    <td>
        Manokwari, {{ $tanggalFormatted }}<br>
        KATIM PEMERIKSA<br><br><br><br>

        <b>{{ $ketua['nama'] }}</b><br>
        {{ $ketua['jabatan'] }}<br>
        {{ $ketua['identity_type'] }} {{ $ketua['identity_number'] }}
    </td>
</tr>
</table>

</body>
</html>