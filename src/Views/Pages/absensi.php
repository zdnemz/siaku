<?php use App\Core\View; ?>

<?php
$participants = [
    [
        'name' => 'John Doe',
        'status' => 'Present',
        'date' => '2024-08-25',
    ],
    [
        'name' => 'Jane Smith',
        'status' => 'Absent',
        'date' => '2024-08-25',
    ],
    [
        'name' => 'Robert Brown',
        'status' => 'Present',
        'date' => '2024-08-25',
    ],
    [
        'name' => 'Emily White',
        'status' => 'Absent',
        'date' => '2024-08-25',
    ],
    [
        'name' => 'Michael Johnson',
        'status' => 'Present',
        'date' => '2024-08-25',
    ],
];
?>

<div class="container-fluid header position-relative overflow-hidden p-0">

    <?php View::render('Components/navbar'); ?>

    <div class="hero-header overflow-hidden px-5">
        <div class="d-flex justify-content-between align-items-center mb-3 wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="display-4 text-dark mb-4">Absensi Peserta</h1>
        </div>

        <!-- Card Absensi -->
        <div class="row">
            <?php $no = 1;
            foreach ($participants as $participant): ?>
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp"
                    data-wow-delay="<?php echo htmlspecialchars((string) $no * 0.2) ?>s">
                    <div class="card shadow-sm" style="cursor: pointer;" data-bs-toggle="modal"
                        data-bs-target="#attendanceModal" data-name="<?php echo $participant['name']; ?>"
                        data-status="<?php echo $participant['status']; ?>"
                        data-date="<?php echo date('d M Y', strtotime($participant['date'])); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $participant['name']; ?></h5>
                            <p class="card-text">
                                Status:
                                <span
                                    class="badge <?php echo $participant['status'] == 'Present' ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo $participant['status']; ?>
                                </span>
                            </p>
                            <p class="card-text">
                                Date: <?php echo date('d M Y', strtotime($participant['date'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                $no++;
            endforeach;
            ?>
        </div>
    </div>
</div>

<!-- Modal Absensi -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="attendanceModalLabel">Detail Absensi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="participantName" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="participantName" readonly>
                </div>
                <div class="mb-3">
                    <label for="participantStatus" class="form-label">Status</label>
                    <input type="text" class="form-control" id="participantStatus" readonly>
                </div>
                <div class="mb-3">
                    <label for="attendanceDate" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="attendanceDate" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light border border-primary rounded-pill text-primary"
                    data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>