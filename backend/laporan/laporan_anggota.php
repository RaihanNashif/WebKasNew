<?php
session_start();
include "../partials/navbar.php";
require "../config/koneksi.php";

// Cek login anggota
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota') {
    header("HTTP/1.1 403 Forbidden");
    echo "Akses ditolak!";
    exit;
}

// Ambil laporan milik anggota
$id_users = $_SESSION['id_users'];
$query = mysqli_query($conn, "
    SELECT * 
    FROM laporan 
    WHERE id_users = '$id_users'
    ORDER BY periode DESC
");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Keuangan - Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="text-center text-primary fw-bold mb-4">
        Laporan Keuangan Kas RT
    </h2>

    <div class="card shadow-sm rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Total Pemasukan</th>
                            <th>Total Pengeluaran</th>
                            <th>Saldo Akhir</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td>Rp <?= number_format($row['total_pemasukan'],0,',','.') ?></td>
                            <td>Rp <?= number_format($row['total_pengeluaran'],0,',','.') ?></td>
                            <td class="fw-semibold">
                                Rp <?= number_format($row['saldo_akhir'],0,',','.') ?>
                            </td>
                            <td><?= htmlentities($row['periode']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>

</html>
