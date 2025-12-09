<?php
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pemasukan WHERE id='$id'");

header("Location: list_pemasukan.php");
exit;
?>
