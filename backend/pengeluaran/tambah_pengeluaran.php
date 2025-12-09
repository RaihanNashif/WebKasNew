<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $keperluan = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];
    $id_user   = $_SESSION['id_user']; // otomatis yang login

    mysqli_query($conn, "
        INSERT INTO pengeluaran (keperluan, tanggal, jumlah, id_user)
        VALUES ('$keperluan', '$tanggal', '$jumlah', '$id_user')
    ");

    header("Location: list_pengeluaran.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengeluaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-3">Tambah Pengeluaran</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Keperluan</label>
            <input name="keperluan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
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
