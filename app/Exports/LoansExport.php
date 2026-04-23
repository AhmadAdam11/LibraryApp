<?php

namespace App\Exports;

use App\Models\Loan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LoansExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Loan::with(['user', 'book'])->get()->map(function ($loan) {
            return [
                'Nama User' => $loan->user->name ?? '-',
                'Judul Buku' => $loan->book->title ?? '-',
                'Tanggal Pinjam' => $loan->borrowed_at
                    ? Carbon::parse($loan->borrowed_at)->format('d-m-Y')
                    : '-',
                'Jatuh Tempo' => $loan->due_date
                    ? Carbon::parse($loan->due_date)->format('d-m-Y')
                    : '-',
                'Tanggal Kembali' => $loan->returned_at
                    ? Carbon::parse($loan->returned_at)->format('d-m-Y')
                    : '-',
                'Status' => ucfirst(str_replace('_', ' ', $loan->status)),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama User',
            'Judul Buku',
            'Tanggal Pinjam',
            'Jatuh Tempo',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        $sheet->getStyle('C:F')->getAlignment()->setHorizontal('center');

        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:F' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        return [];
    }
}