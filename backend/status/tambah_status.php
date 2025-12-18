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
        if ($insert) {

            // ambil bulan & tahun dari tanggal input
            $bulanAngka = date('n', strtotime($tanggal));
            $tahun = date('Y', strtotime($tanggal));
        
            $bulanArray = [
                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
            ];
            $bulanIndo = $bulanArray[$bulanAngka];
        
            // cek status pembayaran
            $cek = mysqli_query($conn, "
                SELECT id_status
                FROM status_pembayaran
                WHERE id_users='$id_user'
                  AND bulan='$bulanIndo'
                  AND tahun='$tahun'
            ");
        
            if (mysqli_num_rows($cek) == 0) {
                // belum ada → insert
                mysqli_query($conn, "
                    INSERT INTO status_pembayaran
                    (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
                    VALUES
                    ('$id_user', '$bulanIndo', '$tahun', '$jumlah', 'Lunas', '$tanggal')
                ");
            } else {
                // sudah ada → update
                mysqli_query($conn, "
                    UPDATE status_pembayaran
                    SET jumlah='$jumlah',
                        status='Lunas',
                        tanggal_bayar='$tanggal'
                    WHERE id_users='$id_user'
                      AND bulan='$bulanIndo'
                      AND tahun='$tahun'
                ");
            }
        
            header("Location: list_pemasukan.php");
            exit;
        }
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
