<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

// Ambil semua data pengeluaran + nama anggota + nama admin input
$query = mysqli_query($conn, "
    SELECT p.*, 
           u.nama AS anggota_nama,
           a.nama AS admin_input
    FROM pengeluaran p
    LEFT JOIN users u ON p.id_users = u.id_users
    LEFT JOIN users a ON p.input_by = a.id_users
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
            <th>Anggota</th>
            <th>Keperluan</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Diinput Oleh</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        <?php $no = 1; while($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlentities($row['anggota_nama']); ?></td>
                <td><?= htmlentities($row['keperluan']); ?></td>
                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                <td><?= htmlentities($row['keterangan']); ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= htmlentities($row['admin_input']); ?></td>
                <td>
                    <a href="edit_pengeluaran.php?id=<?= $row['id_pengeluaran']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_pengeluaran.php?id=<?= $row['id_pengeluaran']; ?>"
                       onclick="return confirm('Yakin ingin menghapus data ini?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>
