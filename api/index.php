<?php

require __DIR__ . '/../vendor/autoload.php';

// // Membuat session
session_start();

// Membuat instance dari kelas Router
$router = require __DIR__ . '/../src/Routes/index.php';
