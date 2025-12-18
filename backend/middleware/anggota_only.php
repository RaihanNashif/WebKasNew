<?php
session_start();

if (
    !isset($_SESSION['id_users']) ||
    !isset($_SESSION['role']) || 
    $_SESSION['role'] != 'anggota'
) {
    header("Location: ../auth/login.php");
    echo "Akses ditolak! Halaman ini hanya untuk Anggota.";
    exit;
}
?>