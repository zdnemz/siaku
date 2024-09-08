<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middlewares\AuthMiddleware;
use App\Models\AbsensiModel;

// PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    protected $model;

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

        $this->model = new AbsensiModel();
    }

    public function index()
    {

        $laporan = $this->model->getAll();

        return $this->render('admin/laporan', [
            'title' => 'Siaku - Laporan',
            'laporan' => $laporan,
            'divisi' => $laporan
        ]);
    }

public function exportToExcel()
{
    $laporan = $this->model->getAll(); // Ambil data dari model

    // Buat objek spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Laporan Absensi');

    // Styling untuk header
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['argb' => Color::COLOR_WHITE],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FF4CAF50'], // Hijau
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => Color::COLOR_BLACK],
            ],
        ],
    ];

    // Styling untuk data rows
    $dataStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => Color::COLOR_BLACK],
            ],
        ],
        'alignment' => [
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];

    // Header kolom
    $headers = ['No', 'NIP', 'Nama', 'Pembelajaran', 'Status', 'Keterangan'];
    $columnNames = range('A', 'F');

    foreach ($headers as $index => $header) {
        $sheet->setCellValue($columnNames[$index] . '1', $header);
    }

    // Styling header
    $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

    // Data baris demi baris
    $no = 1;
    $row = 2; // Baris kedua, karena baris pertama adalah header
    foreach ($laporan as $l) {
        $sheet->setCellValue('A' . $row, $no++);
        $sheet->setCellValue('B' . $row, $l['nip']);
        $sheet->setCellValue('C' . $row, $l['nama']);
        $sheet->setCellValue('D' . $row, $l['pembelajaran']);
        $sheet->setCellValue('E' . $row, $l['status']);
        $sheet->setCellValue('F' . $row, $l['keterangan']);

        // Styling data
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($dataStyle);
        $row++;
    }

        // Format sebagai tabel
        $tableStyle = new TableStyle();
        $tableStyle->setShowFirstColumn(false);
        $tableStyle->setShowLastColumn(false);
        $tableStyle->setShowRowStripes(true);
        $tableStyle->setShowColumnStripes(true);

        $table = new Table();
        $table->setName('LaporanTable');
        $table->setRange('A1:F' . ($row - 1));
        $table->setName('LaporanTable');
        $table->setStyle($tableStyle);
        $sheet->addTable($table);

        // Set lebar kolom otomatis
    foreach ($columnNames as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Tentukan writer dan file name
    $writer = new Xlsx($spreadsheet); // Gunakan Xlsx untuk format modern .xlsx
    $fileName = 'Laporan_Absensi_' . date('Ymd') . '.xlsx'; // Ganti ekstensi file menjadi .xlsx

    // Set header untuk mengunduh file Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    // Tulis file ke output
    $writer->save('php://output');
    exit;
}
}
