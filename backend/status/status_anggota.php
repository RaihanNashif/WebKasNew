<?php 
require "../config/koneksi.php";

include "../middleware/anggota_only.php";
include "../partials/navbar.php";

// Ambil ID user dari session
$id_user = $_SESSION['id_users'];

// Query ambil status pembayaran
$cek = mysqli_query($conn, "
    SELECT bulan, tahun, jumlah, status, tanggal_bayar 
    FROM status_pembayaran
    WHERE id_users = '$id_user'
    ORDER BY
        tahun DESC,
        FIELD(bulan,
            'Januari','Februari','Maret','April','Mei','Juni','Juli',
            'Agustus','September','Oktober','November','Desember'
        )
");


// Jika query gagal
if (!$cek) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<h2>Status Pembayaran Saya</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Status</th>
        <th>Jumlah</th>
        <th>Tanggal Bayar</th>
    </tr>

    <?php while ($d = mysqli_fetch_assoc($cek)) { ?>
        <tr>
            <td><?= $d['bulan'] ?></td>
            <td><?= $d['tahun'] ?></td>
            <td><?= $d['status'] ?></td>
            <td><?= number_format($d['jumlah'], 0, ',', '.') ?></td>
            <td><?= $d['tanggal_bayar'] ?></td>
        </tr>
    <?php } ?>
</table>
