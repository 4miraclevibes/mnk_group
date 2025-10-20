<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSubject;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = ExamSubject::with([
            'examType.testCategory',
            'examQuestions.examAnswers'
        ])->findOrFail($id);

        $questions = $exam->examQuestions;

        return view('pages.frontend.akademik.exam', compact('exam', 'questions'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'exam_subject_id' => 'required|integer|exists:exam_subjects,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string'
        ]);

        $examSubjectId = $request->exam_subject_id;
        $answers = $request->answers;

        // Hitung jumlah jawaban benar
        $correctAnswers = 0;
        $totalQuestions = count($answers);

        foreach ($answers as $questionId => $answerJson) {
            $answerData = json_decode($answerJson, true);
            $answerId = $answerData['answer_id'];

            // Cek apakah jawaban benar
            $answer = \App\Models\ExamAnswer::find($answerId);
            if ($answer && $answer->is_correct == 1) {
                $correctAnswers++;
            }
        }

        // Hitung skor dalam persentase
        $score = ($correctAnswers / $totalQuestions) * 100;

        // Tentukan deskripsi berdasarkan skor
        $description = '';
        if ($score >= 80) {
            $description = 'Sangat Baik';
        } elseif ($score >= 60) {
            $description = 'Baik';
        } elseif ($score >= 40) {
            $description = 'Cukup';
        } else {
            $description = 'Kurang';
        }

        // Simpan hasil ke database
        $result = \App\Models\ExamResult::create([
            'exam_subject_id' => $examSubjectId,
            'user_id' => auth()->id(),
            'score' => $score,
            'description' => $description
        ]);

        // Redirect ke halaman hasil
        return redirect()->route('exam.result', $result->id);
    }
}

