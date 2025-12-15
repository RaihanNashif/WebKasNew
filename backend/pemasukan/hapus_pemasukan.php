<?php
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

$id = $_GET['id'];

$delete = mysqli_query($conn, "
    DELETE FROM pemasukan WHERE id_pemasukan='$id'
");

if (!$delete) {
    die("SQL Error: " . mysqli_error($conn));
} else {
    echo "Data pemasukan berhasil dihapus!";
}

header("Location: list_pemasukan.php");
exit;
?>
