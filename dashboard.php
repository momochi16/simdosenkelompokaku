<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkLogin();

// Count data for dashboard stats
$stmtDosen = $pdo->query("SELECT COUNT(*) FROM dosen");
$totalDosen = $stmtDosen->fetchColumn();

$stmtSerdos = $pdo->query("SELECT COUNT(*) FROM dosen WHERE status_serdos LIKE '%Sudah%'");
$totalSerdos = $stmtSerdos->fetchColumn();

$stmtAktif = $pdo->query("SELECT COUNT(*) FROM dosen WHERE status_aktivitas = 'Aktif'");
$totalAktif = $stmtAktif->fetchColumn();

// Latest activities (sample)
$latestDosen = $pdo->query("SELECT nama, penempatan, created_at FROM dosen ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 bg-primary-green text-white shadow-sm overflow-hidden" style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--deep-green) 100%);">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-2">Selamat Datang, <?php echo explode(' ', $_SESSION['nama_lengkap'])[0]; ?>!</h2>
                        <p class="lead opacity-75 mb-0">Sistem Informasi Manajemen Dosen Universitas Muhammadiyah Bengkulu siap membantu pekerjaan Anda hari ini.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="bi bi-mortarboard-fill display-1 opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="stat-card">
                <div class="stat-icon bg-soft-info">
                    <i class="bi bi-people-fill text-info"></i>
                </div>
                <div class="stat-info">
                    <p>Total Dosen</p>
                    <h3><?php echo $totalDosen; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="stat-card">
                <div class="stat-icon bg-soft-success">
                    <i class="bi bi-award-fill text-success"></i>
                </div>
                <div class="stat-info">
                    <p>Tersertifikasi</p>
                    <h3><?php echo $totalSerdos; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="stat-card">
                <div class="stat-icon bg-soft-warning">
                    <i class="bi bi-person-check-fill text-warning"></i>
                </div>
                <div class="stat-info">
                    <p>Dosen Aktif</p>
                    <h3><?php echo $totalAktif; ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Dosen Terbaru Bergabung</h5>
                <a href="dosen_list.php" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Dosen</th>
                                <th>Penempatan</th>
                                <th>Tanggal Gabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestDosen as $d): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo $d['nama']; ?></div>
                                </td>
                                <td><?php echo $d['penempatan']; ?></td>
                                <td class="text-muted small"><?php echo date('d M Y', strtotime($d['created_at'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Akses Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="dosen_add.php" class="btn btn-outline-success text-start p-3 d-flex align-items-center">
                        <i class="bi bi-person-plus-fill fs-4 me-3"></i>
                        <div>
                            <div class="fw-bold">Tambah Dosen</div>
                            <small class="text-muted">Input data dosen baru ke sistem</small>
                        </div>
                    </a>
                    <a href="laporan.php" class="btn btn-outline-success text-start p-3 d-flex align-items-center">
                        <i class="bi bi-printer-fill fs-4 me-3"></i>
                        <div>
                            <div class="fw-bold">Cetak Laporan</div>
                            <small class="text-muted">Generate laporan dosen aktif</small>
                        </div>
                    </a>
                    <?php if (isAdmin()): ?>
                    <a href="users_list.php" class="btn btn-outline-success text-start p-3 d-flex align-items-center">
                        <i class="bi bi-shield-lock-fill fs-4 me-3"></i>
                        <div>
                            <div class="fw-bold">Keamanan Sistem</div>
                            <small class="text-muted">Kelola akun dan hak akses user</small>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
