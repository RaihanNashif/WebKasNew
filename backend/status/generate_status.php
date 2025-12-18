<?php
require "../config/koneksi.php";

$bulan = $_GET['bulan'] ?? null;
$tahun = $_GET['tahun'] ?? null;

if (!$bulan || !$tahun) {
    die("Bulan dan tahun wajib dipilih.");
}

$jumlah_iuran = 50000;

// Pastikan semua anggota ada
$anggota = mysqli_query($conn, "SELECT id_users FROM users WHERE role='anggota'");

while ($row = mysqli_fetch_assoc($anggota)) {
    $id_user = $row['id_users'];

    $cek = mysqli_query($conn, "
        SELECT 1 FROM status_pembayaran
        WHERE id_users='$id_user'
        AND bulan='$bulan'
        AND tahun='$tahun'
    ");

    if (mysqli_num_rows($cek) == 0) {
        mysqli_query($conn, "
            INSERT INTO status_pembayaran
            (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
            VALUES
            ('$id_user','$bulan','$tahun','$jumlah_iuran','Belum Lunas',NULL)
        ");
    }
}


header("Location: list_status.php?bulan=$bulan&tahun=$tahun");
exit;
