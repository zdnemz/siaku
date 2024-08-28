<?php
use App\Core\View;

View::render('Components/navbar');
?>

<!-- Admin Dashboard Start -->
<div class="container-fluid py-5">
    <div class="hero-header overflow-hidden px-5">
        <div class="row justify-content-center">
            <!-- Pengguna Manajemen Card -->
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-user-cog fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Pengguna Manajemen</h5>
                        <p class="card-text">Kelola semua pengguna dalam sistem.</p>
                        <a href="/admin/pengguna" class="btn btn-primary btn-sm">Go to Management</a>
                    </div>
                </div>
            </div>
            <!-- Kelas Manajemen Card -->
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Kelas Manajemen</h5>
                        <p class="card-text">Kelola semua kelas dalam sistem.</p>
                        <a href="/admin/kelas" class="btn btn-success btn-sm">Go to Management</a>
                    </div>
                </div>
            </div>
            <!-- Pengajar Manajemen Card -->
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Pengajar Manajemen</h5>
                        <p class="card-text">Kelola semua pengajar dalam sistem.</p>
                        <a href="/admin/pengajar" class="btn btn-warning btn-sm">Go to Management</a>
                    </div>
                </div>
            </div>
            <!-- Divisi Manajemen Card -->
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.8s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-3x mb-3 text-info"></i>
                        <h5 class="card-title">Divisi Manajemen</h5>
                        <p class="card-text">Kelola semua divisi dalam sistem.</p>
                        <a href="/admin/divisi" class="btn btn-info btn-sm">Go to Management</a>
                    </div>
                </div>
            </div>
            <!-- Laporan Absensi Card -->
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="1.0s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Laporan Absensi</h5>
                        <p class="card-text">Buat dan lihat laporan sistem.</p>
                        <a href="/admin/laporan" class="btn btn-danger btn-sm">View Reports</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Admin Dashboard End -->

<?php
View::render('Components/footer');
?>