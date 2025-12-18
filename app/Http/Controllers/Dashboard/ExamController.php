<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSubject;
use App\Models\ExamType;
use App\Models\ExamResult;
use App\Models\User;
use App\Exports\ExamResultsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

    public function exportExcel($examSubjectId)
    {
        try {
            $examSubject = ExamSubject::with(['examType.testCategory'])->findOrFail($examSubjectId);
            $fileName = 'Hasil_Ujian_' . str_replace(' ', '_', $examSubject->name) . '_' . date('Y-m-d_His') . '.xlsx';

            return Excel::download(new ExamResultsExport($examSubjectId), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    public function userExamStats($examSubjectId)
    {
        try {
            $examSubject = ExamSubject::with(['examType.testCategory'])->findOrFail($examSubjectId);

            // Get all users with their exam count for this subject
            $users = User::withCount(['examResults' => function($query) use ($examSubjectId) {
                $query->where('exam_subject_id', $examSubjectId);
            }])
            ->orderBy('name')
            ->get();

            // Get users who haven't taken the exam
            $usersNotTaken = User::whereDoesntHave('examResults', function($query) use ($examSubjectId) {
                $query->where('exam_subject_id', $examSubjectId);
            })
            ->orderBy('name')
            ->get();

            return view('pages.backend.exams.user-exam-detail', compact('examSubject', 'users', 'usersNotTaken'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
