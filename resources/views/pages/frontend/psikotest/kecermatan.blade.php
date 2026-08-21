<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Kecermatan - {{ $exam->examType->testCategory->name }} {{ $exam->examType->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('logoWithText.png') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #e9ecef;
            height: 100vh;
            overflow: hidden;
            padding: 16px 20px;
            margin: 0;
        }
        .exam-page {
            height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
            gap: 14px;
            overflow: hidden;
        }
        .exam-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            background: #ffffff;
            border-radius: 12px;
            padding: 14px 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .exam-topbar-title,
        .exam-topbar-user {
            font-size: 16px;
            font-weight: 700;
            color: #212529;
            margin: 0;
        }
        .exam-topbar-user {
            text-transform: uppercase;
        }
        .exam-info-row {
            display: flex;
            gap: 14px;
            flex-shrink: 0;
        }
        .exam-info-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 12px 18px 16px;
        }
        .exam-info-card.stage {
            flex: 2;
            position: relative;
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .exam-info-card.timer {
            flex: 1;
            min-width: 200px;
        }
        .exam-info-label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
        }
        .exam-info-card.stage .exam-info-label {
            position: absolute;
            top: 12px;
            left: 18px;
        }
        .exam-stage-badge {
            display: inline-block;
            width: fit-content;
            margin-top: 8px;
            padding: 8px 28px;
            border: 2px solid #667eea;
            border-radius: 10px;
            background: #eef4ff;
            color: #667eea;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }
        .exam-timer-value {
            margin-top: 8px;
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            letter-spacing: 1px;
            line-height: 1.1;
        }
        .exam-timer-value.warning {
            color: #f5576c;
            animation: pulse 1s infinite;
        }
        .exam-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 18px 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: auto;
            min-height: 0;
        }
        .exam-main {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            flex: 1;
            min-height: 0;
        }
        .column-indicator {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
            flex-shrink: 0;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .pattern-display {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 16px 20px;
            margin-bottom: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .pattern-display.question-pattern {
            background: white;
            border: 2px solid #667eea;
            margin-top: 10px;
            margin-bottom: 15px;
            width: fit-content;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 15px;
        }
        .pattern-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
            overflow: auto;
            min-height: 0;
        }
        .pattern-items {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }
        .question-pattern .pattern-items {
            justify-content: center;
            gap: 16px;
        }
        .pattern-item {
            background: white;
            padding: 12px 14px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            min-width: 68px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 6px;
        }
        .question-pattern .pattern-item {
            padding: 18px 28px;
            min-width: 140px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            gap: 0;
        }
        .pattern-value {
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }
        .answer-content-image {
            width: 56px;
            height: 56px;
            object-fit: contain;
            display: block;
        }
        .question-pattern .pattern-value {
            font-size: 48px;
        }
        .question-pattern .answer-content-image {
            width: 130px;
            height: 130px;
        }
        .pattern-label {
            font-size: 16px;
            color: #667eea;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .question-section {
            margin-top: 15px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 15px 20px;
            flex-shrink: 0;
        }
        .question-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        .answer-options {
            display: flex;
            justify-content: stretch;
            gap: 12px;
            margin-top: 18px;
            width: 100%;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }
        .answer-btn {
            flex: 1;
            padding: 14px 18px;
            font-size: 20px;
            font-weight: 600;
            border: 2px solid #9ec5fe;
            border-radius: 10px;
            background-color: #eef4ff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.06);
            min-width: 0;
            height: 56px;
            color: #667eea;
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
        }
        .answer-btn:hover {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 5px 16px rgba(102, 126, 234, 0.35);
        }
        .answer-btn.selected {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border-color: #11998e;
        }
        .column-break-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .column-break-content {
            text-align: center;
            color: white;
        }
        .column-break-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .column-break-countdown {
            font-size: 80px;
            font-weight: bold;
            color: #667eea;
            text-shadow: 0 0 20px rgba(102, 126, 234, 0.8);
        }
        .column-break-text {
            font-size: 18px;
            color: #adb5bd;
            margin-top: 20px;
        }
        .stats-bar {
            display: none; /* Hide stats bar */
            justify-content: space-around;
            margin-bottom: 15px;
            gap: 10px;
            flex-shrink: 0;
        }
        .stat-box {
            flex: 1;
            background: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }
        .stat-value {
            font-size: 20px;
            font-weight: bold;
        }
        .stat-value.score {
            color: #667eea;
        }
        .stat-value.correct {
            color: #11998e;
        }
        .stat-value.wrong {
            color: #f5576c;
        }
        .progress-indicator {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 10px;
            flex-shrink: 0;
        }
        .submit-section {
            text-align: center;
            margin-top: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 15px;
            flex-shrink: 0;
        }
        .preparation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .preparation-content {
            text-align: center;
            color: white;
        }
        .preparation-countdown {
            font-size: 120px;
            font-weight: bold;
            margin: 30px 0;
            text-shadow: 0 0 30px rgba(102, 126, 234, 0.8);
        }
        .preparation-text {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .preparation-instruction {
            font-size: 18px;
            color: #adb5bd;
            max-width: 600px;
            margin: 0 auto;
        }
        @keyframes countdown-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .preparation-countdown.pulse {
            animation: countdown-pulse 1s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Preparation Overlay -->
    <div class="preparation-overlay" id="preparationOverlay">
        <div class="preparation-content">
            <div class="preparation-text">
                <i class="fas fa-hourglass-start me-2"></i>Bersiap-siap
            </div>
            <div class="preparation-countdown" id="preparationCountdown">60</div>
            <div class="preparation-instruction">
                <p class="mb-3"><strong>Instruksi Test Kecermatan:</strong></p>
                <p class="mb-2">• Setiap kolom memiliki 50 soal dengan waktu 1 menit</p>
                <p class="mb-2">• Pilih jawaban A-B-C-D-E yang sesuai dengan posisi yang hilang</p>
                <p class="mb-2">• Jawab sebanyak mungkin soal dengan cepat dan tepat</p>
                <p class="mb-2">• Benar +1, Salah -1</p>
                <p class="mt-4 text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Test akan dimulai setelah hitungan mundur selesai</p>
            </div>
        </div>
    </div>

    <!-- Column Break Overlay -->
    <div class="column-break-overlay" id="columnBreakOverlay" style="display: none;">
        <div class="column-break-content">
            <div class="column-break-title">
                <i class="fas fa-pause-circle me-2"></i>Jeda Antar Kolom
            </div>
            <div class="column-break-countdown" id="columnBreakCountdown">5</div>
            <div class="column-break-text">
                Bersiap untuk kolom berikutnya...
            </div>
        </div>
    </div>

    <div class="exam-page">
        <div class="exam-topbar">
            <div class="exam-topbar-title">Tes Psikologi</div>
            <div class="exam-topbar-user">{{ Auth::user()->name }}</div>
        </div>

        <div class="exam-info-row">
            <div class="exam-info-card stage">
                <div class="exam-info-label">Tahap Ujian</div>
                <div class="exam-stage-badge">{{ $exam->name }}</div>
            </div>
            <div class="exam-info-card timer">
                <div class="exam-info-label">Sisa Waktu</div>
                <div class="exam-timer-value" id="timerText">00:01:00</div>
            </div>
        </div>

        <div class="exam-container">
        <div class="exam-main">
        <!-- Column Indicator -->
        <div class="column-indicator" id="columnName">Kolom 1</div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-box">
                <div class="stat-label">Skor</div>
                <div class="stat-value score" id="scoreValue">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Benar</div>
                <div class="stat-value correct" id="correctValue">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Salah</div>
                <div class="stat-value wrong" id="wrongValue">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Terjawab</div>
                <div class="stat-value" id="answeredValue">0 / 0</div>
            </div>
        </div>

        <!-- Pattern Display LENGKAP (Reference) -->
        <div class="pattern-display">
            <div class="pattern-items" id="patternDisplayFull">
                <!-- Pattern LENGKAP akan di-generate oleh JavaScript -->
            </div>
        </div>

        <!-- Question Section -->
        <div class="question-section">
            <div class="question-title">Pertanyaan</div>

            <!-- Pattern Display DENGAN YANG HILANG -->
            <div class="pattern-display question-pattern">
                <div class="pattern-items" id="patternDisplay">
                    <!-- Pattern DENGAN YANG HILANG akan di-generate oleh JavaScript -->
                </div>
            </div>

            <!-- Answer Options -->
            <div class="answer-options" id="answerOptions">
                <!-- Options akan di-generate oleh JavaScript -->
            </div>
        </div>

        <!-- Progress -->
        <div class="progress-indicator" id="progressIndicator">
            Kolom <span id="currentColumn">1</span> dari {{ count($columns) }} |
            Soal <span id="currentPattern">0</span> dari <span id="totalPatterns">50</span>
        </div>

        <form id="examForm" action="{{ route('kecermatan.submit') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="exam_subject_id" value="{{ $exam->id }}">
            <div id="answersContainer"></div>
        </form>

        <!-- Submit Section (akan muncul di akhir) -->
        <div class="submit-section" id="submitSection" style="display: none;">
            <h3 class="mb-3">Test Selesai!</h3>
            <p class="mb-4">Klik tombol di bawah untuk melihat hasil</p>
            <button type="button" class="btn btn-primary btn-lg" onclick="submitExam()">
                <i class="fas fa-check-circle me-2"></i>Lihat Hasil
            </button>
        </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data dari backend
        try {
            var columns = @json($columns);
            console.log('Columns loaded:', columns);
        } catch(e) {
            console.error('Error loading columns:', e);
            alert('Terjadi kesalahan saat memuat data ujian');
        }

        // State management
        let currentColumnIndex = 0;
        let currentPatternIndex = 0;
        let score = 0;
        let correctCount = 0;
        let wrongCount = 0;
        let answeredCount = 0;
        let totalAnswered = 0;
        let allAnswers = [];

        // Timer
        let timeLeft = 60; // 1 menit per kolom
        let timerInterval;

        // Preparation
        let preparationTime = 60; // 1 menit persiapan
        let preparationInterval;
        let examStarted = false;

        // Initialize
        function init() {
            console.log('Initializing exam...');
            // Reset preparation time
            preparationTime = 60;
            startPreparation();
        }

        function startPreparation() {
            console.log('Starting preparation countdown from', preparationTime);
            const countdownElement = document.getElementById('preparationCountdown');
            console.log('Countdown element:', countdownElement);

            // Set initial value
            countdownElement.textContent = preparationTime;

            preparationInterval = setInterval(() => {
                preparationTime--;
                countdownElement.textContent = preparationTime;
                console.log('Preparation time:', preparationTime);

                // Pulse effect setiap detik
                countdownElement.classList.add('pulse');
                setTimeout(() => {
                    countdownElement.classList.remove('pulse');
                }, 500);

                // Warning pada 10 detik terakhir
                if (preparationTime <= 10) {
                    countdownElement.style.color = '#ffc107';
                }

                if (preparationTime <= 3) {
                    countdownElement.style.color = '#dc3545';
                }

                if (preparationTime <= 0) {
                    clearInterval(preparationInterval);
                    console.log('Preparation complete, starting exam...');
                    startExam();
                }
            }, 1000);
        }

        function startExam() {
            // Hide preparation overlay
            document.getElementById('preparationOverlay').style.display = 'none';

            // Start exam
            examStarted = true;
            showPattern();
            startTimer();
        }

        function startTimer() {
            updateTimerDisplay();
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();

                if (timeLeft <= 10) {
                    document.getElementById('timerText').classList.add('warning');
                }

                if (timeLeft <= 0) {
                    nextColumn();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timerText').textContent =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function getAnswerImageUrl(imagePath) {
            if (!imagePath) {
                return null;
            }

            if (imagePath.startsWith('http://') || imagePath.startsWith('https://') || imagePath.startsWith('/')) {
                return imagePath;
            }

            return `{{ asset('storage') }}/${imagePath}`;
        }

        function appendAnswerContent(container, answerData, fallbackText) {
            const imageUrl = getAnswerImageUrl(answerData?.image);

            if (imageUrl) {
                const img = document.createElement('img');
                img.src = imageUrl;
                img.alt = 'Jawaban';
                img.className = 'answer-content-image';
                container.appendChild(img);
                return;
            }

            container.textContent = fallbackText;
        }

        function showPattern() {
            if (currentColumnIndex >= columns.length) {
                endExam();
                return;
            }

            const column = columns[currentColumnIndex];
            const pattern = column.patterns[currentPatternIndex];

            // Update column name
            document.getElementById('columnName').textContent = column.name;
            document.getElementById('currentColumn').textContent = currentColumnIndex + 1;
            document.getElementById('currentPattern').textContent = currentPatternIndex + 1;
            document.getElementById('totalPatterns').textContent = column.patterns.length;

            const letters = ['A', 'B', 'C', 'D', 'E'];

            // Display pattern LENGKAP (tanpa yang hilang) - sebagai referensi TIDAK DIACAK
            const patternDisplayFull = document.getElementById('patternDisplayFull');
            patternDisplayFull.innerHTML = '';

            // Sort berdasarkan ID untuk urutan konsisten (tidak diacak)
            const sortedAnswers = [...pattern.answers].sort((a, b) => a.id - b.id);

            sortedAnswers.forEach((answer, index) => {
                const item = document.createElement('div');
                item.className = 'pattern-item';

                // Value (L, H, M, etc) - TANPA ? (semua ditampilkan)
                const valueDiv = document.createElement('div');
                valueDiv.className = 'pattern-value';
                appendAnswerContent(valueDiv, answer, answer.answer);

                // Label (A, B, C, D, E) - HANYA DI PATTERN LENGKAP
                const labelDiv = document.createElement('div');
                labelDiv.className = 'pattern-label';
                labelDiv.textContent = letters[index];

                item.appendChild(valueDiv);
                item.appendChild(labelDiv);
                patternDisplayFull.appendChild(item);
            });

            // Display pattern DENGAN YANG HILANG (untuk dijawab) - HANYA 4 ITEM (YANG SALAH)
            const patternDisplay = document.getElementById('patternDisplay');
            patternDisplay.innerHTML = '';

            // Hanya tampilkan yang BUKAN jawaban benar (hidden_index)
            pattern.answers.forEach((answer, index) => {
                // Skip yang merupakan jawaban benar (hidden_index)
                if (index === pattern.hidden_index) {
                    return; // Jangan tampilkan yang benar
                }

                const item = document.createElement('div');
                item.className = 'pattern-item';

                // Value (L, H, M, etc) - Hanya yang salah (4 item)
                const valueDiv = document.createElement('div');
                valueDiv.className = 'pattern-value';
                appendAnswerContent(valueDiv, answer, answer.answer);

                item.appendChild(valueDiv);
                patternDisplay.appendChild(item);
            });

            // Display answer options A-B-C-D-E
            const answerOptions = document.getElementById('answerOptions');
            answerOptions.innerHTML = '';

            // Tombol menggunakan sortedAnswers (urutan yang tidak diacak, sama dengan pattern atas)
            letters.forEach((letter, index) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'answer-btn';
                btn.textContent = letter;
                btn.dataset.letterIndex = index;
                btn.dataset.answerId = sortedAnswers[index].id; // Gunakan sortedAnswers
                btn.onclick = () => selectAnswer(btn, index, sortedAnswers[index].id);
                answerOptions.appendChild(btn);
            });
        }

        function selectAnswer(btn, selectedIndex, selectedAnswerId) {
            // Prevent answer before exam starts
            if (!examStarted) {
                return;
            }

            const column = columns[currentColumnIndex];
            const pattern = column.patterns[currentPatternIndex];

            // Cek apakah ID yang dipilih sama dengan ID jawaban yang benar (correct_answer_id)
            const isCorrect = selectedAnswerId === pattern.correct_answer_id;

            // Update stats
            if (isCorrect) {
                score++;
                correctCount++;
            } else {
                score--;
                wrongCount++;
            }

            answeredCount++;
            totalAnswered++;

            // Save answer with column info
            allAnswers.push({
                answer_id: btn.dataset.answerId,
                is_correct: isCorrect,
                column_name: column.name,
                column_index: currentColumnIndex
            });

            updateStats();

            // Langsung next pattern tanpa delay
            nextPattern();
        }

        function nextPattern() {
            currentPatternIndex++;

            const column = columns[currentColumnIndex];
            // Cek apakah masih ada soal di kolom ini
            if (currentPatternIndex >= column.patterns.length) {
                // Kalau soal habis, JANGAN pindah kolom otomatis
                // Tunggu sampai waktu habis, timer yang akan handle perpindahan kolom
                showWaitingMessage();
            } else {
                // Kalau masih ada soal, tampilkan pattern berikutnya
                showPattern();
            }
        }

        function showWaitingMessage() {
            // Hide pattern displays dan answer options
            document.getElementById('patternDisplayFull').innerHTML = '';
            document.getElementById('patternDisplay').innerHTML = '';
            document.getElementById('answerOptions').innerHTML = '';

            // Show waiting message
            const questionSection = document.querySelector('.question-section');
            questionSection.innerHTML = `
                <div style="text-align: center; padding: 40px;">
                    <i class="fas fa-check-circle" style="font-size: 60px; color: #11998e; margin-bottom: 20px;"></i>
                    <h3 style="color: #11998e; margin-bottom: 15px;">Semua Soal Selesai!</h3>
                    <p style="font-size: 18px; color: #666;">Menunggu waktu habis untuk pindah ke kolom berikutnya...</p>
                </div>
            `;
        }

        function nextColumn() {
            clearInterval(timerInterval);
            document.getElementById('timerText').classList.remove('warning');

            currentColumnIndex++;
            currentPatternIndex = 0;
            timeLeft = 60; // Reset timer untuk kolom berikutnya

            if (currentColumnIndex >= columns.length) {
                endExam();
            } else {
                // Tampilkan jeda 5 detik
                showColumnBreak();
            }
        }

        function showColumnBreak() {
            // Show overlay
            document.getElementById('columnBreakOverlay').style.display = 'flex';

            let breakTime = 5;
            document.getElementById('columnBreakCountdown').textContent = breakTime;

            const breakInterval = setInterval(() => {
                breakTime--;
                document.getElementById('columnBreakCountdown').textContent = breakTime;

                if (breakTime <= 0) {
                    clearInterval(breakInterval);
                    document.getElementById('columnBreakOverlay').style.display = 'none';

                    // Restore question section structure
                    const questionSection = document.querySelector('.question-section');
                    questionSection.innerHTML = `
                        <div class="question-title">Pertanyaan</div>

                        <!-- Pattern Display DENGAN YANG HILANG -->
                        <div class="pattern-display question-pattern">
                            <div class="pattern-items" id="patternDisplay">
                                <!-- Pattern DENGAN YANG HILANG akan di-generate oleh JavaScript -->
                            </div>
                        </div>

                        <!-- Answer Options -->
                        <div class="answer-options" id="answerOptions">
                            <!-- Options akan di-generate oleh JavaScript -->
                        </div>
                    `;

                    showPattern();
                    startTimer();
                }
            }, 1000);
        }

        function updateStats() {
            document.getElementById('scoreValue').textContent = score;
            document.getElementById('correctValue').textContent = correctCount;
            document.getElementById('wrongValue').textContent = wrongCount;
            document.getElementById('answeredValue').textContent =
                `${totalAnswered} / ${columns.reduce((sum, col) => sum + col.patterns.length, 0)}`;
        }

        function endExam() {
            clearInterval(timerInterval);

            // Hide all pattern displays and options
            const allPatternDisplays = document.querySelectorAll('.pattern-display');
            allPatternDisplays.forEach(display => {
                display.style.display = 'none';
            });

            document.querySelector('.question-section').style.display = 'none';
            document.querySelector('.progress-indicator').style.display = 'none';
            document.getElementById('columnName').style.display = 'none';
            document.querySelector('.exam-info-card.timer').style.display = 'none';
            document.querySelector('.stats-bar').style.display = 'none';

            // Show submit section
            document.getElementById('submitSection').style.display = 'block';
        }

        function submitExam() {
            const form = document.getElementById('examForm');
            const container = document.getElementById('answersContainer');

            // Add all answers to form
            allAnswers.forEach((answer, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `answers[${index}]`;
                input.value = JSON.stringify(answer);
                container.appendChild(input);
            });

            form.submit();
        }

        // Start exam when page is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, starting preparation...');
            init();
        });
    </script>
</body>
</html>

