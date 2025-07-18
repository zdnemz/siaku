<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">Divisi</h1>
            <button type="button" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4"
                data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Data
            </button>
        </div>
        <div class="table-responsive wow fadeInUp" data-wow-delay="0.3s">
            <table class="table table-bordered table-striped" style="table-layout: auto;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($divisi as $d): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama']) ?></td>
                            <td class="d-flex justify-content-center align-items-center gap-3">
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= $d['id_divisi'] ?>"
                                    data-nama="<?= htmlspecialchars($d['nama']) ?>">Edit</button>
                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $d['id_divisi'] ?>"
                                    data-nama="<?= htmlspecialchars($d['nama']) ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/divisi/create" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addNamaDivisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="addNamaDivisi" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNamaDivisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="editNamaDivisi" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus divisi <strong id="deleteNamaDivisi"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger rounded-pill">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');

        const editForm = document.getElementById('editForm');
        const editNamaDivisi = document.getElementById('editNamaDivisi');

        editForm.action = `/admin/divisi/edit?id=${encodeURIComponent(id)}`;
        editNamaDivisi.value = nama;
    });

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');

        const deleteForm = document.getElementById('deleteForm');
        const deleteNamaDivisi = document.getElementById('deleteNamaDivisi');

        deleteForm.action = `/admin/divisi/delete?id=${encodeURIComponent(id)}`;
        deleteNamaDivisi.textContent = nama;
    });
</script>