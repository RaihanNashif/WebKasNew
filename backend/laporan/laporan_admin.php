<?php
session_start();
include "../partials/navbar.php";
require "../config/koneksi.php";

// Cek login dan role
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','superadmin'])) {
    header("HTTP/1.1 403 Forbidden");
    echo "Akses ditolak!";
    exit;
}

// Laporan = Hasil Hitung
$query = mysqli_query($conn, "
    SELECT 
        periode,
        SUM(total_pemasukan) AS total_pemasukan,
        SUM(total_pengeluaran) AS total_pengeluaran,
        (SUM(total_pemasukan) - SUM(total_pengeluaran)) AS saldo_akhir
    FROM (
        SELECT 
            DATE_FORMAT(tanggal, '%Y-%m') AS periode,
            SUM(jumlah) AS total_pemasukan,
            0 AS total_pengeluaran
        FROM pemasukan
        GROUP BY periode

        UNION ALL

        SELECT 
            DATE_FORMAT(tanggal, '%Y-%m') AS periode,
            0 AS total_pemasukan,
            SUM(jumlah) AS total_pengeluaran
        FROM pengeluaran
        GROUP BY periode
    ) t
    GROUP BY periode
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
<title>Laporan Keuangan - Admin</title>
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

                        <?php
                            $saldo = $row['total_pemasukan'] - $row['total_pengeluaran'];
                        ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td>Rp <?= number_format($row['total_pemasukan'],0,',','.') ?></td>
                            <td>Rp <?= number_format($row['total_pengeluaran'],0,',','.') ?></td>
                            <td class="fw-semibold">
                                Rp <?= number_format($saldo, 0, ',', '.') ?>
                            </td>
                            <td><?= htmlentities($row['periode']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <a href="laporan_pdf.php" class="btn btn-primary">
            Unduh Laporan (PDF)
        </a>
        </div>
    </div>

</div>

</body>

</html>
