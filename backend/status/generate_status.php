<?php 
require "../config/koneksi.php";

// Mapping bulan Inggris → Indonesia
$bulan_indonesia = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
];

// Ambil bulan & tahun sekarang (Indonesia)
$bulan = $bulan_indonesia[date('F')];
$tahun = date('Y');

// Jumlah iuran per bulan
$jumlah_iuran = 50000;

// Ambil semua anggota
$anggota = mysqli_query($conn, "SELECT id_users FROM users WHERE role='anggota'");

// Loop cek setiap anggota
while($row = mysqli_fetch_assoc($anggota)) {
    $id_user = $row['id_users'];

    // Cek apakah status bulan ini sudah ada
    $cek = mysqli_query($conn, "
        SELECT id_status 
        FROM status_pembayaran
        WHERE id_users='$id_user' AND bulan='$bulan' AND tahun='$tahun'
    ");

    // Jika belum ada → buat status Belum Lunas
    if(mysqli_num_rows($cek) == 0){
        mysqli_query($conn, "
            INSERT INTO status_pembayaran (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
            VALUES ('$id_user', '$bulan', '$tahun', '$jumlah_iuran', 'Belum Lunas', NULL)
        ");
    }
}

echo "Generate status pembayaran untuk $bulan $tahun selesai!";
?>
