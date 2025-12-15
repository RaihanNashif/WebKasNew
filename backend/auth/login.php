<?php
session_start();
require "../config/koneksi.php";

$error = "";

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' LIMIT 1");

    if (!$query) {
        die("Query Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);

        // Cek password (plaintext atau md5)
        if ($password === $user['password'] || md5($password) === $user['password']) {
            $_SESSION['id_users'] = $user['id_users'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['role']     = $user['role'];

            // Redirect sesuai role
            header("Location: ../dashboard/" . $user['role'] . ".php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Kas Desa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 350px;">
    <h4 class="mb-3 text-center">LOGIN</h4>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlentities($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
