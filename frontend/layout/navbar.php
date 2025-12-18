<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// ganti ini sesuai nama folder project di localhost jika perlu
$PROJECT_ROOT = '/WebKasNew';

$role = $_SESSION['role'] ?? 'guest';
$nama = $_SESSION['nama'] ?? 'Tamu';
?>
<link rel="stylesheet" href="<?=$PROJECT_ROOT?>/frontend/style.css">
<div class="navbar container">
  <div class="left">
    <span class="brand">KasDesa • Sistem</span>

    <!-- Dashboard (link generik; role akan redirect di backend) -->
    <a href="<<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $role = $_SESSION['role'] ?? 'guest';
    $nama = $_SESSION['nama'] ?? 'Tamu';
    $ROOT = '/WebKasNew'; // ubah jika nama folder beda
    ?>
    <link rel="stylesheet" href="<?=$ROOT?>/frontend/style.css">
    <div class="navbar container">
      <div class="nav-left">
        <div class="brand">KasDesa • Sistem</div>
        <a href="<?=$ROOT?>/frontend/index.html">Beranda</a>
        <?php if(in_array($role,['superadmin','admin'])): ?>
          <a href="<?=$ROOT?>/frontend/admin/dashboard.html">Dashboard</a>
          <a href="<?=$ROOT?>/frontend/admin/anggota.html">Anggota</a>
          <a href="<?=$ROOT?>/frontend/admin/pemasukan.html">Pemasukan</a>
          <a href="<?=$ROOT?>/frontend/admin/pengeluaran.html">Pengeluaran</a>
          <a href="<?=$ROOT?>/frontend/admin/status_pembayaran.html">Status</a>
          <a href="<?=$ROOT?>/frontend/superadmin/rekap.html">Rekap</a>
          <a href="<?=$ROOT?>/frontend/anggota/transparansi.html">Transparansi</a>
        <?php else: ?>
          <a href="<?=$ROOT?>/frontend/anggota/dashboard.html">Dashboard</a>
          <a href="<?=$ROOT?>/frontend/anggota/transparansi.html">Transparansi</a>
        <?php endif; ?>
      </div>
    
      <div class="nav-right">
        <span class="small">Halo, <?=htmlentities($nama)?> (<?=htmlentities($role)?>)</span>
        <?php if(isset($_SESSION['id_user'])): ?>
          <a class="btn" style="margin-left:8px" href="<?=$ROOT?>/backend/auth/logout.php">Logout</a>
        <?php else: ?>
          <a class="btn btn-primary" style="margin-left:8px" href="<?=$ROOT?>/frontend/index.html">Login</a>
        <?php endif; ?>
      </div>
    </div>
    ?=$PROJECT_ROOT?>/frontend/superadmin/dashboard.html">Dashboard</a>

    <?php if(in_array($role, ['superadmin','admin'])): ?>
      <a href="<?=$PROJECT_ROOT?>/frontend/admin/anggota.html">Kelola Anggota</a>
      <a href="<?=$PROJECT_ROOT?>/frontend/admin/pemasukan.html">Pemasukan</a>
      <a href="<?=$PROJECT_ROOT?>/frontend/admin/pengeluaran.html">Pengeluaran</a>
      <a href="<?=$PROJECT_ROOT?>/frontend/admin/status_pembayaran.html">Status Pembayaran</a>
      <a href="<?=$PROJECT_ROOT?>/frontend/superadmin/rekap.html">Rekap</a>
      <a href="<?=$PROJECT_ROOT?>/frontend/transparansi/transparansi.html">Transparansi</a>
    <?php else: ?>
      <a href="<?=$PROJECT_ROOT?>/frontend/transparansi/transparansi.html">Transparansi</a>
    <?php endif; ?>
  </div>

  <div class="right">
    <span class="small">Halo, <?= htmlentities($nama) ?> (<?= htmlentities($role) ?>)</span>
    <?php if(isset($_SESSION['id_user'])): ?>
      <a href="<?=$PROJECT_ROOT?>/backend/auth/logout.php" class="btn">Logout</a>
    <?php else: ?>
      <a href="<?=$PROJECT_ROOT?>/frontend/index.html" class="btn btn-primary">Login</a>
    <?php endif; ?>
  </div>
</div>
