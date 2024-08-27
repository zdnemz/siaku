<?php
use App\Core\View;

View::render('Components/navbar');
?>

<!-- Admin Dashboard Start -->
<div class="container-fluid py-5">
    <div class="hero-header overflow-hidden px-5">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">User Management</h5>
                        <p class="card-text">Manage all users in the system.</p>
                        <a href="/admin/users" class="btn btn-primary btn-sm">Go to Users</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Analytics</h5>
                        <p class="card-text">View website analytics and reports.</p>
                        <a href="/admin/analytics" class="btn btn-success btn-sm">View Analytics</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.6s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-cog fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Settings</h5>
                        <p class="card-text">Configure system settings.</p>
                        <a href="/admin/settings" class="btn btn-warning btn-sm">Go to Settings</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.8s">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Generate and view system reports.</p>
                        <a href="/admin/reports" class="btn btn-danger btn-sm">View Reports</a>
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