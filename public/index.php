<?php

require '../vendor/autoload.php';

// Membuat session
session_start();

// Membuat instance dari kelas Router
$router = require '../src/routes/index.php';