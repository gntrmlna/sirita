<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'medical_record_number',
        'name',
        'birth_place',
        'birth_date',
        'gender',
        'marital_status',
        'address',
        'phone',
        'nik',
        'education',
        'religion',
        'job',
    ];

    // RELASI
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function getAgeAttribute()
    {
        return $this->birth_date
            ? Carbon::parse($this->birth_date)->age
            : null;
    }

    // AUTO GENERATE NOMOR RM 🔥
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $last = self::latest()->first();
            $number = $last ? ((int) substr($last->medical_record_number, -6)) + 1 : 1;

            $patient->medical_record_number = 'RM-' . str_pad($number, 6, '0', STR_PAD_LEFT);
        });
    }
}
