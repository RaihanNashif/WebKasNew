<?php
include "../middleware/login_required.php"; 
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<h2>Transparansi Dana Kas Desa</h2>

<style>
    table {
        border-collapse: collapse;
        width: 90%;
        margin-top: 20px;
        margin-bottom: 30px;
    }
    th, td {
        border: 1px solid #777;
        padding: 10px;
        text-align: left;
    }
    th {
        background: #f0f0f0;
    }
    .box {
        padding: 15px;
        background: #e9f7ef;
        border-left: 5px solid green;
        margin-bottom: 20px;
        width: 300px;
        font-size: 17px;
    }
</style>

<?php
// ==== HITUNG TOTAL PEMASUKAN ====
$qPemasukan = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pemasukan");
$total_pemasukan = mysqli_fetch_assoc($qPemasukan)['total'] ?? 0;

// ==== HITUNG TOTAL PENGELUARAN ====
$qPengeluaran = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM pengeluaran");
$total_pengeluaran = mysqli_fetch_assoc($qPengeluaran)['total'] ?? 0;

// ==== SALDO AKHIR ====
$saldo = $total_pemasukan - $total_pengeluaran;
?>

<div class="box">
    <b>Total Pemasukan:</b> Rp <?= number_format($total_pemasukan, 0, ',', '.') ?>
</div>

<div class="box" style="background:#fdecea; border-left-color:red;">
    <b>Total Pengeluaran:</b> Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?>
</div>

<div class="box" style="background:#e8f4fd; border-left-color:blue;">
    <b>Saldo Akhir:</b> Rp <?= number_format($saldo, 0, ',', '.') ?>
</div>

<br><hr><br>

<h3>Daftar Pemasukan</h3>

<table>
    <tr>
        <th>Tanggal</th>
        <th>Sumber</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>

    <?php
    $pemasukan = mysqli_query($conn, "SELECT * FROM pemasukan ORDER BY id_pemasukan DESC");
    while ($p = mysqli_fetch_assoc($pemasukan)) { ?>
        <tr>
            <td><?= $p['tanggal']; ?></td>
            <td><?= $p['sumber']; ?></td>
            <td>Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
            <td><?= $p['keterangan']; ?></td>
        </tr>
    <?php } ?>
</table>


<h3>Daftar Pengeluaran</h3>

<table>
    <tr>
        <th>Tanggal</th>
        <th>Keperluan</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>

    <?php
    $pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran ORDER BY id_pengeluaran DESC");
    while ($p = mysqli_fetch_assoc($pengeluaran)) { ?>
        <tr>
            <td><?= $p['tanggal']; ?></td>
            <td><?= $p['keperluan']; ?></td>
            <td>Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
            <td><?= $p['keterangan']; ?></td>
        </tr>
    <?php } ?>
</table>

