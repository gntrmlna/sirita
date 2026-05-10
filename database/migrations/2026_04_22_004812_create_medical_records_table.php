<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('disease_category_id')->constrained()->cascadeOnDelete();

            $table->date('tanggal_periksa');
            $table->foreignId('created_by')->constrained('users');

            // PEMERIKSAAN FISIK
            $table->text('anamnesa')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->integer('spo2')->nullable();

            // HEAD TO TOE - KEPALA
            $table->boolean('conjunctiva_anemic')->default(false);
            $table->boolean('sclera_icteric')->default(false);

            // THORAKS
            $table->boolean('rhonchi')->default(false);
            $table->boolean('wheezing')->default(false);
            $table->boolean('vesicular_breath')->default(false);
            $table->enum('heart_sound', ['regular', 'irregular'])->nullable();

            // ABDOMEN
            $table->boolean('abdominal_tenderness')->default(false);

            // EKSTREMITAS
            $table->string('muscle_strength')->nullable();

            // PENUNJANG
            $table->text('lab_result')->nullable();
            $table->text('xray_result')->nullable();

            // ASSESSMENT
            $table->text('diagnosis');
            
            // PLANNING
            $table->text('treatment_plan')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
