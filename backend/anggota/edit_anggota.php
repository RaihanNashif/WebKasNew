<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM users WHERE id_users='$id'");
$anggota = mysqli_fetch_assoc($data);

if (!$anggota) {
    die("Data anggota tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $alamat   = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp    = mysqli_real_escape_string($conn, $_POST['no_hp']);

    // Password opsional
    if ($_POST['password'] != "") {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $passQuery = ", password='$password'";
    } else {
        $passQuery = "";
    }

    mysqli_query($conn, "
        UPDATE users SET 
        nama='$nama',
        username='$username',
        alamat='$alamat',
        no_hp='$no_hp'
        $passQuery
        WHERE id_users='$id'
    ");

    header("Location: list_anggota.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">Edit Anggota</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input name="nama" class="form-control" value="<?= $anggota['nama']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" value="<?= $anggota['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input name="password" type="password" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"><?= $anggota['alamat']; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control" value="<?= $anggota['no_hp']; ?>">
        </div>

        <button class="btn btn-primary" name="update">Update</button>

    </form>

</div>

</body>
</html>
