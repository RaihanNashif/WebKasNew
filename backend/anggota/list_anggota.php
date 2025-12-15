<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

$query = mysqli_query($conn, "
    SELECT * FROM users
    WHERE role='anggota'
    ORDER BY nama ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container py-4">

    <h3 class="mb-3">Kelola Anggota</h3>

    <a href="tambah_anggota.php" class="btn btn-primary mb-3">+ Tambah Anggota</a>

    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlentities($row['nama']); ?></td>
                <td><?= htmlentities($row['username']); ?></td>
                <td><?= htmlentities($row['alamat']); ?></td>
                <td><?= htmlentities($row['no_hp']); ?></td>
                <td>
                    <a href="edit_anggota.php?id=<?= $row['id_users']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_anggota.php?id=<?= $row['id_users']; ?>"
                       onclick="return confirm('Yakin ingin menghapus anggota ini?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>

    </table>

</div>
</body>
</html>
