<?php
include "../middleware/superadmin_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $no_hp    = mysqli_real_escape_string($conn, $_POST['no_hp']);

    mysqli_query($conn, "
        INSERT INTO users (nama, username, password, role, no_hp)
        VALUES ('$nama', '$username', '$password', 'admin', '$no_hp')
    ");

    header("Location: list_admin.php");
    exit;
}
?>

<div class="container py-4">
    <h3 class="mb-3">Tambah Admin</h3>

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
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control">
        </div>

        <button class="btn btn-primary" name="simpan">Simpan</button>
        <a href="list_admin.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

</main>
</div>
