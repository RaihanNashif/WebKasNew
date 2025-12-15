<?php
include "../middleware/superadmin_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<div class="container">
    <h2>Dashboard Superadmin</h2>

    <div class="row">
        <div class="card">
            <?php $q=mysqli_query($conn,"SELECT COUNT(*) t FROM users WHERE role='anggota'");
            $d=mysqli_fetch_assoc($q); ?>
            <h3><?= $d['t'] ?></h3>
            <p>Jumlah Anggota</p>
        </div>

        <div class="card">
            <?php $q=mysqli_query($conn,"SELECT SUM(jumlah) t FROM pemasukan");
            $d=mysqli_fetch_assoc($q); ?>
            <h3>Rp <?= number_format($d['t'] ?? 0,0,',','.') ?></h3>
            <p>Total Pemasukan</p>
        </div>

        <div class="card">
            <?php $q=mysqli_query($conn,"SELECT SUM(jumlah) t FROM pengeluaran");
            $d=mysqli_fetch_assoc($q); ?>
            <h3>Rp <?= number_format($d['t'] ?? 0,0,',','.') ?></h3>
            <p>Total Pengeluaran</p>
        </div>
    </div>
</div>

</main>
</div>
    