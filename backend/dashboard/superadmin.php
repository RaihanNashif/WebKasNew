<?php 
include "../middleware/superadmin_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<div class="container">
    <h2>Dashboard Superadmin</h2>
    <p>Selamat datang, <?= $_SESSION['nama']; ?>! Berikut ringkasan data:</p>

    <div style="display:flex; gap:20px; flex-wrap:wrap; margin-top:20px;">

        <!-- TOTAL ANGGOTA -->
        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='anggota'");
            $d = mysqli_fetch_assoc($q);
            ?>
            <h3><?= $d['total']; ?></h3>
            <p>Jumlah Anggota</p>
        </div>

        <!-- TOTAL ADMIN -->
        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='admin'");
            $d = mysqli_fetch_assoc($q);
            ?>
            <h3><?= $d['total']; ?></h3>
            <p>Jumlah Admin</p>
        </div>

        <!-- TOTAL PEMASUKAN -->
        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pemasukan");
            $d = mysqli_fetch_assoc($q);
            $total = $d['total'] ?? 0;
            ?>
            <h3>Rp <?= number_format($total, 0, ',', '.'); ?></h3>
            <p>Total Pemasukan</p>
        </div>

        <!-- TOTAL PENGELUARAN -->
        <div class="card-box">
            <?php
            $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pengeluaran");
            $d = mysqli_fetch_assoc($q);
            $total = $d['total'] ?? 0;
            ?>
            <h3>Rp <?= number_format($total, 0, ',', '.'); ?></h3>
            <p>Total Pengeluaran</p>
        </div>

    </div>
</div>

<style>
.card-box {
    background:white;
    padding:20px;
    border-radius:8px;
    width:200px;
    text-align:center;
    box-shadow:0 2px 4px rgba(0,0,0,.1);
}
.card-box h3 {
    margin-bottom:10px;
}
</style>
