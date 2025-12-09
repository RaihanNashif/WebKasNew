<?php
session_start();

if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'superadmin')) {
    header("HTTP/1.1 403 Forbidden");
    echo "Akses ditolak! Halaman ini hanya untuk Admin & Superadmin.";
    exit;
}
?>
