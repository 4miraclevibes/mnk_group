<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ujian - {{ $exam->examType->testCategory->name }} {{ $exam->examType->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .exam-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .question {
            display: none;
        }
        .question.active {
            display: block;
        }
        .question-number {
            font-weight: bold;
            color: #007bff;
        }
        .answer-btn {
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
            padding: 15px 20px;
            border: 2px solid #ced4da;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 16px;
            cursor: pointer;
        }
        .answer-btn:hover {
            background-color: #e9ecef;
            border-color: #007bff;
        }
        .answer-btn.selected {
            background-color: #007bff;
            color: #ffffff;
            border-color: #007bff;
        }
        .question-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
        }
        .answer-image {
            max-width: 200px;
            height: auto;
            border-radius: 5px;
            margin-left: 10px;
        }
        .progress-bar {
            height: 8px;
            border-radius: 4px;
        }
        .timer {
            font-size: 18px;
            font-weight: bold;
        }
        .timer.warning {
            color: #ffc107;
        }
        .timer.danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container exam-container">
        <!-- Header Info -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="mb-2">{{ $exam->examType->testCategory->name }} - {{ $exam->examType->name }}</h1>
                <h3 class="text-muted">{{ $exam->name }}</h3>
                <p class="text-muted">Section: <span class="badge bg-info">{{ $exam->examType->section }}</span></p>
            </div>
            <div class="col-md-4 text-end">
                <div id="timer" class="timer">Waktu tersisa: 30:00</div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-4">
            <div class="d-flex justify-content-between mb-2">
                <span>Progress</span>
                <span id="progressText">0 / {{ $questions->count() }}</span>
            </div>
            <div class="progress">
                <div id="progressBar" class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
            </div>
        </div>

        <form id="examForm" action="{{ route('exam.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="exam_subject_id" value="{{ $exam->id }}">

            @foreach ($questions as $index => $question)
                <div class="question {{ $loop->first ? 'active' : '' }}" data-question="{{ $index + 1 }}">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="mb-0">
                                <span class="question-number">Soal {{ $loop->iteration }}:</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-3 fs-5">{{ $question->question }}</p>

                            @if($question->image)
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="question-image">
                            @endif

                            <div class="answers mt-4">
                                @foreach ($question->examAnswers->shuffle() as $answer)
                                    <button type="button" class="btn answer-btn d-flex align-items-center"
                                            data-question-id="{{ $question->id }}"
                                            data-answer-id="{{ $answer->id }}"
                                            data-is-correct="{{ $answer->is_correct }}">
                                        <span class="me-3">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="flex-grow-1">{{ $answer->answer }}</span>
                                        @if($answer->image)
                                            <img src="{{ asset('storage/' . $answer->image) }}" alt="Answer Image" class="answer-image">
                                        @endif
                                    </button>
                                @endforeach
                            </div>

                            <input type="hidden" name="answers[{{ $question->id }}]" value="">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg" id="submitButton" disabled>
                    <i class="fas fa-paper-plane me-2"></i>Submit Jawaban
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('exams.index') }}" class="btn btn-success btn-lg">
                <i class="fas fa-home me-2"></i>Kembali ke Daftar Ujian
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('examForm');
            const questions = form.querySelectorAll('.question');
            const totalQuestions = questions.length;
            const submitButton = document.getElementById('submitButton');
            const timerElement = document.getElementById('timer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');

            let answeredQuestions = 0;
            let timeLeft = 30 * 60; // 30 menit dalam detik
            let isTimeUp = false;

            function updateTimer() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `Waktu tersisa: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Update timer color based on remaining time
                timerElement.classList.remove('warning', 'danger');
                if (timeLeft <= 300) { // 5 menit terakhir
                    timerElement.classList.add('danger');
                } else if (timeLeft <= 600) { // 10 menit terakhir
                    timerElement.classList.add('warning');
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    isTimeUp = true;
                    showLastQuestion();
                    selectUnansweredQuestions();
                    updateSubmitButton();
                } else {
                    timeLeft--;
                }
            }

            function updateProgress() {
                const progress = (answeredQuestions / totalQuestions) * 100;
                progressBar.style.width = progress + '%';
                progressText.textContent = `${answeredQuestions} / ${totalQuestions}`;
            }

            function showLastQuestion() {
                questions.forEach((question, index) => {
                    question.classList.remove('active');
                    if (index === totalQuestions - 1) {
                        question.classList.add('active');
                    }
                });
            }

            function selectUnansweredQuestions() {
                questions.forEach((question) => {
                    if (!question.classList.contains('answered')) {
                        const firstAnswer = question.querySelector('.answer-btn');
                        if (firstAnswer) {
                            firstAnswer.click();
                        }
                    }
                });
            }

            function updateSubmitButton() {
                if (isTimeUp) {
                    // Jika waktu habis, aktifkan tombol hanya jika pertanyaan terakhir dijawab
                    const lastQuestion = questions[totalQuestions - 1];
                    submitButton.disabled = !lastQuestion.classList.contains('answered');
                } else {
                    // Jika waktu masih ada, aktifkan tombol hanya jika semua pertanyaan dijawab
                    submitButton.disabled = answeredQuestions !== totalQuestions;
                }
            }

            const timerInterval = setInterval(updateTimer, 1000);

            form.addEventListener('click', function(e) {
                const answerBtn = e.target.closest('.answer-btn');
                if (answerBtn) {
                    const currentQuestion = answerBtn.closest('.question');
                    const currentQuestionNumber = parseInt(currentQuestion.dataset.question);
                    const hiddenInput = currentQuestion.querySelector('input[type="hidden"]');
                    const questionId = answerBtn.dataset.questionId;
                    const answerId = answerBtn.dataset.answerId;

                    // Hapus kelas 'selected' dari semua tombol jawaban dalam pertanyaan ini
                    currentQuestion.querySelectorAll('.answer-btn').forEach(btn => {
                        btn.classList.remove('selected');
                        btn.querySelector('i').className = 'fas fa-circle';
                    });

                    // Tambahkan kelas 'selected' ke tombol yang diklik
                    answerBtn.classList.add('selected');
                    answerBtn.querySelector('i').className = 'fas fa-check-circle';

                    // Set nilai input tersembunyi
                    hiddenInput.value = JSON.stringify({
                        question_id: questionId,
                        answer_id: answerId
                    });

                    // Periksa apakah pertanyaan ini sudah dijawab sebelumnya
                    if (!currentQuestion.classList.contains('answered')) {
                        answeredQuestions++;
                        currentQuestion.classList.add('answered');
                        updateProgress();
                    }

                    // Perbarui status tombol submit
                    updateSubmitButton();

                    // Langsung pindah ke soal berikutnya tanpa delay
                    if (currentQuestionNumber < totalQuestions && !isTimeUp) {
                        currentQuestion.classList.remove('active');
                        questions[currentQuestionNumber].classList.add('active');
                    }
                }
            });

            // Initialize progress
            updateProgress();
        });
    </script>
</body>
</html>
