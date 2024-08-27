<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php
    View::render('Components/navbar');

    ?>

    <div class="hero-header overflow-hidden px-5">

        <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">
            Divisi
        </h1>
        <div class="table-responsive wow fadeInUp" data-wow-delay="0.3s">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                foreach ($divisi as $d) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama'] ?></td>
                        <td>
                            <a href="/admin/divisi/edit?id=<?= $d['id_divisi'] ?>" class="btn btn-primary">Edit</a>
                            <a href="/admin/divisi/delete?id=<?= $d['id_divisi'] ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>