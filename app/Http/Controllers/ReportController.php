<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
        {
            return view('reports.index');
        }

    public function generate(Request $request)
    {
        // 🔹 1. ambil input
        $tanggal = $request->tanggal;

        $ketua = [
            'nama' => $request->ketua_nama,
            'jabatan' => $request->ketua_jabatan,
            'identity_type' => $request->ketua_identity_type,
            'identity_number' => $request->ketua_identity_number,
        ];

        // 🔹 anggota (array)
        $anggota = [];

        if ($request->anggota_nama) {
            foreach ($request->anggota_nama as $i => $nama) {
                if ($nama) {
                    $anggota[] = [
                        'nama' => $nama,
                        'jabatan' => $request->anggota_jabatan[$i] ?? '',
                        'identity_type' => $request->anggota_identity_type[$i] ?? '',
                        'identity_number' => $request->anggota_identity_number[$i] ?? '',
                    ];
                }
            }
        }

        // 🔹 2. ambil data dari SIRITA
        $records = MedicalRecord::with('patient')
            ->whereDate('tanggal_periksa', $tanggal)
            ->get();

        // 🔹 3. hitung jumlah
        $total = $records->count();

        // 🔹 4. format tanggal
        $tanggalFormatted = Carbon::parse($tanggal)->translatedFormat('d F Y');

        // 🔹 5. kirim ke PDF
        $pdf = Pdf::loadView('reports.harian_pdf', compact(
            'records',
            'total',
            'tanggal',
            'tanggalFormatted',
            'ketua',
            'anggota'
        ));

        return $pdf->stream('laporan-harian.pdf');
    }

    public function monthly(Request $request)
    {
        
        $month = $request->month;

        [$year, $monthNumber] = explode('-', $month);

        $records = MedicalRecord::with('patient', 'doctor', 'diseaseCategory')
            ->whereYear('tanggal_periksa', $year)
            ->whereMonth('tanggal_periksa', $monthNumber)
            ->get();


        // TOTAL
        $total = $records->count();

        // GENDER
        $male = $records->filter(function ($r) {
            return $r->patient && $r->patient->gender == 'male';
        })->count();

        $female = $records->filter(function ($r) {
            return $r->patient && $r->patient->gender == 'female';
        })->count();

        // MENULAR
        $menular = $records
            ->filter(function ($r) {

                return $r->diseaseCategory &&
                    strtolower($r->diseaseCategory->name) == 'menular';

            })
            ->count();

        $tidakMenular = $records
            ->filter(function ($r) {

                return $r->diseaseCategory &&
                    strtolower($r->diseaseCategory->name) == 'tidak menular';

            })
            ->count();

        // FORMAT BULAN
        $bulanFormatted = Carbon::create($year, $monthNumber)
            ->translatedFormat('F Y');

        // TANGGAL TTD
        $tanggalFormatted = Carbon::create($year, $monthNumber)
            ->endOfMonth()
            ->translatedFormat('d F Y');

        $pdf = Pdf::loadView('reports.bulanan_pdf', compact(
            'records',
            'month',
            'total',
            'male',
            'female',
            'menular',
            'tidakMenular',
            'bulanFormatted',
            'tanggalFormatted'
        ));

        return $pdf->stream('laporan-bulanan.pdf');
    }

    public function personal(Request $request)
    {
        $month = $request->month;

        [$year, $monthNumber] = explode('-', $month);

        $records = MedicalRecord::with('patient', 'doctor', 'diseaseCategory')
            ->whereYear('tanggal_periksa', $year)
            ->whereMonth('tanggal_periksa', $monthNumber)
            ->get();

        $total = $records->count();

        $menular = $records->where('diseaseCategory.type', 'menular')->count();
        $tidakMenular = $records->where('diseaseCategory.type', 'tidak menular')->count();

        $pdf = Pdf::loadView('reports.personal_pdf', compact(
            'records',
            'month',
            'total',
            'menular',
            'tidakMenular'
        ));

        return $pdf->stream('laporan-pribadi.pdf');
    }
}
