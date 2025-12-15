<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit;
}

$role = $_SESSION['role'];
$nama = $_SESSION['nama'];
?>

<!-- ICON -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- CSS -->
<link rel="stylesheet" href="../assets/style.css">

<div class="layout">

<?php
$current_page = basename($_SERVER['PHP_SELF']); // nama file sekarang, misal "rekap.php"
?>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-header">
        <i class="bi bi-wallet2"></i> Kas RT
    </div>

    <div class="user">
        <i class="bi bi-person-circle"></i><br>
        <b><?= htmlentities($nama); ?></b><br>
        <small><?= $role ?></small>
    </div>

    <!-- MENU UMUM -->
    <a href="../dashboard/<?= $role ?>.php" class="<?= $current_page == $role.'.php' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <!-- SUPERADMIN -->
    <?php if ($role == 'superadmin'): ?>
        <a href="../admin/list_admin.php" class="<?= $current_page == 'list_admin.php' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i> Kelola Admin
        </a>
        <a href="../anggota/list_anggota.php" class="<?= $current_page == 'list_anggota.php' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Kelola Anggota
        </a>
        <a href="../pemasukan/list_pemasukan.php" class="<?= $current_page == 'list_pemasukan.php' ? 'active' : '' ?>">
            <i class="bi bi-cash-stack"></i> Pemasukan
        </a>
        <a href="../pengeluaran/list_pengeluaran.php" class="<?= $current_page == 'list_pengeluaran.php' ? 'active' : '' ?>">
            <i class="bi bi-wallet"></i> Pengeluaran
        </a>
        <a href="../status/list_status.php" class="<?= $current_page == 'list_status.php' ? 'active' : '' ?>">
            <i class="bi bi-check2-circle"></i> Status Pembayaran
        </a>
        <a href="../rekap/rekap.php" class="<?= $current_page == 'rekap.php' ? 'active' : '' ?>">
            <i class="bi bi-bar-chart"></i> Rekap Pembayaran
        </a>
        <!-- LAPORAN KEUANGAN -->
        <?php if(in_array($role, ['superadmin','admin'])): ?>
        <a href="../laporan/laporan_admin.php" class="<?= strpos($current_page, 'laporan_admin.php') !== false ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Laporan Keuangan
        </a>
    <?php endif; ?>

    <?php endif; ?>

    <!-- ADMIN -->
    <?php if ($role == 'admin'): ?>
        <a href="../anggota/list_anggota.php" class="<?= $current_page == 'list_anggota.php' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Kelola Anggota
        </a>
        <a href="../pemasukan/list_pemasukan.php" class="<?= $current_page == 'list_pemasukan.php' ? 'active' : '' ?>">
            <i class="bi bi-cash-stack"></i> Pemasukan
        </a>
        <a href="../pengeluaran/list_pengeluaran.php" class="<?= $current_page == 'list_pengeluaran.php' ? 'active' : '' ?>">
            <i class="bi bi-wallet"></i> Pengeluaran
        </a>
        <a href="../status/list_status.php" class="<?= $current_page == 'list_status.php' ? 'active' : '' ?>">
            <i class="bi bi-check2-circle"></i> Status Pembayaran
        </a>
        <a href="../rekap/rekap.php" class="<?= $current_page == 'rekap.php' ? 'active' : '' ?>">
            <i class="bi bi-bar-chart"></i> Rekap Pembayaran
        </a>
        <!-- LAPORAN KEUANGAN -->
        <?php if(in_array($role, ['superadmin','admin'])): ?>
        <a href="../laporan/laporan_admin.php" class="<?= strpos($current_page, 'laporan_admin.php') !== false ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Laporan Keuangan
        </a>
    <?php endif; ?>

    <?php endif; ?>

    <!-- ANGGOTA -->
    <?php if ($role == 'anggota'): ?>
        <a href="../status/status_anggota.php" class="<?= $current_page == 'status_anggota.php' ? 'active' : '' ?>">
            <i class="bi bi-credit-card"></i> Status Pembayaran
        </a>
        <a href="../transparansi/transparansi.php" class="<?= $current_page == 'transparansi.php' ? 'active' : '' ?>">
            <i class="bi bi-eye"></i> Transparansi Dana
        </a>
    <?php endif; ?>

    <div class="logout">
        <a href="../auth/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</aside>

<!-- CONTENT OPEN -->
<main class="content">
