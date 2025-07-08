<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Helpers\JWT;

JWT::init();

// // Membuat session
session_start();

// Membuat instance dari kelas Router
$router = require __DIR__ . '/../src/Routes/index.php';
