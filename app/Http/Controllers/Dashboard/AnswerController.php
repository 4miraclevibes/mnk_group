<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    public function index($id)
    {
        $question = ExamQuestion::with(['examSubject.examType.testCategory'])->findOrFail($id);
        $answers = ExamAnswer::where('exam_question_id', $id)->get();
        return view('pages.backend.answers.index', compact('answers', 'id', 'question'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_question_id' => 'required|integer|exists:exam_questions,id',
            'answer' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_correct' => 'nullable|boolean',
        ]);

        // Get question with subject to check if it's KECERMATAN
        $question = ExamQuestion::with('examSubject')->findOrFail($request->exam_question_id);

        // Count existing answers for this question
        $existingAnswersCount = ExamAnswer::where('exam_question_id', $request->exam_question_id)->count();

        // Check if this is a KECERMATAN question and has more than 3 answers
        $isKecermatan = $question->examSubject && $question->examSubject->name === 'KECERMATAN';
        $autoCorrect = $isKecermatan && $existingAnswersCount > 3;

        $data = [
            'exam_question_id' => $request->exam_question_id,
            'answer' => $request->answer,
            'is_correct' => $autoCorrect ? 1 : ($request->has('is_correct') ? 1 : 0),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('answers', 'public');
        }

        ExamAnswer::create($data);
        return redirect()->route('answers.index', $request->exam_question_id)->with('success', 'Answer created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_correct' => 'nullable|boolean',
        ]);

        $answer = ExamAnswer::findOrFail($id);

        // Get question with subject to check if it's KECERMATAN
        $question = ExamQuestion::with('examSubject')->findOrFail($answer->exam_question_id);

        // Check if this is a KECERMATAN question
        $isKecermatan = $question->examSubject && $question->examSubject->name === 'KECERMATAN';

        // Count total answers and correct answers for this question
        $totalAnswers = ExamAnswer::where('exam_question_id', $answer->exam_question_id)->count();
        $correctAnswersCount = ExamAnswer::where('exam_question_id', $answer->exam_question_id)
            ->where('is_correct', 1)
            ->count();

        // Auto correct if KECERMATAN, has 4 answers, and no correct answer yet
        $autoCorrect = $isKecermatan && $totalAnswers >= 4 && $correctAnswersCount == 0;

        $data = [];

        if ($request->filled('answer')) {
            $data['answer'] = $request->answer;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($answer->image && Storage::disk('public')->exists($answer->image)) {
                Storage::disk('public')->delete($answer->image);
            }
            $data['image'] = $request->file('image')->store('answers', 'public');
        }

        $data['is_correct'] = $autoCorrect ? 1 : ($request->has('is_correct') ? 1 : 0);

        $answer->update($data);
        return redirect()->route('answers.index', $answer->exam_question_id)->with('success', 'Answer updated successfully');
    }

    public function destroy($id)
    {
        $answer = ExamAnswer::findOrFail($id);
        $questionId = $answer->exam_question_id;
        $answer->delete();
        return redirect()->route('answers.index', $questionId)->with('success', 'Answer deleted successfully');
    }
}
