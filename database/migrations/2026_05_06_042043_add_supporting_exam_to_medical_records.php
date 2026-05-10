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

            // TEXT
            $table->text('ekg_result')->nullable();
            $table->text('radiology_result')->nullable();
            $table->text('lab_result')->nullable()->change();
            $table->text('usg_result')->nullable();
            $table->text('other_result')->nullable();

            // FILE
            $table->string('ekg_file')->nullable();
            $table->string('radiology_file')->nullable();
            $table->string('lab_file')->nullable();
            $table->string('usg_file')->nullable();
            $table->string('other_file')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {

            $table->dropColumn([
                'ekg_result',
                'radiology_result',
                'usg_result',
                'other_result',

                'ekg_file',
                'radiology_file',
                'lab_file',
                'usg_file',
                'other_file',
            ]);

        });
    }
};
