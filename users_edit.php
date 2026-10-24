<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkRole('admin');

$id = $_GET['id'] ?? die('ID missing');
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama_lengkap'];
    $role = $_POST['role'];
    
    try {
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET username=?, password=?, nama_lengkap=?, role=? WHERE id=?");
            $stmt->execute([$username, $password, $nama, $role, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username=?, nama_lengkap=?, role=? WHERE id=?");
            $stmt->execute([$username, $nama, $role, $id]);
        }
        $success = "User berhasil diperbarui!";
    } catch (PDOException $e) {
        $error = "Gagal: " . $e->getMessage();
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$u = $stmt->fetch();
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Data Pengguna: <?php echo htmlspecialchars($u['username']); ?></h5>
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
                            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($u['username']); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru (Kosongkan jika tidak diubah)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Isi hanya jika ingin mengganti password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($u['nama_lengkap']); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Hak Akses (Role)</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?php echo $u['role'] == 'admin' ? 'selected' : ''; ?>>Administrator</option>
                            <option value="pimpinan" <?php echo $u['role'] == 'pimpinan' ? 'selected' : ''; ?>>Pimpinan / Rektorat</option>
                            <option value="dosen" <?php echo $u['role'] == 'dosen' ? 'selected' : ''; ?>>Dosen</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Perbarui User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
