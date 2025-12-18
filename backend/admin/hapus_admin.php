<?php
include "../middleware/superadmin_only.php";
require "../config/koneksi.php";

$id = $_GET['id'];

// Superadmin tidak boleh menghapus sesama superadmin
$data = mysqli_query($conn, "SELECT role FROM users WHERE id_users='$id'");
$cek  = mysqli_fetch_assoc($data);

if ($cek['role'] == 'superadmin') {
    die("Superadmin tidak bisa dihapus.");
}

mysqli_query($conn, "DELETE FROM users WHERE id_users='$id'");

header("Location: list_admin.php");
exit;
?>
