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
        Schema::table('nilai', function (Blueprint $table) {
            // Drop foreign keys and columns
            $table->dropForeign(['mahasiswa_id']);
            $table->dropForeign(['mata_kuliah_id']);
            $table->dropColumn(['mahasiswa_id', 'mata_kuliah_id']);

            // Add krs_detail_id
            $table->foreignId('krs_detail_id')->after('id')->constrained('krs_detail')->onDelete('cascade');

            // Ensure one grade per krs_detail entry
            $table->unique('krs_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            // Drop the new foreign key and column
            $table->dropForeign(['krs_detail_id']);
            $table->dropColumn('krs_detail_id');

            // Add back the old columns
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
        });
    }
};