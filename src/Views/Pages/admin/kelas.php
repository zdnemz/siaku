<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">kelas</h1>
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
                        <th>Pembelajaran</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                        <th>Grup</th>
                        <th>Materi</th>
                        <th>Zoom</th>
                        <th>Pengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($kelas as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['pembelajaran']) ?></td>
                            <td><?= htmlspecialchars($k['mulai']) ?></td>
                            <td><?= htmlspecialchars($k['berakhir']) ?></td>
                            <td><?= htmlspecialchars($k['grup']) ?></td>
                            <td><?= htmlspecialchars($k['materi']) ?></td>
                            <td><?= htmlspecialchars($k['zoom']) ?></td>
                            <td><?= htmlspecialchars($k['pengajar']) ?></td>
                            <td class="d-flex justify-content-center align-items-center gap-3">
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= $k['id_kelas'] ?>"
                                    data-pembelajaran="<?= htmlspecialchars($k['pembelajaran']) ?>"
                                    data-mulai="<?= htmlspecialchars($k['mulai']) ?>"
                                    data-berakhir="<?= htmlspecialchars($k['berakhir']) ?>"
                                    data-grup="<?= htmlspecialchars($k['grup']) ?>"
                                    data-materi="<?= htmlspecialchars($k['materi']) ?>"
                                    data-zoom="<?= htmlspecialchars($k['zoom']) ?>"
                                    data-pengajar="<?= htmlspecialchars($k['id_pengajar']) ?>">Edit</button>
                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $k['id_kelas'] ?>"
                                    data-pembelajaran="<?= htmlspecialchars($k['pembelajaran']) ?>">Hapus</button>
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
            <form action="/admin/kelas/create" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addPembelajaran" class="form-label">Pembelajaran</label>
                        <input type="text" class="form-control" id="addPembelajaran" name="pembelajaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="addMulai" class="form-label">Mulai</label>
                        <input type="date" class="form-control" id="addMulai" name="mulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="addBerakhir" class="form-label">Berakhir</label>
                        <input type="date" class="form-control" id="addBerakhir" name="berakhir" required>
                    </div>
                    <div class="mb-3">
                        <label for="addGrup" class="form-label">Grup</label>
                        <input type="text" class="form-control" id="addGrup" name="grup" required>
                    </div>
                    <div class="mb-3">
                        <label for="addMateri" class="form-label">Materi</label>
                        <input type="text" class="form-control" id="addMateri" name="materi" required>
                    </div>
                    <div class="mb-3">
                        <label for="addZoom" class="form-label">Zoom</label>
                        <input type="text" class="form-control" id="addZoom" name="zoom" required>
                    </div>
                    <div class="mb-3">
                        <label for="addPengajar" class="form-label">Pengajar</label>
                        <select id="addPengajar" name="pengajar" class="form-select" required>
                            <option value="" selected disabled>Pilih Pengajar</option>
                            <?php
                            foreach ($pengajar as $p) {
                                echo '<option class="form-control" value="' . htmlspecialchars($p['id_pengajar']) . '">'
                                    . htmlspecialchars($p['nama']) . '</option>';
                            } ?>
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
                        <label for="editPembelajaran" class="form-label">Pembelajaran</label>
                        <input type="text" class="form-control" id="editPembelajaran" name="pembelajaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMulai" class="form-label">Mulai</label>
                        <input type="date" class="form-control" id="editMulai" name="mulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="editBerakhir" class="form-label">Berakhir</label>
                        <input type="date" class="form-control" id="editBerakhir" name="berakhir" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGrup" class="form-label">Grup</label>
                        <input type="text" class="form-control" id="editGrup" name="grup" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMateri" class="form-label">Materi</label>
                        <input type="text" class="form-control" id="editMateri" name="materi" required>
                    </div>
                    <div class="mb-3">
                        <label for="editZoom" class="form-label">Zoom</label>
                        <input type="text" class="form-control" id="editZoom" name="zoom" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPengajar" class="form-label">Pengajar</label>
                        <select id="editPengajar" name="pengajar" class="form-select" required>
                            <option value="" selected disabled>Pilih Pengajar</option>
                            <?php
                            foreach ($pengajar as $p) {
                                echo '<option class="form-control" value="' . htmlspecialchars($p['id_pengajar']) . '">'
                                    . htmlspecialchars($p['nama']) . '</option>';
                            } ?>
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
                    <p>Apakah Anda yakin ingin menghapus kelas <strong id="deletePembelajaran"></strong>?</p>
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
    const pembelajaran = button.getAttribute('data-pembelajaran');
    const mulai = button.getAttribute('data-mulai');
    const berakhir = button.getAttribute('data-berakhir');
    const grup = button.getAttribute('data-grup');
    const materi = button.getAttribute('data-materi');
    const zoom = button.getAttribute('data-zoom');
    const pengajar = button.getAttribute('data-pengajar');

    const editForm = document.getElementById('editForm');
    const editPembelajaran = document.getElementById('editPembelajaran');
    const editMulai = document.getElementById('editMulai');
    const editBerakhir = document.getElementById('editBerakhir');
    const editGrup = document.getElementById('editGrup');
    const editMateri = document.getElementById('editMateri');
    const editZoom = document.getElementById('editZoom');
    const editPengajar = document.getElementById('editPengajar');

    editForm.action = `/admin/kelas/edit?id=${encodeURIComponent(id)}`;
    editPembelajaran.value = pembelajaran;
    editMulai.value = mulai;
    editBerakhir.value = berakhir;
    editGrup.value = grup;
    editMateri.value = materi;
    editZoom.value = zoom;

    Array.from(editPengajar.options).forEach(option => {
        if (option.value === pengajar) {
            option.selected = true;
        } else {
            option.selected = false;
        }
    });
});


    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const pembelajaran = button.getAttribute('data-pembelajaran');

        const deleteForm = document.getElementById('deleteForm');
        const deletePembelajaran = document.getElementById('deletePembelajaran');

        deleteForm.action = `/admin/kelas/delete?id=${encodeURIComponent(id)}`;
        deletePembelajaran.textContent = pembelajaran;
    });
</script>