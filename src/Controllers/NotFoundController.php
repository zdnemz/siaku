<?php

namespace App\Controllers;
use App\Core\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Siaku - Not Found",
        ];

        $this->render('404', $data);
    }
}