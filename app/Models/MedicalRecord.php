<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'disease_category_id',
        'tanggal_periksa',
        'anamnesa',
        'blood_pressure',
        'pulse',
        'respiratory_rate',
        'temperature',
        'spo2',
        'conjunctiva_anemic',
        'sclera_icteric',
        'rhonchi',
        'wheezing',
        'vesicular_breath',
        'heart_sound',
        'abdominal_tenderness',
        'muscle_strength',
        'lab_result',
        'xray_result',
        'diagnosis',
        'treatment_plan',
        'created_by',
        'tindakan',
        'keterangan',
        'weight',
        'height',
        'pupil_type',
        'pupil_diameter',
        'hair',
        'neck',
        'thorax',
        'abdomen',
        'anogenital',
        'extremities',
        'skin',
        'ekg_result',
        'radiology_result',
        'lab_result',
        'usg_result',
        'other_result',

        'ekg_file',
        'radiology_file',
        'lab_file',
        'usg_file',
        'other_file',
    ];

    // RELASI
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function diseaseCategory()
    {
        return $this->belongsTo(DiseaseCategory::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
