<?php use App\Core\View; ?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">Absensi Peserta</h1>
        </div>

        <!-- Card Absensi -->
        <div class="row">
            <?php $no = 1;
            foreach ($kelas as $k): ?>
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp"
                    data-wow-delay="<?php echo htmlspecialchars((string) $no * 0.2) ?>s">
                    <div class="card shadow rounded-3" style="cursor: pointer;" data-bs-toggle="modal"
                        data-bs-target="#attendanceModal" data-id-kelas="<?php echo htmlspecialchars($k['id_kelas']); ?>"
                        data-pembelajaran="<?php echo htmlspecialchars($k['pembelajaran']); ?>"
                        data-pengajar="<?php echo htmlspecialchars($k['pengajar']); ?>"
                        data-materi="<?php echo htmlspecialchars($k['materi']); ?>"
                        data-berakhir="<?php echo htmlspecialchars(date('d M Y', strtotime($k['berakhir']))); ?>">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($k['pembelajaran']); ?></h5>
                            <p class="card-text mb-2">
                                <strong>Pengajar:</strong>
                                <span class="badge bg-primary text-dark">
                                    <?php echo htmlspecialchars($k['pengajar']); ?>
                                </span>
                            </p>
                            <p class="card-text mb-2">
                                <strong>Materi:</strong>
                                <?php echo htmlspecialchars($k['materi']); ?>
                            </p>
                            <p class="card-text text-muted">
                                <strong>Berakhir pada:</strong> <?php echo date('d M Y', strtotime($k['berakhir'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php $no++; endforeach; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Absensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modalNip" class="form-label">NIP</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nip']) ?>"
                            id="modalNip" name="nip" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalNama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['nama']) ?>"
                            id="modalNama" name="nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalPembelajaran" class="form-label">Pembelajaran</label>
                        <input type="text" class="form-control" id="modalPembelajaran" name="pembelajaran" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalPengajar" class="form-label">Pengajar</label>
                        <input type="text" class="form-control" id="modalPengajar" name="pengajar" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalMateri" class="form-label">Materi</label>
                        <input type="text" class="form-control" id="modalMateri" name="materi" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalBerakhir" class="form-label">Berakhir Pada</label>
                        <input type="text" class="form-control" id="modalBerakhir" name="berakhir" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modalAbsensi" class="form-label">Absensi Pada</label>
                        <select class="form-control" id="modalAbsensi" name="absensi" required>
                            <option value="" selected disabled>Pilih absensi</option>
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3" id="keteranganContainer" style="display: none">
                        <label for="modalKeterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="modalKeterangan" name="keterangan">
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

<script>
    document.getElementById('attendanceModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const pembelajaran = button.getAttribute('data-pembelajaran');
        const pengajar = button.getAttribute('data-pengajar');
        const materi = button.getAttribute('data-materi');
        const berakhir = button.getAttribute('data-berakhir');
        const idKelas = button.getAttribute('data-id-kelas');

        document.getElementById('modalPembelajaran').value = pembelajaran || '';
        document.getElementById('modalPengajar').value = pengajar || '';
        document.getElementById('modalMateri').value = materi || '';
        document.getElementById('modalBerakhir').value = berakhir || '';

        editForm.action = `/absensi?id=${encodeURIComponent(idKelas)}`;

    });

    document.getElementById('modalAbsensi').addEventListener('change', function () {
        const optionValue = this.value;
        const keteranganContainer = document.getElementById('keteranganContainer');
        const keteranganInput = document.getElementById('modalKeterangan');

        if (optionValue === 'sakit' || optionValue === 'izin') {
            keteranganContainer.style.display = 'block';
        } else {
            keteranganContainer.style.display = 'none';
            keteranganInput.value = '';
        }
    });


</script>