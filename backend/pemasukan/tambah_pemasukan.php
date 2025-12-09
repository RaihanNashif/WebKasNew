<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
    $tanggal = $_POST['tanggal'];
    $sumber  = mysqli_real_escape_string($conn, $_POST['sumber']);
    $jumlah  = $_POST['jumlah'];

    mysqli_query($conn, "
        INSERT INTO pemasukan (id_user, tanggal, sumber, jumlah)
        VALUES ('$id_user', '$tanggal', '$sumber', '$jumlah')
    ");

    header("Location: list_pemasukan.php");
    exit;
}

$anggota = mysqli_query($conn, "SELECT id_user, nama FROM users WHERE role='anggota' ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemasukan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">Tambah Pemasukan</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <select name="id_user" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while ($row = mysqli_fetch_assoc($anggota)): ?>
                    <option value="<?= $row['id_user']; ?>">
                        <?= htmlentities($row['nama']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sumber</label>
            <input name="sumber" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <button class="btn btn-primary" name="simpan">Simpan</button>

    </form>

</div>

</body>
</html>
