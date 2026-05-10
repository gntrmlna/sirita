<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['user_id'];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
