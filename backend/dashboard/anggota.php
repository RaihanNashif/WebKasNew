<?php 
include "../middleware/anggota_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

$idUser = $_SESSION['id_users'];
?>

<div class="container py-4">

    <h2>Dashboard Anggota</h2>
    <p>Halo <b><?= htmlentities($_SESSION['nama']); ?></b> </p>

    <!-- RINGKASAN -->
    <div class="row">

    <!-- Total Iuran Dibayar -->
    <div class="card">
        <?php
        $q = mysqli_query($conn, "
            SELECT SUM(jumlah) AS total 
            FROM pemasukan 
            WHERE id_users='$idUser'
        ");
        $d = mysqli_fetch_assoc($q);
        ?>
        <h3>Rp <?= number_format($d['total'] ?? 0, 0, ',', '.'); ?></h3>
        <p>Total Iuran Dibayar</p>
    </div>

    <!-- Bulan Lunas -->
    <div class="card">
        <?php
        $q = mysqli_query($conn, "
            SELECT COUNT(DISTINCT DATE_FORMAT(tanggal,'%Y-%m')) AS total 
            FROM pemasukan 
            WHERE id_users='$idUser'
        ");
        $d = mysqli_fetch_assoc($q);
        ?>
        <h3><?= $d['total'] ?></h3>
        <p>Bulan Lunas</p>
    </div>

    <!-- Status Bulan Ini -->
    <div class="card">
        <?php
        $q = mysqli_query($conn, "
            SELECT 1 
            FROM pemasukan 
            WHERE id_users='$idUser'
            AND MONTH(tanggal)=MONTH(CURDATE())
            AND YEAR(tanggal)=YEAR(CURDATE())
            LIMIT 1
        ");
        ?>
        <?php if (mysqli_num_rows($q) > 0): ?>
            <h3 style="color:green;">LUNAS</h3>
        <?php else: ?>
            <h3 style="color:red;">BELUM</h3>
        <?php endif; ?>
        <p>Status Bulan Ini</p>
    </div>

</div>


    <!-- RIWAYAT STATUS PEMBAYARAN -->
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Riwayat Status Pembayaran</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Total Dibayar</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $q = mysqli_query($conn, "
                        SELECT
                            DATE_FORMAT(tanggal,'%M') AS bulan,
                            YEAR(tanggal) AS tahun,
                            SUM(jumlah) AS total,
                            MAX(tanggal) AS tanggal_bayar
                        FROM pemasukan
                        WHERE id_users='$idUser'
                        GROUP BY YEAR(tanggal), MONTH(tanggal)
                        ORDER BY tahun DESC, MONTH(tanggal) DESC
                    ");

                    if (mysqli_num_rows($q) == 0):
                    ?>
                        <tr>
                            <td colspan="5">
                                Belum ada data pembayaran
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php while($row = mysqli_fetch_assoc($q)): ?>
                        <tr class="text-center">
                            <td><?= $row['bulan'] ?></td>
                            <td><?= $row['tahun'] ?></td>
                            <td class="text-success fw-bold">LUNAS</td>
                            <td>Rp <?= number_format($row['total'],0,',','.') ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal_bayar'])) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</main>
</div>
