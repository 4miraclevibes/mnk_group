<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamQuestion;
use App\Models\ExamSubject;
use App\Models\ExamType;
use App\Models\TestCategory;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = ExamQuestion::with(['examSubject.examType.testCategory'])->get();
        return view('pages.backend.questions.index', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|integer|exists:test_categories,id',
            'section' => 'required|string|in:AKADEMIK,KECERMATAN',
            'test_type' => 'required|string|in:PRETEST,MIDTEST,POSTTEST,TRYOUT',
            'subject' => 'required|string',
            'question' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the exam_subject_id based on the form data
        $examSubject = ExamSubject::whereHas('examType', function($query) use ($request) {
            $query->where('test_category_id', $request->category)
                  ->where('section', $request->section)
                  ->where('name', $request->test_type);
        })->where('name', $request->subject)->first();

        if (!$examSubject) {
            return redirect()->back()->withErrors(['subject' => 'Invalid subject selection. Please try again.'])->withInput();
        }

        $data = [
            'exam_subject_id' => $examSubject->id,
            'question' => $request->question,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('questions', 'public');
        }

        ExamQuestion::create($data);
        return redirect()->route('questions.index')->with('success', 'Question created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|integer|exists:test_categories,id',
            'section' => 'nullable|string|in:AKADEMIK,KECERMATAN',
            'test_type' => 'nullable|string|in:PRETEST,MIDTEST,POSTTEST,TRYOUT',
            'subject' => 'nullable|string',
            'question' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $question = ExamQuestion::findOrFail($id);
        $data = [];

        // Only update fields that are provided
        if ($request->filled('question')) {
            $data['question'] = $request->question;
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($question->image && Storage::disk('public')->exists($question->image)) {
                Storage::disk('public')->delete($question->image);
            }
            $data['image'] = $request->file('image')->store('questions', 'public');
        }

        // If category, section, test_type, or subject is provided, find new exam_subject_id
        if ($request->filled(['category', 'section', 'test_type', 'subject'])) {
            $examSubject = ExamSubject::whereHas('examType', function($query) use ($request) {
                $query->where('test_category_id', $request->category)
                      ->where('section', $request->section)
                      ->where('name', $request->test_type);
            })->where('name', $request->subject)->first();

            if (!$examSubject) {
                return redirect()->back()->withErrors(['subject' => 'Invalid subject selection. Please try again.'])->withInput();
            }

            $data['exam_subject_id'] = $examSubject->id;
        }

        $question->update($data);
        return redirect()->route('questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy($id)
    {
        $question = ExamQuestion::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }

}
