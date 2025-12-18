<?php 
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<h2>Rekap Pembayaran Iuran</h2>

<!-- FORM FILTER -->
<form method="GET">
    <label>Bulan</label>
    <select name="bulan" required>
        <?php
        $bulan = [
            'Januari','Februari','Maret','April','Mei','Juni','Juli',
            'Agustus','September','Oktober','November','Desember'
        ];

        foreach ($bulan as $b) {
            $sel = (isset($_GET['bulan']) && $_GET['bulan'] == $b) ? "selected" : "";
            echo "<option $sel value='$b'>$b</option>";
        }
        ?>
    </select>

    <label>Tahun</label>
    <input type="number" name="tahun" value="<?= $_GET['tahun'] ?? date('Y') ?>" required>
    
    <button type="submit">Lihat</button>

</form>

<?php
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {

    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    // 🔹 mapping bulan Indonesia → angka
    $bulanMap = [
        'Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,
        'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12
    ];

    $bulanAngka = $bulanMap[$bulan];

    // Ambil semua anggota
    $anggota = mysqli_query($conn, "
        SELECT id_users, nama 
        FROM users 
        WHERE role='anggota'
        ORDER BY nama ASC
    ") or die("Query anggota gagal: " . mysqli_error($conn));
?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Nama Anggota</th>
        <th>Status</th>
        <th>Jumlah</th>
        <th>Tanggal Bayar</th>
    </tr>

    <?php while ($a = mysqli_fetch_assoc($anggota)) {

        $cek = mysqli_query($conn, "
        SELECT 
            SUM(jumlah) AS total,
            MAX(tanggal) AS tanggal_bayar
        FROM pemasukan
        WHERE id_users='{$a['id_users']}'
        AND MONTH(tanggal) = '$bulanAngka'
        AND YEAR(tanggal) = '$tahun'
        ");


        $row = mysqli_fetch_assoc($cek);

        if ($row['total'] > 0) {
            $status = "<span style='color:green;font-weight:bold;'>LUNAS</span>";
            $jumlah = "Rp " . number_format($row['total'], 0, ',', '.');
            $tanggal = date('d-m-Y', strtotime($row['tanggal_bayar']));
        } else {
            $status = "<span style='color:red;font-weight:bold;'>BELUM</span>";
            $jumlah = "Rp 0";
            $tanggal = "-";
        }

    ?>

    <tr>
        <td><?= $a['nama'] ?></td>
        <td><?= $status ?></td>
        <td><?= $jumlah ?></td>
        <td><?= $tanggal ?></td>
    </tr>

    <?php } ?>
</table>

<?php } ?>
