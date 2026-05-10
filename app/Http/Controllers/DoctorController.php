<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        // 1. buat user login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'operator',
        ]);

        // 2. buat data dokter
        $doctor = Doctor::create([
            'user_id' => $user->id,
            
        ]);

        logActivity('create', 'dokter', 'Menambahkan dokter ' . $user->name);

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan');
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        // update user
        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // kalau ada password
        if ($request->password) {
            $doctor->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        logActivity('update', 'dokter', 'Mengupdate dokter ' . $doctor->user->name);

        return redirect()->route('doctors.index')
            ->with('success', 'Dokter berhasil diupdate');
    }

    public function destroy(Doctor $doctor)
    {
        $name = $doctor->user->name;

        $doctor->delete();

        logActivity(
            'delete',
            'dokter',
            'Menghapus dokter ' . $name
        );
        return back()->with('success', 'Dokter dihapus');
    }
}
