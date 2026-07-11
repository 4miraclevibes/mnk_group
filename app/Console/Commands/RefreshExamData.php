<?php

namespace App\Console\Commands;

use Database\Seeders\KecermatanQuestionSeeder;
use Database\Seeders\TestCategorySeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RefreshExamData extends Command
{
    protected $signature = 'exam:refresh
                            {--force : Lewati konfirmasi interaktif}';

    protected $description = 'Kosongkan lalu seed ulang data ExamType, ExamSubject, ExamQuestion, ExamAnswer, ExamResult, dan ExamResultDetail';

    public function handle(): int
    {
        if (! $this->option('force') && ! $this->confirm('Ini akan menghapus SEMUA data exam (termasuk hasil ujian). Lanjutkan?')) {
            $this->warn('Dibatalkan.');

            return self::FAILURE;
        }

        $this->info('Mengosongkan tabel exam...');

        Schema::disableForeignKeyConstraints();

        // Urutan: child → parent (sesuai foreign key)
        $tables = [
            'exam_result_details',
            'exam_results',
            'exam_answers',
            'exam_questions',
            'exam_subjects',
            'exam_types',
            'test_categories', // dibutuhkan karena ExamType bergantung ke sini & seeder membuat ulang
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
            $this->line("  - truncated: {$table}");
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Menjalankan seeder...');

        $this->callSilent('db:seed', [
            '--class' => TestCategorySeeder::class,
            '--force' => true,
        ]);
        $this->line('  - TestCategorySeeder');

        $this->callSilent('db:seed', [
            '--class' => KecermatanQuestionSeeder::class,
            '--force' => true,
        ]);
        $this->line('  - KecermatanQuestionSeeder');

        $this->newLine();
        $this->info('Refresh data exam selesai.');
        $this->table(
            ['Tabel', 'Jumlah'],
            [
                ['exam_types', DB::table('exam_types')->count()],
                ['exam_subjects', DB::table('exam_subjects')->count()],
                ['exam_questions', DB::table('exam_questions')->count()],
                ['exam_answers', DB::table('exam_answers')->count()],
                ['exam_results', DB::table('exam_results')->count()],
                ['exam_result_details', DB::table('exam_result_details')->count()],
            ]
        );

        return self::SUCCESS;
    }
}
