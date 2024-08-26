<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    // Method untuk menangani permintaan ke halaman utama (home)
    public function index()
    {
        // Menyiapkan data yang akan dikirim ke tampilan (view)
        $data = [
            'title' => 'Siaku - Home',
        ];

        // Merender tampilan 'index' dengan data yang telah disiapkan
        $this->render('index', $data);
    }
}
