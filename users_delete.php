<?php
require_once 'config/db.php';
require_once 'includes/auth.php';
checkRole('admin');

$id = $_GET['id'] ?? die('ID missing');
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND username != 'admin'");
$stmt->execute([$id]);
header("Location: users_list.php");
exit();
?>
