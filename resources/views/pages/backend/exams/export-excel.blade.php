<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel - {{ $examSubject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">
                        <i class="fas fa-file-excel me-2"></i>Export Excel - {{ $examSubject->name }}
                    </h1>
                    <p class="mb-0">{{ $examSubject->examType->testCategory->name }} - {{ $examSubject->examType->name }} ({{ $examSubject->examType->section }})</p>
                </div>
                <a href="{{ route('exams.admin-results', $examSubject->id) }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Hasil Ujian</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="exportTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Percobaan Ke</th>
                                <th>Total Percobaan</th>
                                <th>Nilai</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $userAttemptCounts = [];
                                foreach($results as $result) {
                                    if(!isset($userAttemptCounts[$result->user_id])) {
                                        $userAttemptCounts[$result->user_id] = \App\Models\ExamResult::where('exam_subject_id', $examSubject->id)
                                            ->where('user_id', $result->user_id)
                                            ->count();
                                    }
                                }

                                $userResultsOrdered = [];
                                foreach($results as $result) {
                                    if(!isset($userResultsOrdered[$result->user_id])) {
                                        $userResultsOrdered[$result->user_id] = \App\Models\ExamResult::where('exam_subject_id', $examSubject->id)
                                            ->where('user_id', $result->user_id)
                                            ->orderBy('created_at', 'asc')
                                            ->get();
                                    }
                                }
                            @endphp
                            @foreach($results as $index => $result)
                                @php
                                    $userResults = $userResultsOrdered[$result->user_id] ?? collect();
                                    $currentAttempt = $userResults->search(function($item) use ($result) {
                                        return $item->id === $result->id;
                                    }) + 1;
                                    $totalAttempts = $userAttemptCounts[$result->user_id] ?? 0;

                                    // Parse description untuk kecermatan
                                    if($examSubject->examType->section == 'KECERMATAN') {
                                        preg_match('/Skor: (-?\d+)/', $result->description, $scoreMatch);
                                        preg_match('/Benar: (\d+)/', $result->description, $correctMatch);
                                        preg_match('/Salah: (\d+)/', $result->description, $wrongMatch);
                                        $mainDesc = preg_replace('/\s*\(.*\)/', '', $result->description);
                                        $rawScore = $scoreMatch[1] ?? 0;
                                        $correctAnswers = $correctMatch[1] ?? 0;
                                        $wrongAnswers = $wrongMatch[1] ?? 0;
                                        $displayDesc = $mainDesc ?? $result->description;
                                    } else {
                                        $displayDesc = $result->description;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $result->user->name ?? 'User Tidak Ditemukan' }}</td>
                                    <td>{{ $result->user->email ?? 'Email tidak tersedia' }}</td>
                                    <td class="text-center">{{ $currentAttempt }}</td>
                                    <td class="text-center">{{ $totalAttempts }}</td>
                                    <td class="text-center"><strong>{{ number_format($result->score, 0) }}</strong></td>
                                    <td>{{ $displayDesc }}</td>
                                    <td>{{ $result->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $result->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('#exportTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1"></i>Export Excel',
                        className: 'btn btn-success',
                        title: 'Hasil_Ujian_{{ str_replace(" ", "_", $examSubject->name) }}_{{ date("Y-m-d") }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1"></i>Export PDF',
                        className: 'btn btn-danger',
                        title: 'Hasil Ujian - {{ $examSubject->name }}',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1"></i>Print',
                        className: 'btn btn-primary',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                language: {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang tersedia",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                pageLength: 25,
                order: [[0, 'asc']],
                responsive: true
            });
        });
    </script>
</body>
</html>

