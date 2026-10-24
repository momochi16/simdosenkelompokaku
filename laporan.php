<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkLogin();

$stmt = $pdo->query("SELECT * FROM dosen ORDER BY nama ASC");
$dosenList = $stmt->fetchAll();
?>

<style>
    @media print {
        #sidebar, .navbar, .btn-toolbar, footer { display: none !important; }
        #content { margin-left: 0 !important; width: 100% !important; padding: 0 !important; }
        .card { border: none !important; box-shadow: none !important; }
        .container-fluid { padding: 0 !important; }
        body { background: #fff !important; }
        .table thead th { background-color: #eee !important; color: #000 !important; }
    }
</style>

<div class="card border-0 shadow-sm mb-4 no-print">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="fw-bold text-deep-green mb-1">Laporan Data Dosen Aktif</h4>
                <p class="text-muted mb-0">Halaman ini digunakan untuk mencetak laporan resmi daftar dosen Universitas Muhammadiyah Bengkulu.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <button onclick="window.print()" class="btn btn-primary px-4">
                    <i class="bi bi-printer-fill me-2"></i> Cetak Laporan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-5">
        <!-- Header Laporan (Tampak saat cetak) -->
        <div class="text-center mb-5">
            <h4 class="fw-bold text-uppercase mb-1">Daftar Dosen Aktif Universitas</h4>
            <h5 class="fw-normal mb-4">Universitas Muhammadiyah Bengkulu</h5>
            <hr class="border-2 opacity-100 mb-4 mx-auto" style="width: 100px; border-color: var(--primary-green) !important;">
            
            <div class="row justify-content-center text-start mb-4">
                <div class="col-auto">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="fw-bold" width="150">Fakultas</td>
                            <td>: Teknik</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Program Studi</td>
                            <td>: Teknik Informatika</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tahun Akademik</td>
                            <td>: 2026/2027</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="text-center bg-light">
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Dosen</th>
                        <th>NIP / NUPTK</th>
                        <th>Jabatan / Pangkat</th>
                        <th>Pendidikan</th>
                        <th>Status</th>
                        <th>Penempatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dosenList) > 0): ?>
                        <?php $no = 1; foreach ($dosenList as $d): ?>
                        <tr>
                            <td class="text-center small"><?php echo $no++; ?></td>
                            <td class="fw-bold small"><?php echo $d['nama']; ?></td>
                            <td class="small">
                                <div>NIP: <?php echo $d['nip'] ?: '-'; ?></div>
                                <div>NUPTK: <?php echo $d['nuptk'] ?: '-'; ?></div>
                            </td>
                            <td class="small">
                                <div><?php echo $d['jabatan_fungsional'] ?: '-'; ?></div>
                                <div class="text-muted smaller"><?php echo $d['kepangkatan'] ?: '-'; ?></div>
                            </td>
                            <td class="text-center small"><?php echo $d['pendidikan_terakhir']; ?></td>
                            <td class="text-center small"><?php echo $d['status_aktivitas']; ?></td>
                            <td class="small"><?php echo $d['penempatan']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted small">Tidak ada data dosen tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Footer Laporan / Tanda Tangan -->
        <div class="row mt-5 pt-4">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p class="mb-5 small">Bengkulu, <?php echo date('d F Y'); ?><br>Mengetahui,</p>
                <div class="mt-5 pt-3">
                    <div class="fw-bold border-bottom d-inline-block px-3">Administrator Sistem</div>
                    <div class="small text-muted mt-1">NIP. ...........................</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
