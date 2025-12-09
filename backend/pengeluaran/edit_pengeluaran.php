<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

// Ambil ID
$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data pengeluaran tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $keperluan = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];

    mysqli_query($conn, "
        UPDATE pengeluaran SET
            keperluan='$keperluan',
            tanggal='$tanggal',
            jumlah='$jumlah'
        WHERE id='$id'
    ");

    header("Location: list_pengeluaran.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pengeluaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container py-4">

    <h3 class="mb-3">Edit Pengeluaran</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Keperluan</label>
            <input name="keperluan" class="form-control" 
                   value="<?= htmlentities($row['keperluan']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="<?= $row['tanggal']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control"
                   value="<?= $row['jumlah']; ?>" required>
        </div>

        <button class="btn btn-primary" name="update">Update</button>

    </form>

</div>
</body>
</html>
