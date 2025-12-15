<?php
include "../middleware/superadmin_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id_users='$id'");
$user = mysqli_fetch_assoc($data);

if (!$user) {
    die("Admin tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $no_hp    = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

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
        role='$role',
        no_hp='$no_hp'
        $passQuery
        WHERE id_user='$id'
    ");

    header("Location: list_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container py-4">

    <h3 class="mb-3">Edit Admin</h3>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input name="nama" class="form-control" value="<?= $user['nama']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" value="<?= $user['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input name="password" type="password" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input name="no_hp" class="form-control" value="<?= $user['no_hp']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="admin"      <?= ($user['role']=='admin') ? 'selected':''; ?>>Admin</option>
                <option value="superadmin" <?= ($user['role']=='superadmin') ? 'selected':''; ?>>Superadmin</option>
            </select>
        </div>

        <button class="btn btn-primary" name="update">Update</button>

    </form>

</div>

</body>
</html>
