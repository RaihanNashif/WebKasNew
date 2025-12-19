<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Halo <?= htmlentities($_SESSION['nama']); ?>! Berikut ringkasan data:</p>

    <div class="row">

        <!-- Jumlah Anggota -->
        <div class="card">
            <div class="card shadow-sm text-center p-3">
                <?php
                $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='anggota'");
                $d = mysqli_fetch_assoc($q);
                ?>
                <h3><?= $d['total']; ?></h3>
                <p class="mb-0">Jumlah Anggota</p>
            </div>
        </div>

        <!-- Total Pemasukan -->
        <div class="card">
            <div class="card shadow-sm text-center p-3">
                <?php
                $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pemasukan");
                $d = mysqli_fetch_assoc($q);
                ?>
                <h3>Rp <?= number_format($d['total'] ?? 0, 0, ',', '.'); ?></h3>
                <p class="mb-0">Total Pemasukan</p>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="card">
            <div class="card shadow-sm text-center p-3">
                <?php
                $q = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pengeluaran");
                $d = mysqli_fetch_assoc($q);
                ?>
                <h3>Rp <?= number_format($d['total'] ?? 0, 0, ',', '.'); ?></h3>
                <p class="mb-0">Total Pengeluaran</p>
            </div>
        </div>

    </div>
</div>

</main>
</div>
