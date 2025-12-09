<?php 
include "../middleware/admin_superadmin.php";
require "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: list_status.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM status_pembayaran WHERE id_status = $id");

header("Location: list_status.php");
exit;
