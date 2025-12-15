<?php
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id_users='$id' AND role='anggota'");

header("Location: list_anggota.php");
exit;
?>
