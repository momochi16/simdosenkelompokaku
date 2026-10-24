<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkRole('admin');

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama_lengkap'];
    $role = $_POST['role'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $nama, $role]);
        $success = "User berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Gagal: " . $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Tambah Pengguna Baru</h5>
                <a href="users_list.php" class="btn btn-sm btn-light border"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i><?php echo $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" required placeholder="Contoh: admin123">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" required placeholder="Nama lengkap pengguna">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Hak Akses (Role)</label>
                        <select name="role" class="form-select">
                            <option value="admin">Administrator</option>
                            <option value="pimpinan">Pimpinan / Rektorat</option>
                            <option value="dosen">Dosen</option>
                        </select>
                        <div class="form-text mt-2">Pilih peran sesuai dengan tanggung jawab pengguna dalam sistem.</div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="reset" class="btn btn-light border">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
