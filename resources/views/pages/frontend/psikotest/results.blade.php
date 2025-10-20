<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Hasil Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px 0;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .result-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }
        .score-badge {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .score-badge.excellent {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .score-badge.good {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .score-badge.average {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .score-badge.poor {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .result-info {
            flex-grow: 1;
            padding: 0 20px;
        }
        .result-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .result-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .result-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: #888;
        }
        .btn-detail {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        .empty-state i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">
                        <i class="fas fa-history me-2"></i>Riwayat Test Kecermatan
                    </h1>
                    <p class="mb-0">Semua hasil test kecermatan yang pernah Anda kerjakan</p>
                </div>
                <a href="{{ route('exams.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        @if($results->count() > 0)
            @foreach($results as $result)
                @php
                    // Extract data untuk kecermatan
                    preg_match('/Skor: (-?\d+)/', $result->description, $scoreMatch);
                    preg_match('/Benar: (\d+)/', $result->description, $correctMatch);
                    preg_match('/Salah: (\d+)/', $result->description, $wrongMatch);
                    $mainDesc = preg_replace('/\s*\(.*\)/', '', $result->description);
                    $rawScore = $scoreMatch[1] ?? 0;
                    $correctAnswers = $correctMatch[1] ?? 0;
                    $wrongAnswers = $wrongMatch[1] ?? 0;

                    // Hitung score: (Benar - Salah) / 500 * 100
                    $calculatedScore = (($correctAnswers - $wrongAnswers) / 500) * 100;
                    $calculatedScore = max(0, $calculatedScore); // Minimal 0
                @endphp
                <div class="result-card">
                    <div class="d-flex align-items-center">
                        <div class="score-badge {{ $calculatedScore >= 80 ? 'excellent' : ($calculatedScore >= 60 ? 'good' : ($calculatedScore >= 40 ? 'average' : 'poor')) }}">
                            {{ number_format($calculatedScore, 1, ',', '.') }}
                        </div>

                        <div class="result-info">
                            <div class="result-title">
                                {{ $result->examSubject->examType->testCategory->name }} - {{ $result->examSubject->examType->name }}
                            </div>
                            <div class="result-subtitle">
                                {{ $result->examSubject->name }}
                            </div>
                            <div class="result-meta">
                                <div class="meta-item">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $mainDesc }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Skor: {{ $rawScore }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-check text-success"></i>
                                    <span>{{ $correctAnswers }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-times text-danger"></i>
                                    <span>{{ $wrongAnswers }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $result->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $result->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('kecermatan.result', $result->id) }}" class="btn-detail">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3 class="mb-3">Belum Ada Hasil Test Kecermatan</h3>
                <p class="text-muted mb-4">Anda belum pernah mengerjakan test kecermatan. Mulai test pertama Anda sekarang!</p>
                <a href="{{ route('exams.index') }}" class="btn btn-detail">
                    <i class="fas fa-play me-2"></i>Mulai Test
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

