<?php
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pengeluaran WHERE id='$id'");

header("Location: list_pengeluaran.php");
exit;
?>
