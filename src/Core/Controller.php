<?php

namespace App\Core;

class Controller
{
    protected $data = [];

    // Method untuk merender tampilan (view) dengan data yang diberikan, serta mendukung layout
    protected function render($view, $data = [], $layout = 'index')
    {
        $data = array_merge($data, $this->data);

        // Mengambil data dari array $data dan mendeklarasikan variabel untuk setiap kunci dalam array
        extract($data);

        // Menentukan direktori dasar tempat file tampilan disimpan
        $baseDir = __DIR__ . '/../views/';
        // Menentukan path lengkap file tampilan dan layout berdasarkan nama yang diberikan
        $viewFilePath = "{$baseDir}Pages/{$view}.php";
        $layoutFilePath = "{$baseDir}layouts/{$layout}.php";

        // Memeriksa apakah file tampilan ada di path yang ditentukan
        if (!file_exists($viewFilePath)) {
            // Jika file tampilan tidak ditemukan, lemparkan exception dengan pesan yang sesuai
            throw new \Exception("View {$viewFilePath} not found");
        }

        // Memeriksa apakah file layout ada di path yang ditentukan
        if (!file_exists($layoutFilePath)) {
            // Jika file layout tidak ditemukan, lemparkan exception dengan pesan yang sesuai
            throw new \Exception("Layout {$layoutFilePath} not found");
        }

        // Mengaktifkan output buffering
        ob_start();
        // Menyertakan file tampilan dan menyimpan output ke buffer
        include $viewFilePath;
        // Mengambil isi buffer dan membersihkannya
        $content = ob_get_clean();

        // Menyertakan file layout yang akan menampilkan konten yang telah di-buffer
        include $layoutFilePath;
    }

    protected function redirect($url, array $queryParams = [])
    {
        if (!empty($queryParams)) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . $this->buildQueryString($queryParams);
        }
        header("Location: {$url}");
        exit;
    }


    private function buildQueryString(array $params)
    {
        return http_build_query($params);
    }

}

