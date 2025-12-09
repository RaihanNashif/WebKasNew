<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit;
}

$role = $_SESSION['role'];
?>

<link rel="stylesheet" href="../assets/style.css">

<style>
    .navbar {
        background: #f0f0f0;
        padding: 12px;
        margin-bottom: 20px;
        border-bottom: 2px solid #ddd;
    }
    .navbar a {
        margin-right: 15px;
        text-decoration: none;
        font-weight: bold;
        color: #333;
    }
</style>

<div class="navbar">
    <span>Halo, <strong><?= htmlentities($_SESSION['nama']); ?></strong> (<?= $role ?>)</span> |

    <!-- Menu umum -->
    <a href="../dashboard/<?= $role ?>.php">Dashboard</a>

    <!-- Superadmin -->
    <?php if ($role == 'superadmin'): ?>
        <a href="../admin/list_admin.php">Kelola Admin</a>
        <a href="../anggota/list_anggota.php">Kelola Anggota</a>
        <a href="../pemasukan/list_pemasukan.php">Pemasukan</a>
        <a href="../pengeluaran/list_pengeluaran.php">Pengeluaran</a>
        <a href="../status/list_status.php">Status Pembayaran</a>
        <a href="../rekap/rekap.php">Rekap Pembayaran</a>
    <?php endif; ?>

    <!-- Admin -->
    <?php if ($role == 'admin'): ?>
        <a href="../anggota/list_anggota.php">Kelola Anggota</a>
        <a href="../pemasukan/list_pemasukan.php">Pemasukan</a>
        <a href="../pengeluaran/list_pengeluaran.php">Pengeluaran</a>
        <a href="../status/list_status.php">Status Pembayaran</a>
        <a href="../rekap/rekap.php">Rekap Pembayaran</a>
    <?php endif; ?>

    <!-- Anggota -->
    <?php if ($role == 'anggota'): ?>
        <a href="../status/status_anggota.php">Status Pembayaran</a>
        <a href="../transparansi/transparansi.php">Transparansi Dana</a>
    <?php endif; ?>

    <a href="../auth/logout.php" style="color:red;">Logout</a>
</div>
