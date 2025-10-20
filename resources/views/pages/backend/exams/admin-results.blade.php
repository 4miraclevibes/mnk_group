<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Ujian - {{ $examSubject->name }}</title>
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
        .exam-info {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
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
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }
        .stats-label {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">
                        <i class="fas fa-chart-bar me-2"></i>Hasil Ujian - {{ $examSubject->name }}
                    </h1>
                    <p class="mb-0">{{ $examSubject->examType->testCategory->name }} - {{ $examSubject->examType->name }} ({{ $examSubject->examType->section }})</p>
                </div>
                <a href="{{ route('exams.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Exam Info -->
        <div class="exam-info">
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-number">{{ $results->count() }}</div>
                        <div class="stats-label">Total Peserta</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-number">{{ $results->avg('score') ? number_format($results->avg('score'), 1) : 0 }}</div>
                        <div class="stats-label">Rata-rata Nilai</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-number">{{ $results->max('score') ? number_format($results->max('score'), 1) : 0 }}</div>
                        <div class="stats-label">Nilai Tertinggi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card text-center">
                        <div class="stats-number">{{ $results->min('score') ? number_format($results->min('score'), 1) : 0 }}</div>
                        <div class="stats-label">Nilai Terendah</div>
                    </div>
                </div>
            </div>
        </div>

        @if($results->count() > 0)
            @foreach($results as $result)
                <div class="result-card">
                    <div class="d-flex align-items-center">
                        <div class="score-badge {{ $result->score >= 80 ? 'excellent' : ($result->score >= 60 ? 'good' : ($result->score >= 40 ? 'average' : 'poor')) }}">
                            {{ number_format($result->score, 0) }}
                        </div>

                        <div class="result-info">
                            <div class="result-title">
                                {{ $result->user->name ?? 'User Tidak Ditemukan' }}
                            </div>
                            <div class="result-subtitle">
                                {{ $result->user->email ?? 'Email tidak tersedia' }}
                            </div>
                            <div class="result-meta">
                                @php
                                    // Extract data untuk kecermatan
                                    if($examSubject->examType->section == 'KECERMATAN') {
                                        preg_match('/Skor: (-?\d+)/', $result->description, $scoreMatch);
                                        preg_match('/Benar: (\d+)/', $result->description, $correctMatch);
                                        preg_match('/Salah: (\d+)/', $result->description, $wrongMatch);
                                        $mainDesc = preg_replace('/\s*\(.*\)/', '', $result->description);
                                        $rawScore = $scoreMatch[1] ?? 0;
                                        $correctAnswers = $correctMatch[1] ?? 0;
                                        $wrongAnswers = $wrongMatch[1] ?? 0;
                                    }
                                @endphp

                                <div class="meta-item">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $examSubject->examType->section == 'KECERMATAN' ? ($mainDesc ?? 'N/A') : ($result->description ?? 'N/A') }}</span>
                                </div>

                                @if($examSubject->examType->section == 'KECERMATAN')
                                    <div class="meta-item">
                                        <i class="fas fa-chart-line"></i>
                                        <span>Skor: {{ $rawScore ?? 0 }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-check text-success"></i>
                                        <span>Benar: {{ $correctAnswers ?? 0 }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-times text-danger"></i>
                                        <span>Salah: {{ $wrongAnswers ?? 0 }}</span>
                                    </div>
                                @endif

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
                            @if($examSubject->examType->section == 'AKADEMIK')
                                <a href="{{ route('exam.result', $result->id) }}" class="btn-detail">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            @elseif($examSubject->examType->section == 'KECERMATAN')
                                <a href="{{ route('kecermatan.result', $result->id) }}" class="btn-detail">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3 class="mb-3">Belum Ada Hasil Ujian</h3>
                <p class="text-muted mb-4">Belum ada peserta yang mengerjakan ujian ini.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
