<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\AnswerController;
use App\Http\Controllers\Dashboard\ExamController;
use App\Http\Controllers\Frontend\ExamController as FrontendExamController;
use App\Http\Controllers\Frontend\ResultController;
use App\Http\Controllers\Frontend\KecermatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //Question
    Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::put('questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    //Answer
    Route::get('answers/{id}', [AnswerController::class, 'index'])->name('answers.index');
    Route::post('answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::put('answers/{id}', [AnswerController::class, 'update'])->name('answers.update');
    Route::delete('answers/{id}', [AnswerController::class, 'destroy'])->name('answers.destroy');

    //Exam
    Route::get('exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('exams/{examSubjectId}/admin-results', [ExamController::class, 'adminResults'])->name('exams.admin-results');
    Route::get('exams/{examSubjectId}/user-results', [ExamController::class, 'userResults'])->name('exams.user-results');
    Route::post('exams/regenerate-tokens', [ExamController::class, 'regenerateTokens'])->name('exams.regenerate-tokens');
    Route::post('exams/toggle-status/{examTypeId}', [ExamController::class, 'toggleStatus'])->name('exams.toggle-status');
    Route::post('exam/submit', [FrontendExamController::class, 'submit'])->name('exam.submit');

    //Result
    Route::get('exam/history', [ResultController::class, 'index'])->name('exam.history');
    Route::get('exam/result/{id}', [ResultController::class, 'show'])->name('exam.result');

    //Kecermatan
    Route::get('kecermatan/history', [KecermatanController::class, 'history'])->name('kecermatan.history');
    Route::get('kecermatan/result/{id}', [KecermatanController::class, 'result'])->name('kecermatan.result');
    Route::get('kecermatan/{id}', [KecermatanController::class, 'show'])->name('kecermatan.show');
    Route::post('kecermatan/submit', [KecermatanController::class, 'submit'])->name('kecermatan.submit');

    //Exam Show (harus paling bawah karena pakai parameter {id})
    Route::get('exam/{id}', [FrontendExamController::class, 'show'])->name('exam.show');

});

require __DIR__.'/auth.php';
