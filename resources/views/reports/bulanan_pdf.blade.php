<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bulanan</title>

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
    <div style="font-size:14px; font-weight:bold; border-bottom:2px solid black; display:inline-block;">
        LAPORAN BULANAN HASIL PELAKSANAAN KEGIATAN RIKKES TAHANAN
    </div>
</div>

<!-- I -->
<p><b>I. PENDAHULUAN</b></p>

<p>
Dalam rangka pelaksanaan pelayanan kesehatan terhadap tahanan serta pemantauan kondisi kesehatan tahanan secara berkala, telah dilaksanakan kegiatan Pemeriksaan Kesehatan Tahanan (Rikkes Tahanan) selama bulan {{ $bulanFormatted }} pada ruang tahanan Direktorat Tahanan Dan Barang Bukti Polda Papua Barat.
</p>

<p>
Kegiatan ini bertujuan untuk:
</p>

<ol>
    <li>Mengetahui kondisi kesehatan tahanan;</li>
    <li>Melakukan deteksi dini penyakit menular dan tidak menular;</li>
    <li>Mencegah terjadinya penularan penyakit di ruang tahanan;</li>
    <li>Memberikan pelayanan medis dan tindak lanjut terhadap tahanan yang sakit.</li>
</ol>

<!-- II -->
<p><b>II. RUJUKAN</b></p>

<p>
a. Undang-Undang Nomor 2 Tahun 2002 tentang Kepolisian Negara Republik Indonesia;
</p>

<p>
b. Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 4 Tahun 2015;
</p>

<p>
c. Rencana Kerja Biddokkes Polda Papua Barat T.A {{ now()->year }};
</p>

<!-- III -->
<p><b>III. PELAKSANAAN KEGIATAN</b></p>

<p><b>A. Waktu Pelaksanaan</b></p>

<p>
Tanggal 1 s.d {{ \Carbon\Carbon::createFromDate(null, explode('-', $month)[1], 1)->endOfMonth()->format('d') }}
{{ $bulanFormatted }}
</p>

<p><b>B. Tempat</b></p>

<p>
Ruang Tahanan Direktorat Tahanan Dan Barang Bukti Polda Papua Barat
</p>

<p><b>C. Petugas Pelaksana</b></p>

<ol>
    <li>Dokter Pemeriksa</li>
    <li>Perawat</li>
    <li>Operator Rekam Medis Elektronik</li>
    <li>Petugas Tahti</li>
</ol>

<p><b>D. Kegiatan Yang Dilakukan</b></p>

<ol>
    <li>Anamnesis</li>
    <li>Pemeriksaan tanda vital</li>
    <li>Pemeriksaan fisik</li>
    <li>Pemeriksaan penunjang (bila diperlukan)</li>
    <li>Diagnosa</li>
    <li>Pemberian obat dan vitamin</li>
    <li>Skrining penyakit menular</li>
    <li>Skrining penyakit tidak menular</li>
</ol>

<!-- IV -->
<p><b>IV. HASIL KEGIATAN</b></p>

<p><b>A. Jumlah Tahanan Yang Diperiksa</b></p>

<table>
    <tr>
        <th>No</th>
        <th>Uraian</th>
        <th>Jumlah</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Jumlah Seluruh Tahanan Diperiksa</td>
        <td>{{ $total }} Orang</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Laki-laki</td>
        <td>{{ $male }} Orang</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Perempuan</td>
        <td>{{ $female }} Orang</td>
    </tr>

</table>

<br>

<p><b>B. Hasil Pemeriksaan Penyakit</b></p>

    <table>

        <tr>
            <th>No</th>
            <th>Jenis Penyakit</th>
            <th>Jumlah</th>
        </tr>

        <tr>
            <td>1</td>
            <td>Penyakit Menular</td>
            <td>{{ $menular }} Orang</td>
        </tr>

        <tr>
            <td>2</td>
            <td>Penyakit Tidak Menular</td>
            <td>{{ $tidakMenular }} Orang</td>
        </tr>

    </table>

<!-- V -->
<p><b>V. PENUTUP</b></p>

<p>
Demikian laporan pelayanan pemeriksaan kesehatan tahanan bulan {{ $bulanFormatted }} di Direktorat Tahanan Dan Barang Bukti oleh personil Biddokkes Polda Papua Barat dibuat dengan sebenarnya sebagai bahan laporan kepada Pimpinan dan pertanggungjawaban pelaksanaan tugas.
</p>

<br><br>

<table class="no-border">

    <tr>

        <td style="width:60%"></td>

        <td>

            Manokwari, {{ $tanggalFormatted }}
            <br><br>

            PS PAUR I SUBBIDDOKPOL
            <br>
            BIDDOKKES POLDA PAPUA BARAT

            <br><br><br><br>

            <b>dr. YENNY RIANI</b>
            <br>

            PENATA
            <br>

            NIP 199001222022022001

        </td>

    </tr>

</table>

</body>
</html>