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
        Schema::table('medical_records', function (Blueprint $table) {

            $table->string('hair')->nullable();
            $table->string('pupil_type')->nullable();
            $table->string('pupil_diameter')->nullable();

            $table->text('neck')->nullable();
            $table->text('thorax')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('anogenital')->nullable();
            $table->text('extremities')->nullable();
            $table->text('skin')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {

            $table->dropColumn([
                'pupil_type',
                'pupil_diamter',
                'hair',
                'neck',
                'thorax',
                'abdomen',
                'anogenital',
                'extremities',
                'skin',
            ]);

        });
    }
};
