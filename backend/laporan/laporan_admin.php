<?php
session_start();
require "../config/koneksi.php";

// Cek login dan role
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','superadmin'])) {
    header("HTTP/1.1 403 Forbidden");
    echo "Akses ditolak!";
    exit;
}

// Ambil data laporan semua user
$query = mysqli_query($conn, "
    SELECT l.*, u.nama 
    FROM laporan l
    LEFT JOIN users u ON l.id_users = u.id_users
    ORDER BY l.periode DESC
");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Keuangan - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-3">Laporan Keuangan Semua User</h3>
    <table class="table table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Diinput Oleh</th>
                <th>Total Pemasukan</th>
                <th>Total Pengeluaran</th>
                <th>Saldo Akhir</th>
                <th>Periode</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlentities($row['nama']) ?></td>
                <td>Rp <?= number_format($row['total_pemasukan'],0,',','.') ?></td>
                <td>Rp <?= number_format($row['total_pengeluaran'],0,',','.') ?></td>
                <td>Rp <?= number_format($row['saldo_akhir'],0,',','.') ?></td>
                <td><?= htmlentities($row['periode']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
