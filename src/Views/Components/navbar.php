<?php
// Ambil nilai user_id dari $_SESSION jika tersedia
$session_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="/" class="navbar-brand p-0 d-flex align-items-center">
        <img src="/assets/images/favicon.ico" class="img-fluid me-2" alt="Logo" style="margin-right: 10px;">
        <h1 class="display-6 text-primary m-0">
            <span>Siaku</span>
        </h1>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/" class="nav-item nav-link active">Beranda</a>
            <a href="/about" class="nav-item nav-link">Tentang</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Halaman</a>
                <div class="dropdown-menu m-0">
                    <a href="/absensi" class="dropdown-item">Absensi</a>
                    <a href="/profil" class="dropdown-item">Profil</a>
                </div>
            </div>
        </div>
        <?php if (!$session_id) { ?>
            <a href="/login" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Masuk</a>
            <a href="/register" class="btn btn-primary rounded-pill text-white py-2 px-4">Daftar</a>
        <?php } else { ?>
            <form action="/logout" method="POST">
                <input type="submit" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4"
                    value="Keluar">
            </form>
        <?php } ?>
    </div>
</nav>