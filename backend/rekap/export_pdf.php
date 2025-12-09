<?php
require "../config/koneksi.php";
require "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

if (!isset($_GET['bulan']) || !isset($_GET['tahun'])) {
    die("Parameter tidak lengkap");
}

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

$dataAnggota = mysqli_query($conn, "
    SELECT id_user, nama 
    FROM users 
    WHERE role='anggota'
    ORDER BY nama ASC
");

$html = "
<h2 style='text-align:center;'>REKAP PEMBAYARAN IURAN</h2>
<h3 style='text-align:center;'>Bulan: $bulan $tahun</h3>
<br>

<table border='1' cellpadding='10' cellspacing='0' width='100%'>
    <tr>
        <th>Nama Anggota</th>
        <th>Status</th>
    </tr>
";

while ($a = mysqli_fetch_assoc($dataAnggota)) {

    $cek = mysqli_query($conn, "
        SELECT 1 FROM status_pembayaran 
        WHERE id_user='{$a['id_user']}'
        AND bulan='$bulan'
        AND tahun='$tahun'
        LIMIT 1
    ");

    $status = (mysqli_num_rows($cek) > 0)
        ? "<b style='color:green;'>LUNAS</b>"
        : "<b style='color:red;'>BELUM</b>";

    $html .= "
    <tr>
        <td>{$a['nama']}</td>
        <td>$status</td>
    </tr>";
}

$html .= "</table>";

// DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("rekap_$bulan_$tahun.pdf");
