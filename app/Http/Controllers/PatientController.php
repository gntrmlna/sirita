<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $patients = $query->latest()->get(); // nanti bisa diganti paginate

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'marital_status' => 'required',
            'address' => 'required',
            'phone' => 'required|max:15',
            'nik' => 'nullable|string|max:30',
            'education' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'job' => 'nullable|string|max:100',
        ]);

        $patient = Patient::create($request->all());

        logActivity(
            'create',
            'pasien',
            'Menambahkan pasien ' . $patient->name
        );

        return redirect()->route('patients.index');
    }

    public function show($id)
    {
        $patient = \App\Models\Patient::with('medicalRecords.doctor')->findOrFail($id);

        return view('patients.show', compact('patient'));
    }
}
