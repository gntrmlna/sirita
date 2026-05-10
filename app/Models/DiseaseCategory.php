<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseCategory extends Model
{
    protected $fillable = ['name'];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
