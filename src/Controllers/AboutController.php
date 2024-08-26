<?php

namespace App\Controllers;

use App\Core\Controller;

class AboutController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Siaku - Tentang Kami',
        ];

        $this->render('about', $data);
        return;

    }
}