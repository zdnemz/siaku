<?php
use App\Core\View;

View::render('Components/navbar');
?>

<!-- 404 Start -->
<div class="container-fluid py-5">
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                <h1 class="display-1">401</h1>
                <h1 class="mb-4">Akses ditolak</h1>
                <p class="mb-4">Ups!, anda tidak diizinkan mengakses halaman ini</p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="/">Kembali ke beranda</a>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->

<?php
View::render('Components/footer');
?>