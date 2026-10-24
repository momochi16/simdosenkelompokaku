<?php
require_once 'config/db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Dosen UM Bengkulu</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --deep-green: #166534;
            --primary-green: #15803D;
            --soft-green: #DCFCE7;
        }
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/img/umb.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container { width: 100%; max-width: 400px; padding: 15px; }
        .card { 
            border: none; 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .card-header { 
            background-color: var(--deep-green); 
            padding: 30px 20px; 
            border: none;
        }
        .card-body { padding: 30px; }
        .form-control {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
        }
        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(21, 128, 61, 0.1);
        }
        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-success:hover {
            background-color: var(--deep-green);
            border-color: var(--deep-green);
        }
        .text-success { color: var(--primary-green) !important; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header text-white text-center">
                <h4 class="fw-bold mb-1">SIM DOSEN</h4>
                <p class="mb-0 opacity-75 small">Universitas Muhammadiyah Bengkulu</p>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger small py-2"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" required placeholder="Masukkan username">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                            <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" required placeholder="Masukkan password">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success shadow-sm">Masuk ke Sistem</button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white text-center py-3 border-top-0">
                <a href="index.php" class="text-decoration-none text-success small fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>
