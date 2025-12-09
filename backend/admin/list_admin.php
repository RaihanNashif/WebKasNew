<?php
include "../middleware/superadmin_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

// Ambil semua admin & superadmin
$query = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE role='admin' OR role='superadmin'
    ORDER BY role DESC, nama ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">Kelola Admin</h3>

    <a href="tambah_admin.php" class="btn btn-primary mb-3">
        + Tambah Admin
    </a>

    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlentities($row['nama']); ?></td>
                <td><?= htmlentities($row['username']); ?></td>
                <td><?= $row['role']; ?></td>
                <td><?= htmlentities($row['no_hp']); ?></td>
                <td>
                    <a href="edit_admin.php?id=<?= $row['id_user']; ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <?php if ($row['role'] == 'admin'): ?>
                        <a href="hapus_admin.php?id=<?= $row['id_user']; ?>" 
                           onclick="return confirm('Yakin ingin menghapus admin ini?')" 
                           class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>

    </table>

</div>

</body>
</html>
