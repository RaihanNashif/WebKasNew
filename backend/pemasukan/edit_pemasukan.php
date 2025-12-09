<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "
    SELECT * FROM pemasukan WHERE id='$id'
");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data tidak ditemukan.");
}

$anggota = mysqli_query($conn, "
    SELECT id_user, nama FROM users WHERE role='anggota'
");
if (isset($_POST['update'])) {

    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
    $tanggal = $_POST['tanggal'];
    $sumber  = mysqli_real_escape_string($conn, $_POST['sumber']);
    $jumlah  = $_POST['jumlah'];

    mysqli_query($conn, "
        UPDATE pemasukan SET
            id_user='$id_user',
            tanggal='$tanggal',
            sumber='$sumber',
            jumlah='$jumlah'
        WHERE id='$id'
    ");

    header("Location: list_pemasukan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pemasukan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="container py-4">

    <h3 class="mb-3">Edit Pemasukan</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <!-- Anggota -->
        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <select name="id_user" class="form-select">
                <?php while ($u = mysqli_fetch_assoc($anggota)): ?>
                    <option value="<?= $u['id_user']; ?>"
                        <?= ($u['id_user'] == $row['id_user']) ? 'selected' : ''; ?>>
                        <?= htmlentities($u['nama']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Tanggal -->
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="<?= $row['tanggal']; ?>" required>
        </div>

        <!-- Sumber -->
        <div class="mb-3">
            <label class="form-label">Sumber</label>
            <input name="sumber" class="form-control"
                   value="<?= htmlentities($row['sumber']); ?>" required>
        </div>

        <!-- Jumlah -->
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
