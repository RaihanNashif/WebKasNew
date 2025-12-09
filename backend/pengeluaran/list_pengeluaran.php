<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

// Ambil semua data pengeluaran + nama user input
$query = mysqli_query($conn, "
    SELECT p.*, u.nama 
    FROM pengeluaran p
    LEFT JOIN users u ON p.id_user = u.id_user
    ORDER BY p.tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pengeluaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container py-4">

    <h3 class="mb-3">Data Pengeluaran</h3>

    <a href="tambah_pengeluaran.php" class="btn btn-primary mb-3">
        + Tambah Pengeluaran
    </a>

    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Keperluan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Diinput Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlentities($row['keperluan']); ?></td>
                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= htmlentities($row['nama']); ?></td>
                <td>
                    <a href="edit_pengeluaran.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_pengeluaran.php?id=<?= $row['id']; ?>"
                       onclick="return confirm('Yakin ingin menghapus data ini?')"
                       class="btn btn-danger btn-sm">
                       Hapus
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>

    </table>

</div>

</body>
</html>
