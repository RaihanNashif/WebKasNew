<?php 
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
include "../status/generate_status.php";
require "../config/koneksi.php";
?>

<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Halo <?= $_SESSION['nama']; ?>! Berikut ringkasan data:</p>
    <a href="../laporan/laporan_admin.php" class="btn btn-primary">Lihat Laporan</a>


    <div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">

        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='anggota'");
            $d = mysqli_fetch_assoc($q);
            ?>
            <h3><?= $d['total']; ?></h3>
            <p>Jumlah Anggota</p>
        </div>

        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pemasukan");
            $d = mysqli_fetch_assoc($q);
            ?>
            <h3>Rp <?= number_format($d['total'] ?? 0, 0, ',', '.'); ?></h3>
            <p>Total Pemasukan</p>
        </div>

        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pengeluaran");
            $d = mysqli_fetch_assoc($q);
            ?>
            <h3>Rp <?= number_format($d['total'] ?? 0, 0, ',', '.'); ?></h3>
            <p>Total Pengeluaran</p>
        </div>

    </div>
</div>

</main>
</div>