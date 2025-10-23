<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamQuestion;

class KecermatanQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [];

        // AKPOL - KECERMATAN (exam_subject_id: 13-16)
        // TNI AD AKPOL (id: 13)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 13,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AL AKPOL (id: 14)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 14,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AU AKPOL (id: 15)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 15,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // POLRI AKPOL (id: 16)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 16,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // BINTARA - KECERMATAN (exam_subject_id: 17-20)
        // TNI AD BINTARA (id: 17)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 17,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AL BINTARA (id: 18)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 18,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AU BINTARA (id: 19)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 19,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // POLRI BINTARA (id: 20)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 20,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TAMTAMA - KECERMATAN (exam_subject_id: 21-24)
        // TNI AD TAMTAMA (id: 21)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 21,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AL TAMTAMA (id: 22)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 22,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // TNI AU TAMTAMA (id: 23)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 23,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // POLRI TAMTAMA (id: 24)
        for ($i = 1; $i <= 10; $i++) {
            $questions[] = [
                'exam_subject_id' => 24,
                'question' => "Kolom {$i}",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all questions
        ExamQuestion::insert($questions);
    }
}

