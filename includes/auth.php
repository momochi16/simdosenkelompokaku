<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function checkLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function checkRole($allowed_roles) {
    checkLogin();
    if (!in_array($_SESSION['role'], (array)$allowed_roles)) {
        header("Location: dashboard.php?error=unauthorized");
        exit();
    }
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isPimpinan() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'pimpinan';
}
?>
