<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\AbsensiModel;

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

        // Set header untuk mengunduh file Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Absensi_' . date('Ymd') . '.xls"');
        header('Cache-Control: max-age=0');

        // Awal dari XML Spreadsheet
        echo '<?xml version="1.0"?>';
        echo '<?mso-application progid="Excel.Sheet"?>';
        echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
            xmlns:o="urn:schemas-microsoft-com:office:office"
            xmlns:x="urn:schemas-microsoft-com:office:excel"
            xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
            <Worksheet ss:Name="Sheet1">
            <Table>';

        // Header kolom
        echo '<Row>';
        echo '<Cell><Data ss:Type="String">No</Data></Cell>';
        echo '<Cell><Data ss:Type="String">Nama</Data></Cell>';
        echo '<Cell><Data ss:Type="String">Pembelajaran</Data></Cell>';
        echo '<Cell><Data ss:Type="String">Status</Data></Cell>';
        echo '<Cell><Data ss:Type="String">Keterangan</Data></Cell>';
        echo '</Row>';

        // Data baris demi baris
        $no = 1;
        foreach ($laporan as $l) {
            echo '<Row>';
            echo '<Cell><Data ss:Type="Number">' . $no++ . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($l['nama']) . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($l['pembelajaran']) . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($l['status']) . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($l['keterangan']) . '</Data></Cell>';
            echo '</Row>';
        }

        // Akhir dari XML Spreadsheet
        echo '</Table></Worksheet></Workbook>';

        exit;
    }
}
