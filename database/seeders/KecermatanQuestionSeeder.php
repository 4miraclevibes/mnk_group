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
        // Ambil semua exam_subject yang namanya KECERMATAN
        $kecermatanSubjects = \App\Models\ExamSubject::where('name', 'KECERMATAN')->get();

        $questions = [];

        // Untuk setiap subject KECERMATAN, buat 10 kolom
        foreach ($kecermatanSubjects as $subject) {
            for ($i = 1; $i <= 10; $i++) {
                $questions[] = [
                    'exam_subject_id' => $subject->id,
                    'question' => "Kolom {$i}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all questions
        if (!empty($questions)) {
            ExamQuestion::insert($questions);
            $this->command->info('Berhasil membuat ' . count($questions) . ' kolom untuk ' . $kecermatanSubjects->count() . ' subject KECERMATAN');
        } else {
            $this->command->warn('Tidak ada exam_subject dengan nama KECERMATAN!');
        }
    }
}

