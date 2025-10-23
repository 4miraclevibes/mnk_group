<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Hasil Ujian Per Kolom - {{ $result->examSubject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('mnk_logo-rbg.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .detail-container {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
        }
        .header-title {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .exam-meta {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .meta-item {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
        }
        .meta-label {
            color: #666;
            font-weight: 600;
        }
        .meta-value {
            color: #333;
            margin-left: 5px;
        }
        .column-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .column-card {
            background: #ffffff;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .column-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .column-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        .column-name {
            font-size: 20px;
            font-weight: bold;
            color: #667eea;
        }
        .column-score {
            font-size: 24px;
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 10px;
        }
        .column-score.positive {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .column-score.negative {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .column-score.zero {
            background: #e0e0e0;
            color: #666;
        }
        .stat-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .stat-row:last-child {
            border-bottom: none;
        }
        .stat-label {
            color: #666;
            font-weight: 600;
        }
        .stat-value {
            font-weight: bold;
        }
        .stat-value.correct {
            color: #11998e;
        }
        .stat-value.wrong {
            color: #f5576c;
        }
        .stat-value.total {
            color: #667eea;
        }
        .summary-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .summary-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        .summary-box {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }
        .summary-value {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .summary-label {
            font-size: 14px;
            opacity: 0.9;
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
    </style>
</head>
<body>
    <div class="detail-container">
        <div class="header-section">
            <h1 class="header-title">
                <i class="fas fa-chart-line"></i> Detail Hasil Per Kolom
            </h1>
            <div class="exam-meta">
                <div class="meta-item">
                    <span class="meta-label">Kategori:</span>
                    <span class="meta-value">{{ $result->examSubject->examType->testCategory->name }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Jenis:</span>
                    <span class="meta-value">{{ $result->examSubject->examType->name }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Mata Pelajaran:</span>
                    <span class="meta-value">{{ $result->examSubject->name }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Tanggal:</span>
                    <span class="meta-value">{{ $result->created_at->format('d F Y, H:i') }}</span>
                </div>
            </div>
        </div>

        @php
            // Extract data from description
            preg_match('/Benar: (\d+)/', $result->description, $correctMatch);
            preg_match('/Salah: (\d+)/', $result->description, $wrongMatch);
            preg_match('/Skor: (-?\d+)/', $result->description, $scoreMatch);

            $totalCorrect = $correctMatch[1] ?? 0;
            $totalWrong = $wrongMatch[1] ?? 0;
            $totalScore = $scoreMatch[1] ?? 0;
            $totalAnswered = $totalCorrect + $totalWrong;
        @endphp

        <!-- Summary Section -->
        <div class="summary-section">
            <div class="summary-title">
                <i class="fas fa-trophy"></i> Ringkasan Keseluruhan
            </div>
            <div class="summary-grid">
                <div class="summary-box">
                    <div class="summary-value">{{ $totalScore }}</div>
                    <div class="summary-label">Total Skor</div>
                </div>
                <div class="summary-box">
                    <div class="summary-value">{{ $totalAnswered }}</div>
                    <div class="summary-label">Dijawab</div>
                </div>
                <div class="summary-box">
                    <div class="summary-value">{{ $totalCorrect }}</div>
                    <div class="summary-label">Benar</div>
                </div>
                <div class="summary-box">
                    <div class="summary-value">{{ $totalWrong }}</div>
                    <div class="summary-label">Salah</div>
                </div>
            </div>
        </div>

        <!-- Column Details -->
        <h3 class="mb-4" style="color: #667eea; font-weight: bold;">
            <i class="fas fa-columns"></i> Detail Per Kolom
        </h3>

        <div class="column-cards">
            @forelse($result->examResultDetails as $detail)
                <div class="column-card">
                    <div class="column-header">
                        <span class="column-name">{{ $detail->column_name }}</span>
                        <span class="column-score {{ $detail->score > 0 ? 'positive' : ($detail->score < 0 ? 'negative' : 'zero') }}">
                            {{ $detail->score > 0 ? '+' : '' }}{{ $detail->score }}
                        </span>
                    </div>
                    <div class="column-stats">
                        <div class="stat-row">
                            <span class="stat-label">Total Dijawab:</span>
                            <span class="stat-value total">{{ $detail->total_answered }} soal</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Jawaban Benar:</span>
                            <span class="stat-value correct">{{ $detail->correct_count }} soal (+{{ $detail->correct_count }})</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Jawaban Salah:</span>
                            <span class="stat-value wrong">{{ $detail->wrong_count }} soal (-{{ $detail->wrong_count }})</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Detail per kolom tidak tersedia untuk hasil ujian ini.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="action-buttons">
            <a href="{{ route('kecermatan.result', $result->id) }}" class="btn btn-primary-custom btn-custom">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Hasil
            </a>
            <a href="{{ route('exams.index') }}" class="btn btn-success-custom btn-custom">
                <i class="fas fa-redo me-2"></i>Ujian Kembali
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

