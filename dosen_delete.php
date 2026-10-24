<?php
require_once 'config/db.php';
require_once 'includes/auth.php';
checkRole('admin');

$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');

try {
    $stmt = $pdo->prepare("DELETE FROM dosen WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dosen_list.php?success=deleted");
} catch (PDOException $e) {
    die("Gagal menghapus data: " . $e->getMessage());
}
?>
