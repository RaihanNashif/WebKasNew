<?php
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM pengeluaran WHERE id_pengeluaran='$id'");

if (!$delete) {
    die("SQL Error: " . mysqli_error($conn));
} else {
    echo "Data pengeluaran berhasil dihapus!";
}

header("Location: list_pengeluaran.php");
exit;
?>
