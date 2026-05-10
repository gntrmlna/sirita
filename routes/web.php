<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Doctor;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:super_user'])->group(function () {

    Route::resource('doctors', DoctorController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::post('/reports/monthly', [ReportController::class, 'monthly'])
    ->name('reports.monthly');
    Route::post('/reports/personal', [ReportController::class, 'personal'])
    ->name('reports.personal');
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity.logs');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('patients', PatientController::class);

    Route::get('/patients/{patient}/medical-records/create', 
        [MedicalRecordController::class, 'create']
    )->name('medical-records.create');

    Route::post('/patients/{patient}/medical-records', 
        [MedicalRecordController::class, 'store']
    )->name('medical-records.store');   

    Route::get('/medical-records/{record}', 
        [MedicalRecordController::class, 'show']
    )->name('medical-records.show');

    Route::get('/medical-records/{record}/edit', 
    [MedicalRecordController::class, 'edit']
    )->name('medical-records.edit');

    Route::put('/medical-records/{record}', 
        [MedicalRecordController::class, 'update']
    )->name('medical-records.update');

    Route::get('/dashboard', function (Request $request) {

        $month = $request->month;
        $doctorId = $request->doctor_id;

        $query = DB::table('medical_records')
            ->join('disease_categories', 'medical_records.disease_category_id', '=', 'disease_categories.id');

        // kalau ada filter bulan
        if ($month) {
            [$year, $monthNumber] = explode('-', $month);

            $query->whereYear('tanggal_periksa', $year)
                ->whereMonth('tanggal_periksa', $monthNumber);
        }

        if ($doctorId) {
            $query->where('medical_records.doctor_id', $doctorId);
        }

        $diseaseStats = $query
            ->select('disease_categories.name', DB::raw('count(*) as total'))
            ->groupBy('disease_categories.name')
            ->get();

        // total juga ikut filter
        $totalPatients = \App\Models\Patient::count();

        $totalRecordsQuery = \App\Models\MedicalRecord::query();

        if ($month) {
            $totalRecordsQuery->whereYear('tanggal_periksa', $year)
                            ->whereMonth('tanggal_periksa', $monthNumber);
        }

        if ($doctorId) {
            $totalRecordsQuery->where('doctor_id', $doctorId);
        }

        $totalRecords = $totalRecordsQuery->count();

        $doctors = Doctor::all();

        return view('dashboard', compact(
            'diseaseStats',
            'totalPatients',
            'totalRecords',
            'doctors'
        ));

    })->name('dashboard');
    });


require __DIR__.'/auth.php';
