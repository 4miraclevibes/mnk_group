<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSubject;
use App\Models\ExamResult;
use App\Models\ExamResultDetail;
use Illuminate\Support\Facades\Auth;

class KecermatanController extends Controller
{
    public function show($id)
    {
        $exam = ExamSubject::with([
            'examType.testCategory',
            'examQuestions.examAnswers'
        ])->findOrFail($id);

        // Generate 50 pola untuk setiap kolom
        $columns = [];
        foreach ($exam->examQuestions as $question) {
            $columnData = [
                'name' => $question->question, // kolom 1, kolom 2, dst
                'patterns' => []
            ];

            // Generate 50 pola berdasarkan jawaban yang ada
            $answers = $question->examAnswers;
            for ($i = 0; $i < 50; $i++) {
                // Shuffle jawaban dan pilih satu untuk di-hide
                $shuffledAnswers = $answers->shuffle();
                $hiddenIndex = rand(0, $shuffledAnswers->count() - 1);

                $pattern = [
                    'answers' => $shuffledAnswers->values()->all(),
                    'hidden_index' => $hiddenIndex,
                    'correct_answer_id' => $shuffledAnswers[$hiddenIndex]->id
                ];

                $columnData['patterns'][] = $pattern;
            }

            $columns[] = $columnData;
        }

        return view('pages.frontend.psikotest.kecermatan', compact('exam', 'columns'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'exam_subject_id' => 'required|integer|exists:exam_subjects,id',
            'answers' => 'required|array'
        ]);

        $examSubjectId = $request->exam_subject_id;
        $userAnswers = $request->answers;

        // Hitung skor: benar +1, salah -1
        $score = 0;
        $correctCount = 0;
        $wrongCount = 0;
        $totalAnswered = count($userAnswers);

        // Tracking per kolom
        $columnStats = [];

        foreach ($userAnswers as $answerData) {
            $data = json_decode($answerData, true);
            if ($data && isset($data['is_correct'])) {
                $columnName = $data['column_name'] ?? 'Unknown';

                // Initialize column stats jika belum ada
                if (!isset($columnStats[$columnName])) {
                    $columnStats[$columnName] = [
                        'correct' => 0,
                        'wrong' => 0,
                        'total' => 0,
                        'score' => 0
                    ];
                }

                // Update stats per kolom
                $columnStats[$columnName]['total']++;

                if ($data['is_correct']) {
                    $score += 1;
                    $correctCount++;
                    $columnStats[$columnName]['correct']++;
                    $columnStats[$columnName]['score']++;
                } else {
                    $score -= 1;
                    $wrongCount++;
                    $columnStats[$columnName]['wrong']++;
                    $columnStats[$columnName]['score']--;
                }
            }
        }

        // Simpan hasil ke database
        // Score disimpan sebagai nilai mentah (bisa negatif)
        // Rumus: (total score mentah) / 500 * 100
        $scorePercentage = ($score / 500) * 100;

        // Pastikan score percentage berada di rentang 0-100
        $scorePercentage = max(0, min(100, $scorePercentage));

        // Tentukan deskripsi berdasarkan skor
        if ($scorePercentage >= 80) {
            $description = 'Sangat Baik';
        } elseif ($scorePercentage >= 60) {
            $description = 'Baik';
        } elseif ($scorePercentage >= 40) {
            $description = 'Cukup';
        } else {
            $description = 'Kurang';
        }

        $result = ExamResult::create([
            'exam_subject_id' => $examSubjectId,
            'user_id' => Auth::id(),
            'score' => $scorePercentage,
            'description' => $description . " (Skor: {$score}, Benar: {$correctCount}, Salah: {$wrongCount})"
        ]);

        // Simpan detail per kolom
        foreach ($columnStats as $columnName => $stats) {
            ExamResultDetail::create([
                'exam_result_id' => $result->id,
                'column_name' => $columnName,
                'correct_count' => $stats['correct'],
                'wrong_count' => $stats['wrong'],
                'total_answered' => $stats['total'],
                'score' => $stats['score']
            ]);
        }

        return redirect()->route('kecermatan.result', $result->id);
    }

    public function result($id)
    {
        $result = ExamResult::with([
            'examSubject.examType.testCategory',
            'examSubject.examQuestions',
            'user'
        ])->findOrFail($id);

        // Pastikan user hanya bisa melihat hasil ujiannya sendiri (kecuali admin)
        if ($result->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke hasil ujian ini.');
        }

        return view('pages.frontend.psikotest.result', compact('result'));
    }

    public function history()
    {
        $results = ExamResult::with([
            'examSubject.examType.testCategory',
            'user'
        ])
        ->whereHas('examSubject.examType', function($query) {
            $query->where('section', 'KECERMATAN');
        })
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.frontend.psikotest.results', compact('results'));
    }

    public function resultDetail($id)
    {
        $result = ExamResult::with([
            'examSubject.examType.testCategory',
            'examSubject.examQuestions',
            'examResultDetails',
            'user'
        ])->findOrFail($id);

        // Pastikan user hanya bisa melihat hasil ujiannya sendiri (kecuali admin)
        if ($result->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke hasil ujian ini.');
        }

        return view('pages.frontend.psikotest.result-detail', compact('result'));
    }
}
