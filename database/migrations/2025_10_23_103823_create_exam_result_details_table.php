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
        Schema::create('exam_result_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_result_id')->constrained('exam_results')->onDelete('cascade');
            $table->string('column_name'); // Nama kolom (Kolom 1, Kolom 2, dst)
            $table->integer('correct_count')->default(0); // Jumlah jawaban benar
            $table->integer('wrong_count')->default(0); // Jumlah jawaban salah
            $table->integer('total_answered')->default(0); // Total soal dijawab
            $table->integer('score')->default(0); // Skor untuk kolom ini (benar - salah)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_result_details');
    }
};
