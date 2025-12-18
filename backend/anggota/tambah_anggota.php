<?php
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $alamat   = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp    = mysqli_real_escape_string($conn, $_POST['no_hp']);

    mysqli_query($conn, "
        INSERT INTO users (nama, username, password, role, alamat, no_hp)
        VALUES ('$nama', '$username', '$password', 'anggota', '$alamat', '$no_hp')
    ");

    header("Location: list_anggota.php");
    exit;
}
?>

<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">Tambah Anggota</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control">
        </div>

        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-primary" name="simpan">Simpan</button>
            <a href="list_anggota.php" class="btn btn-link">Kembali</a>
        </div>



    </form>
</div>

</body>
</html>
