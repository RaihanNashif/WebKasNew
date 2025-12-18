<?php
session_start();
require "../config/koneksi.php";
require "../dompdf/autoload.inc.php";

use Dompdf\Dompdf;

// Proteksi role
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','superadmin'])) {
    die("Akses ditolak");
}

// Ambil data laporan
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



// HTML untuk PDF
$html = '
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #000; padding:6px; }
    th { background:#eee; }
</style>

<h2>Laporan Keuangan Kas RT</h2>

<table>
<tr>
    <th>No</th>
    <th>Pemasukan</th>
    <th>Pengeluaran</th>
    <th>Saldo</th>
    <th>Periode</th>
</tr>';

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $html .= '
    <tr>
        <td>'.$no++.'</td>
        <td>Rp '.number_format($row['total_pemasukan'],0,',','.').'</td>
        <td>Rp '.number_format($row['total_pengeluaran'],0,',','.').'</td>
        <td>Rp '.number_format($row['saldo_akhir'],0,',','.').'</td>
        <td>'.$row['periode'].'</td>
    </tr>';
}


$html .= '</table>';

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("laporan_keuangan.pdf", ["Attachment" => true]);
exit;
