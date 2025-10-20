<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function show($id)
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

        return view('pages.frontend.akademik.result', compact('result'));
    }

    public function index()
    {
        $results = ExamResult::with([
            'examSubject.examType.testCategory',
            'user'
        ])
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pages.frontend.akademik.results', compact('results'));
    }
}
