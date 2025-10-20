<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSubject;
use App\Models\ExamType;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function index()
    {
        $exams = ExamSubject::with([
            'examType.testCategory',
            'examQuestions.examAnswers'
        ])->get();
        return view('pages.backend.exams.index', compact('exams'));
    }

    public function regenerateTokens()
    {
        try {
            // Ambil semua exam types
            $examTypes = ExamType::all();

            $updatedCount = 0;

            foreach ($examTypes as $examType) {
                // Generate token baru yang benar-benar random (12 karakter uppercase)
                $newToken = strtoupper(Str::random(12));

                // Update token
                $examType->token = $newToken;
                $examType->save();

                $updatedCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Berhasil mengacak {$updatedCount} token ujian!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $examTypeId)
    {
        try {
            $examType = ExamType::findOrFail($examTypeId);

            $newStatus = $request->input('status');

            // Validate status
            if (!in_array($newStatus, ['active', 'inactive'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid!'
                ], 400);
            }

            // Update status
            $examType->status = $newStatus;
            $examType->save();

            $statusText = $newStatus === 'active' ? 'diaktifkan' : 'dinonaktifkan';

            return response()->json([
                'success' => true,
                'message' => "Ujian berhasil {$statusText}!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function adminResults($examSubjectId)
    {
        try {
            // Get exam subject with relationships
            $examSubject = \App\Models\ExamSubject::with([
                'examType.testCategory',
                'examResults.user'
            ])->findOrFail($examSubjectId);

            // Get all results for this exam subject
            $results = \App\Models\ExamResult::with([
                'examSubject.examType.testCategory',
                'user'
            ])
            ->where('exam_subject_id', $examSubjectId)
            ->orderBy('created_at', 'desc')
            ->get();

            return view('pages.backend.exams.admin-results', compact('examSubject', 'results'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function userResults($examSubjectId)
    {
        try {
            // Get exam subject with relationships
            $examSubject = \App\Models\ExamSubject::with([
                'examType.testCategory',
                'examResults.user'
            ])->findOrFail($examSubjectId);

            // Get only results for current user for this exam subject
            $results = \App\Models\ExamResult::with([
                'examSubject.examType.testCategory',
                'user'
            ])
            ->where('exam_subject_id', $examSubjectId)
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

            return view('pages.backend.exams.admin-results', compact('examSubject', 'results'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
