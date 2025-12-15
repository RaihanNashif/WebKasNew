<?php
require "../config/koneksi.php";
require "../dompdf/vendor/autoload.php";

use Dompdf\Dompdf;

if (!isset($_GET['bulan']) || !isset($_GET['tahun'])) {
    die("Parameter bulan dan tahun harus dipilih.");
}

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

// Ambil semua anggota
$dataAnggota = mysqli_query($conn, "
    SELECT id_users, nama 
    FROM users 
    WHERE role='anggota'
    ORDER BY nama ASC
") or die("Query anggota gagal: " . mysqli_error($conn));

// Mulai HTML untuk PDF
$html = "
<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial, sans-serif; }
    h2, h3 { text-align: center; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .lunas { color: green; font-weight: bold; }
    .belum { color: red; font-weight: bold; }
</style>
</head>
<body>
<h2>REKAP PEMBAYARAN IURAN</h2>
<h3>Bulan: $bulan $tahun</h3>

<table>
    <tr>
        <th>Nama Anggota</th>
        <th>Status</th>
        <th>Jumlah</th>
        <th>Tanggal Bayar</th>
    </tr>
";

while ($a = mysqli_fetch_assoc($dataAnggota)) {

    $cek = mysqli_query($conn, "
        SELECT status, jumlah, tanggal_bayar 
        FROM status_pembayaran 
        WHERE id_users='{$a['id_users']}'
        AND bulan='$bulan'
        AND tahun='$tahun'
        LIMIT 1
    ") or die("Query status gagal: " . mysqli_error($conn));

    if(mysqli_num_rows($cek) > 0){
        $row = mysqli_fetch_assoc($cek);
        $status = ($row['status'] === 'lunas') 
            ? "<span class='lunas'>LUNAS</span>"
            : "<span class='belum'>BELUM</span>";
        $jumlah = "Rp " . number_format($row['jumlah'], 0, ',', '.');
        $tanggal = $row['tanggal_bayar'];
    } else {
        $status = "<span class='belum'>BELUM</span>";
        $jumlah = "Rp 0";
        $tanggal = "-";
    }

    $html .= "
    <tr>
        <td>{$a['nama']}</td>
        <td>$status</td>
        <td>$jumlah</td>
        <td>$tanggal</td>
    </tr>";
}

$html .= "
</table>
</body>
</html>
";

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Download PDF
$dompdf->stream("rekap_$bulan_$tahun.pdf", ["Attachment" => true]);
exit;
?>
