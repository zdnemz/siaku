<?php

use App\Core\View;

?>

<div class="container-fluid header position-relative overflow-hidden p-0">
    <?php
    View::render('Components/navbar');
    ?>
    <div class="hero-header overflow-hidden px-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-4 text-dark text-center mb-4 wow fadeInUp" data-wow-delay="0.3s">
                        Profil
                    </h1>
                    <table class="table table-borderless wow fadeInUp" data-wow-delay="0.7s"
                        style="width: auto; margin: 0 auto;">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td><?= htmlspecialchars($user['nama']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>NIP</strong></td>
                            <td><?= htmlspecialchars($user['nip']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Divisi</strong></td>
                            <td><?= htmlspecialchars($user['divisi']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
View::render('Components/footer');
?>