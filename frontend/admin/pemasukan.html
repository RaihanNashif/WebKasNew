<?php
session_start();
require "../config/koneksi.php";
include "../partials/navbar.php";
?>

<div class="container py-5">
    <h2 class="mb-4">Data Pemasukan</h2>

    <div class="mb-3">
        <a href="tambah_pemasukan.php" class="btn btn-primary">+ Tambah Pemasukan</a>
    </div>

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
                    <th>Aksi</th>
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
                    <td>
                        <a href="edit_pemasukan.php?id=<?= $r['id_pemasukan'] ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                        <a href="../../backend/pemasukan/index.php?action=delete&id=<?= $r['id_pemasukan'] ?>" 
                           onclick="return confirm('Hapus pemasukan ini?')" 
                           class="btn btn-sm btn-danger mb-1">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
