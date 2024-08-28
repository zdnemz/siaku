<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">kelas</h1>
            <button type="button" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4"
                onclick="window.location.href='laporan/export'">
                Export Laporan
            </button>

        </div>
        <div class=" table-responsive wow fadeInUp" data-wow-delay="0.3s">
            <table class="table table-bordered table-striped" style="table-layout: auto;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pembelajaran</th>
                        <th>status</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($laporan as $l): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($l['nama']) ?></td>
                            <td><?= htmlspecialchars($l['pembelajaran']) ?></td>
                            <td><?= htmlspecialchars($l['status']) ?></td>
                            <td><?= htmlspecialchars($l['keterangan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>