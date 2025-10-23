<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Ujian - {{ $result->examSubject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .result-container {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .score-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: #ffffff;
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .score-circle.excellent {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .score-circle.good {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .score-circle.average {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .score-circle.poor {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .result-badge {
            display: inline-block;
            padding: 10px 30px;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .result-badge.excellent {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: #ffffff;
        }
        .result-badge.good {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #ffffff;
        }
        .result-badge.average {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: #ffffff;
        }
        .result-badge.poor {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: #ffffff;
        }
        .exam-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 30px 0;
        }
        .exam-info h5 {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            border: none;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: #ffffff;
        }
        .btn-success-custom {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: #ffffff;
            border: none;
        }
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(17, 153, 142, 0.4);
            color: #ffffff;
        }
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #f0f0f0;
            position: absolute;
            animation: confetti-fall 3s linear infinite;
        }
        @keyframes confetti-fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1 class="mb-4">
            <i class="fas fa-trophy" style="color: #ffd700;"></i> Hasil Ujian
        </h1>

        <div class="score-circle {{ $result->score >= 80 ? 'excellent' : ($result->score >= 60 ? 'good' : ($result->score >= 40 ? 'average' : 'poor')) }}">
            <div>
                <div style="font-size: 56px;">{{ number_format($result->score, 0) }}</div>
                <div style="font-size: 24px;">/ 100</div>
            </div>
        </div>

        <div class="result-badge {{ $result->score >= 80 ? 'excellent' : ($result->score >= 60 ? 'good' : ($result->score >= 40 ? 'average' : 'poor')) }}">
            {{ $result->description }}
        </div>

        <div class="exam-info">
            <h5>
                <i class="fas fa-info-circle"></i> Detail Ujian
            </h5>
            <div class="info-item">
                <span class="info-label">Kategori Test:</span>
                <span class="info-value">{{ $result->examSubject->examType->testCategory->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Jenis Ujian:</span>
                <span class="info-value">{{ $result->examSubject->examType->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Mata Pelajaran:</span>
                <span class="info-value">{{ $result->examSubject->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Section:</span>
                <span class="info-value">{{ $result->examSubject->examType->section }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Total Soal:</span>
                <span class="info-value">{{ $result->examSubject->examQuestions->count() }} soal</span>
            </div>
            <div class="info-item">
                <span class="info-label">Jawaban Benar:</span>
                <span class="info-value">{{ round(($result->score / 100) * $result->examSubject->examQuestions->count()) }} soal</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal:</span>
                <span class="info-value">{{ $result->created_at->format('d F Y, H:i') }}</span>
            </div>
        </div>

        @if($result->score >= 80)
            <p class="text-success fw-bold">
                <i class="fas fa-check-circle"></i> Selamat! Anda mendapatkan nilai yang sangat baik!
            </p>
        @elseif($result->score >= 60)
            <p class="text-info fw-bold">
                <i class="fas fa-smile"></i> Bagus! Terus tingkatkan lagi ya!
            </p>
        @elseif($result->score >= 40)
            <p class="text-warning fw-bold">
                <i class="fas fa-exclamation-triangle"></i> Cukup baik, masih bisa ditingkatkan lagi!
            </p>
        @else
            <p class="text-danger fw-bold">
                <i class="fas fa-times-circle"></i> Jangan menyerah, coba lagi dan belajar lebih giat!
            </p>
        @endif

        <div class="action-buttons">
            <a href="{{ route('exams.index') }}" class="btn btn-success-custom btn-custom">
                <i class="fas fa-redo me-2"></i>Ujian Kembali
            </a>
            <a href="{{ route('exam.history') }}" class="btn btn-primary-custom btn-custom">
                <i class="fas fa-history me-2"></i>Riwayat Hasil
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if($result->score >= 80)
    <script>
        // Tambahkan efek confetti untuk nilai bagus
        function createConfetti() {
            const colors = ['#667eea', '#764ba2', '#11998e', '#38ef7d', '#ffd700', '#ff6b6b'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                document.body.appendChild(confetti);

                setTimeout(() => confetti.remove(), 5000);
            }
        }

        // Jalankan confetti saat halaman dimuat
        window.addEventListener('load', createConfetti);
    </script>
    @endif
</body>
</html>

