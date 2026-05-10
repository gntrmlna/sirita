<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pribadi</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 4px; font-size: 11px; }
    </style>
</head>
<body>

<h3 style="margin-bottom:10px;">
 LAPORAN HASIL PEMERIKSAAN KESEHATAN TAHANAN (RME)
</h3>

<p><b>Periode:</b> {{ \Carbon\Carbon::parse($month)->translatedFormat('d F Y') }}</p>
<p><b>Tempat:</b> Rutan/Polres XXX</p>
<p><b>Petugas Medis:</b> Dokter & Tim Kesehatan</p>

<br>

<!-- SUMMARY -->
<p><b>Total Pemeriksaan:</b> {{ $total }}</p>
<p><b>Penyakit Menular:</b> {{ $menular }}</p>
<p><b>Penyakit Tidak Menular:</b> {{ $tidakMenular }}</p>

<br>

<!-- TABLE -->
<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Umur</th>
    <th>JK</th>
    <th>Keluhan</th>
    <th>TD (mmHg)</th>
    <th>Nadi</th>
    <th>Suhu</th>
    <th>RR</th>
    <th>Diagnosa</th>
    <th>Tindakan</th>
    <th>Keterangan</th>
</tr>
</thead>

<tbody>
@foreach($records as $i => $r)
<tr>
    <td>{{ $i + 1 }}</td>

    <!-- Nama -->
    <td>
        {{ $r->patient->gender == 'male' ? 'Tn.' : 'Ny.' }}
        {{ $r->patient->name }}
    </td>

    <!-- Umur -->
    <td>{{ $r->patient->age ?? '-' }} Tahun</td>

    <!-- Jenis Kelamin -->
    <td>
        {{ $r->patient->gender == 'male' ? 'L' : 'P' }}
    </td>

    <!-- Keluhan -->
    <td>{{ $r->anamnesa ?? '-' }}</td>

    <!-- TD -->
    <td>{{ $r->blood_pressure ?? '-' }}</td>

    <!-- Nadi -->
    <td>{{ $r->pulse ?? '-' }}</td>

    <!-- Suhu -->
    <td>{{ $r->temperature ?? '-' }}</td>

    <!-- RR -->
    <td>{{ $r->respiratory_rate ?? '-' }}</td>

    <!-- Diagnosa -->
    <td>{{ $r->diagnosis ?? '-' }}</td>

    <!-- Tindakan -->
    <td>{{ $r->tindakan ?? '-' }}</td>

    <!-- Keterangan tambahan -->
    <td>{{ $r->keterangan ?? '-' }}</td>

</tr>
@endforeach
</tbody>
</table>

</body>
</html>