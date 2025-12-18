<?php
session_start();
require "../config/koneksi.php";
include "../partials/navbar.php";
?>

<div class="container py-5">
    <h2 class="mb-4">Transparansi Kas</h2>

    <h4 class="mt-4">Pemasukan</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Sumber</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Diinput Oleh</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT p.*, u.nama AS anggota, a.nama AS input_admin
                FROM pemasukan p
                LEFT JOIN users u ON p.id_users = u.id_users
                LEFT JOIN users a ON p.input_by = a.id_users
                ORDER BY p.tanggal DESC
            ");
            $no = 1;
            while ($r = mysqli_fetch_assoc($q)):
            ?>
                <tr class="text-center">
                    <td><?= $no++; ?></td>
                    <td><?= htmlentities($r['anggota']) ?></td>
                    <td><?= htmlentities($r['sumber']) ?></td>
                    <td><?= htmlentities($r['keterangan']) ?></td>
                    <td>Rp <?= number_format($r['jumlah'], 0, ',', '.') ?></td>
                    <td><?= $r['tanggal'] ?></td>
                    <td><?= htmlentities($r['input_admin']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h4 class="mt-5">Pengeluaran</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Keperluan</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Diinput Oleh</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q2 = mysqli_query($conn, "
                SELECT p.*, u.nama AS anggota, a.nama AS input_admin
                FROM pengeluaran p
                LEFT JOIN users u ON p.id_users = u.id_users
                LEFT JOIN users a ON p.input_by = a.id_users
                ORDER BY p.tanggal DESC
            ");
            $no2 = 1;
            while ($r2 = mysqli_fetch_assoc($q2)):
            ?>
                <tr class="text-center">
                    <td><?= $no2++; ?></td>
                    <td><?= htmlentities($r2['anggota']) ?></td>
                    <td><?= htmlentities($r2['keperluan']) ?></td>
                    <td><?= htmlentities($r2['keterangan']) ?></td>
                    <td>Rp <?= number_format($r2['jumlah'], 0, ',', '.') ?></td>
                    <td><?= $r2['tanggal'] ?></td>
                    <td><?= htmlentities($r2['input_admin']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
