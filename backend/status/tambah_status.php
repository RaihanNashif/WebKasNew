<?php 
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

if (isset($_POST['simpan'])) {

    $id_user = $_POST['id_users'];
    $bulan   = $_POST['bulan'];
    $tahun   = $_POST['tahun'];
    $jumlah  = $_POST['jumlah'];

    $insert = mysqli_query($conn, "
        INSERT INTO status_pembayaran (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
        VALUES ($id_user, '$bulan', '$tahun', $jumlah, 'LUNAS', NOW())
    ");

    if ($insert) {
        echo "<script>alert('Berhasil ditambahkan'); window.location='list_status.php';</script>";
    } else {
        echo "<script>alert('Gagal!');</script>";
    }
}
?>

<h2>Tambah Status Pembayaran</h2>

<form method="POST">
    <label>Pilih Anggota</label>
    <select name="id_users" required>
        <option value="">-- pilih --</option>
        <?php
        $anggota = mysqli_query($conn, "SELECT * FROM users WHERE role='anggota'");
        while ($a = mysqli_fetch_assoc($anggota)) {
            echo "<option value='{$a['id_users']}'>{$a['nama']}</option>";
        }
        ?>
    </select>

    <label>Bulan</label>
    <select name="bulan" required>
        <?php foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b): ?>
            <option><?= $b ?></option>
        <?php endforeach; ?>
    </select>

    <label>Tahun</label>
    <input type="number" name="tahun" value="<?= date('Y') ?>" required>

    <label>Jumlah Pembayaran</label>
    <input type="number" name="jumlah" required>

    <button type="submit" name="simpan">Simpan</button>
</form>
