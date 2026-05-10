<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\DiseaseCategory;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function create(Patient $patient)
    {
        $doctors = \App\Models\Doctor::with('user')->get();
        $categories = DiseaseCategory::all();

        return view('medical_records.create', compact('patient', 'doctors', 'categories'));
    }

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'tanggal_periksa' => 'required|date',
            'doctor_id' => 'required',
            'diagnosis' => 'required',
            'disease_category_id' => 'required',
            'temperature' => 'nullable|numeric',
            // ❌ sebelumnya numeric → salah
            'blood_pressure' => 'nullable|string',
            'pulse' => 'nullable|numeric',
            'respiratory_rate' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            'conjunctiva_anemic' => 'nullable',
            'sclera_icteric' => 'nullable',
            'rhonchi' => 'nullable',
            'wheezing' => 'nullable',
            'heart_sound' => 'nullable',
            'vesicular_breath' => 'nullable',
            'abdominal_tenderness' => 'nullable',
            'muscle_strength' => 'nullable',
            'tindakan' => 'nullable',
            'keterangan' => 'nullable',
            'weight' => 'nullable|numeric|min:1|max:300',
            'height' => 'nullable|numeric|min:30|max:250',
            'pupil_type' => 'nullable|string|max:255',
            'pupil_diameter' => 'nullable|string|max:255',
            'hair' => 'nullable|string|max:255',
            'neck' => 'nullable|string|max:1000',
            'thorax' => 'nullable|string|max:1000',
            'abdomen' => 'nullable|string|max:1000',
            'anogenital' => 'nullable|string|max:1000',
            'extremities' => 'nullable|string|max:1000',
            'skin' => 'nullable|string|max:1000',
            'ekg_result' => 'nullable|string|max:3000',
            'radiology_result' => 'nullable|string|max:3000',
            'lab_result' => 'nullable|string|max:3000',
            'usg_result' => 'nullable|string|max:3000',
            'other_result' => 'nullable|string|max:3000',

            'ekg_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'radiology_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lab_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'usg_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'other_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ekgFile = $request->file('ekg_file')?->store('supporting_exam', 'public');

        $radiologyFile = $request->file('radiology_file')?->store('supporting_exam', 'public');

        $labFile = $request->file('lab_file')?->store('supporting_exam', 'public');

        $usgFile = $request->file('usg_file')?->store('supporting_exam', 'public');

        $otherFile = $request->file('other_file')?->store('supporting_exam', 'public');

        // ✅ FIX: simpan ke variable
        $record = MedicalRecord::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'disease_category_id' => $request->disease_category_id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'anamnesa' => $request->anamnesa,
            'blood_pressure' => $request->blood_pressure,
            'pulse' => $request->pulse,
            'diagnosis' => $request->diagnosis,
            'temperature' => $request->temperature,
            'respiratory_rate' => $request->respiratory_rate,
            'spo2' => $request->spo2,
            'conjunctiva_anemic' => $request->conjunctiva_anemic,
            'sclera_icteric' => $request->sclera_icteric,
            'rhonchi' => $request->rhonchi,
            'wheezing' => $request->wheezing,
            'heart_sound' => $request->heart_sound,
            'vesicular_breath' => $request->vesicular_breath,
            'abdominal_tenderness' => $request->abdominal_tenderness,
            'muscle_strength' => $request->muscle_strength,
            'tindakan' => $request->tindakan,
            'keterangan' => $request->keterangan,
            'weight' => $request->weight,
            'height' => $request->height,
            'pupil_type' => $request->pupil_type,
            'pupil_diameter' => $request->pupil_diameter,
            'hair' => $request->hair,
            'neck' => $request->neck,
            'thorax' => $request->thorax,
            'abdomen' => $request->abdomen,
            'anogenital' => $request->anogenital,
            'extremities' => $request->extremities,
            'skin' => $request->skin,
            'ekg_result' => $request->ekg_result,
            'radiology_result' => $request->radiology_result,
            'lab_result' => $request->lab_result,
            'usg_result' => $request->usg_result,
            'other_result' => $request->other_result,

            'ekg_file' => $ekgFile,
            'radiology_file' => $radiologyFile,
            'lab_file' => $labFile,
            'usg_file' => $usgFile,
            'other_file' => $otherFile,
            'created_by' => Auth::id(),
        ]);

        // ✅ FIX: pakai $patient (lebih aman)
        logActivity(
            'create',
            'rekam medis',
            'Membuat rekam medis pasien ' . $patient->name
        );

        return redirect()->route('patients.show', $patient->id)
            ->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function show(MedicalRecord $record)
    {
        $record->load('patient', 'doctor', 'diseaseCategory');

        return view('medical_records.show', compact('record'));
    }

    public function edit(MedicalRecord $record)
    {
        // ✅ FIX: konsisten dengan create
        $doctors = Doctor::with('user')->get();
        $categories = DiseaseCategory::all();

        return view('medical_records.edit', compact('record', 'doctors', 'categories'));
    }

    public function update(Request $request, MedicalRecord $record)
    {
        $request->validate([
            'tanggal_periksa' => 'required|date',
            'doctor_id' => 'required',
            'diagnosis' => 'required',
            'disease_category_id' => 'required',
            'temperature' => 'nullable|numeric',
            // ❌ sebelumnya numeric → salah
            'blood_pressure' => 'nullable|string',
            'pulse' => 'nullable|numeric',
            'respiratory_rate' => 'nullable|numeric',
            'spo2' => 'nullable|numeric',
            'conjunctiva_anemic' => 'nullable',
            'sclera_icteric' => 'nullable',
            'rhonchi' => 'nullable',
            'wheezing' => 'nullable',
            'heart_sound' => 'nullable',
            'vesicular_breath' => 'nullable',
            'abdominal_tenderness' => 'nullable',
            'muscle_strength' => 'nullable',
            'tindakan' => 'nullable',
            'keterangan' => 'nullable',
            'weight' => 'nullable|numeric|min:1|max:300',
            'height' => 'nullable|numeric|min:30|max:250',
            'pupil_type' => 'nullable|string|max:255',
            'pupil_diameter' => 'nullable|string|max:255',
            'hair' => 'nullable|string|max:255',
            'neck' => 'nullable|string|max:1000',
            'thorax' => 'nullable|string|max:1000',
            'abdomen' => 'nullable|string|max:1000',
            'anogenital' => 'nullable|string|max:1000',
            'extremities' => 'nullable|string|max:1000',
            'skin' => 'nullable|string|max:1000',

            'ekg_result' => 'nullable|string|max:3000',
            'radiology_result' => 'nullable|string|max:3000',
            'lab_result' => 'nullable|string|max:3000',
            'usg_result' => 'nullable|string|max:3000',
            'other_result' => 'nullable|string|max:3000',

            'ekg_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'radiology_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lab_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'usg_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'other_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ekgFile = $request->file('ekg_file')
            ? $request->file('ekg_file')->store('supporting_exam', 'public')
            : $record->ekg_file;

        $radiologyFile = $request->file('radiology_file')
            ? $request->file('radiology_file')->store('supporting_exam', 'public')
            : $record->radiology_file;

        $labFile = $request->file('lab_file')
            ? $request->file('lab_file')->store('supporting_exam', 'public')
            : $record->lab_file;

        $usgFile = $request->file('usg_file')
            ? $request->file('usg_file')->store('supporting_exam', 'public')
            : $record->usg_file;

        $otherFile = $request->file('other_file')
            ? $request->file('other_file')->store('supporting_exam', 'public')
            : $record->other_file;

        $record->update([
            'tanggal_periksa' => $request->tanggal_periksa,
            'doctor_id' => $request->doctor_id,
            'disease_category_id' => $request->disease_category_id,
            'anamnesa' => $request->anamnesa,
            'blood_pressure' => $request->blood_pressure,
            'pulse' => $request->pulse,
            'diagnosis' => $request->diagnosis,
            'temperature' => $request->temperature,
            'respiratory_rate' => $request->respiratory_rate,
            'spo2' => $request->spo2,
            'conjunctiva_anemic' => $request->conjunctiva_anemic,
            'sclera_icteric' => $request->sclera_icteric,
            'rhonchi' => $request->rhonchi,
            'wheezing' => $request->wheezing,
            'heart_sound' => $request->heart_sound,
            'vesicular_breath' => $request->vesicular_breath,
            'abdominal_tenderness' => $request->abdominal_tenderness,
            'muscle_strength' => $request->muscle_strength,
            'tindakan' => $request->tindakan,
            'keterangan' => $request->keterangan,
            'weight' => $request->weight,
            'height' => $request->height,
            'pupil_type' => $request->pupil_type,
            'pupil_diameter' => $request->pupil_diameter,
            'hair' => $request->hair,
            'neck' => $request->neck,
            'thorax' => $request->thorax,
            'abdomen' => $request->abdomen,
            'anogenital' => $request->anogenital,
            'extremities' => $request->extremities,
            'skin' => $request->skin,
            'ekg_result' => $request->ekg_result,
            'radiology_result' => $request->radiology_result,
            'lab_result' => $request->lab_result,
            'usg_result' => $request->usg_result,
            'other_result' => $request->other_result,

            'ekg_file' => $ekgFile,
            'radiology_file' => $radiologyFile,
            'lab_file' => $labFile,
            'usg_file' => $usgFile,
            'other_file' => $otherFile,
        ]);

        logActivity(
            'update',
            'rekam medis',
            'Update rekam medis pasien ' . $record->patient->name
        );

        return redirect()->route('patients.show', $record->patient_id)
            ->with('success', 'Rekam medis berhasil diupdate');
    }
}