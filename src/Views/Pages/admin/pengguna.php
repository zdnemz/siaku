<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">Pengguna</h1>
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
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengguna as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($p['nip']) ?></td>
                            <td><?= htmlspecialchars($p['email']) ?></td>
                            <td><?= htmlspecialchars($p['nama']) ?></td>
                            <td><?= htmlspecialchars($p['divisi']) ?></td>
                            <td><?= htmlspecialchars($p['role']) ?></td>
                            <td class="d-flex justify-content-center align-items-center gap-3">
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= htmlspecialchars($p['id_pengguna']) ?>"
                                    data-nip="<?= htmlspecialchars($p['nip']) ?>"
                                    data-email="<?= htmlspecialchars($p['email']) ?>"
                                    data-nama="<?= htmlspecialchars($p['nama']) ?>"
                                    data-id-divisi="<?= htmlspecialchars($p['id_divisi']) ?>"
                                    data-hak-akses="<?= htmlspecialchars($p['role']) ?>">Edit</button>
                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= htmlspecialchars($p['id_pengguna']) ?>"
                                    data-nama="<?= htmlspecialchars($p['nama']) ?>">Hapus</button>
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
            <form action="/admin/pengguna/create" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addNIP" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="addNIP" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="password-field">Password</label>
                        <div class="form-control-wrap">
                            <input name="password" id="password-field" type="password" class="form-control" required="">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="addNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="addDivisi" class="form-label">Divisi</label>
                        <select id="addDivisi" name="divisi" class="form-select" required>
                            <option value="" selected disabled>Pilih divisi</option>
                            <?php
                            foreach ($divisi as $d) {
                                echo '<option class="form-control" value="' . htmlspecialchars($d['id_divisi']) . '">'
                                    . htmlspecialchars($d['nama']) . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addHakAkses" class="form-label">Role</label>
                        <select id="addHakAkses" name="role" class="form-select" required>
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="peserta">Peserta</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary"
                        data-bs-dismiss="modal">Tutup</button>
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
                        <label for="editNIP" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="editNIP" name="nip" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDivisi" class="form-label">Divisi</label>
                        <select id="editDivisi" name="divisi" class="form-select" required>
                            <option value="" selected disabled>Pilih divisi</option>
                            <?php
                            foreach ($divisi as $d) {
                                echo '<option class="form-control" value="' . htmlspecialchars($d['id_divisi']) . '">'
                                    . htmlspecialchars($d['nama']) . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editHakAkses" class="form-label">Role</label>
                        <select id="editHakAkses" name="role" class="form-select" required>
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="peserta">Peserta</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary"
                        data-bs-dismiss="modal">Tutup</button>
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
                    <p>Apakah Anda yakin ingin menghapus data pengguna <strong id="deleteNama"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border border-primary rounded-pill text-primary"
                        data-bs-dismiss="modal">Tutup</button>
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
        const nip = button.getAttribute('data-nip');
        const email = button.getAttribute('data-email');
        const nama = button.getAttribute('data-nama');
        const idDivisi = button.getAttribute('data-id-divisi');
        const hakAkses = button.getAttribute('data-hak-akses');

        const editForm = document.getElementById('editForm');
        const editNIP = document.getElementById('editNIP');
        const editEmail = document.getElementById('editEmail');
        const editNama = document.getElementById('editNama');
        const editDivisi = document.getElementById('editDivisi');
        const editHakAkses = document.getElementById('editHakAkses');

        editForm.action = `/admin/pengguna/edit?id=${encodeURIComponent(id)}`;
        editNIP.value = nip;
        editEmail.value = email;
        editNama.value = nama;

        Array.from(editDivisi.options).forEach(option => {
            if (option.value === idDivisi) {
                option.selected = true;
            } else {
                option.selected = false;
            }
        });

        Array.from(editHakAkses.options).forEach(option => {
            if (option.value === hakAkses) {
                option.selected = true;
            } else {
                option.selected = false;
            }
        });
    });

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');

        const deleteForm = document.getElementById('deleteForm');
        const deleteNama = document.getElementById('deleteNama');

        deleteForm.action = `/admin/pengguna/delete?id=${encodeURIComponent(id)}`;
        deleteNama.textContent = nama;
    });
</script>