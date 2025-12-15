<?php
session_start();
require "../config/koneksi.php";
include "../partials/navbar.php";

$id_input = $_SESSION['id_users']; // admin/superadmin yang input

// Ambil list anggota untuk dropdown
$anggota = mysqli_query($conn, "SELECT id_users, nama FROM users WHERE role='anggota' ORDER BY nama ASC");

if(isset($_POST['simpan'])){
    $id_user = $_POST['id_user'];
    $sumber = $_POST['sumber'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $insert = mysqli_query($conn, "
        INSERT INTO pemasukan (id_users, sumber, keterangan, jumlah, tanggal, input_by)
        VALUES ('$id_user','$sumber','$keterangan','$jumlah','$tanggal','$id_input')

    ");

    if($insert){
        // Update status pembayaran jadi LUNAS
        $bulan = date('n'); // angka bulan
        $bulanArray = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
            7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];
        $bulanIndo = $bulanArray[$bulan];
        $tahun = date('Y');

        mysqli_query($conn, "
            UPDATE status_pembayaran
            SET status='Lunas', tanggal_bayar=CURDATE()
            WHERE id_users='$id_user' AND bulan='$bulanIndo' AND tahun='$tahun'
        ");

        // Jika belum ada → insert baru
        if(mysqli_num_rows($cek) == 0){
            mysqli_query($conn, "
                INSERT INTO status_pembayaran (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
                VALUES ('$id_user', '$bulan', '$tahun', '$jumlah', 'Lunas', '$tanggal')
            ");
        } 
        // Jika sudah ada → update jadi LUNAS
        else {
            mysqli_query($conn, "
                UPDATE status_pembayaran 
                SET jumlah='$jumlah', status='Lunas', tanggal_bayar='$tanggal'
                WHERE id_users='$id_user' AND bulan='$bulan' AND tahun='$tahun'
            ");
        }
        header("Location: list_pemasukan.php");
        exit;
    } else {
        die("Error: ".mysqli_error($conn));
    }
}
?>

<div class="container py-4">
    <h2>Tambah Pemasukan</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Anggota</label>
            <select name="id_user" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while($row = mysqli_fetch_assoc($anggota)): ?>
                    <option value="<?= $row['id_users'] ?>"><?= htmlentities($row['nama']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Sumber</label>
            <input type="text" name="sumber" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
