<?php

namespace App\Exports;

use App\Models\ExamResult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExamResultsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $examSubjectId;

    public function __construct($examSubjectId)
    {
        $this->examSubjectId = $examSubjectId;
    }

    public function collection()
    {
        return ExamResult::with([
            'examSubject.examType.testCategory',
            'user'
        ])
        ->where('exam_subject_id', $this->examSubjectId)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Peserta',
            'Email',
            'Kategori',
            'Jenis Ujian',
            'Section',
            'Subject',
            'Nilai',
            'Deskripsi',
            'Tanggal & Waktu'
        ];
    }

    public function map($result): array
    {
        return [
            '', // No akan diisi di Excel
            $result->user->name ?? 'User Tidak Ditemukan',
            $result->user->email ?? 'Email tidak tersedia',
            $result->examSubject->examType->testCategory->name ?? '-',
            $result->examSubject->examType->name ?? '-',
            $result->examSubject->examType->section ?? '-',
            $result->examSubject->name ?? '-',
            $result->score,
            $result->description ?? '-',
            $result->created_at->format('d/m/Y H:i:s')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '667eea']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 30,
            'D' => 20,
            'E' => 20,
            'F' => 15,
            'G' => 20,
            'H' => 10,
            'I' => 50,
            'J' => 20,
        ];
    }
}

