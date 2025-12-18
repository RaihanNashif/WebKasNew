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

    if ($insert) {

        $bulanAngka = date('n', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
    
        $bulanArray = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
            7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];
        $bulanIndo = $bulanArray[$bulanAngka];
    
        // UPDATE dulu
        $update = mysqli_query($conn, "
            UPDATE status_pembayaran
            SET jumlah='$jumlah',
                status='Lunas',
                tanggal_bayar='$tanggal'
            WHERE id_users='$id_user'
              AND bulan='$bulanIndo'
              AND tahun='$tahun'
        ");
    
        // kalau tidak ada yang ter-update → insert
        if (mysqli_affected_rows($conn) == 0) {
            mysqli_query($conn, "
                INSERT INTO status_pembayaran
                (id_users, bulan, tahun, jumlah, status, tanggal_bayar)
                VALUES
                ('$id_user','$bulanIndo','$tahun','$jumlah','Lunas','$tanggal')
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

    <?php //Cek Generate Status
        // ambil bulan & tahun sekarang
        $bulanArray = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
            7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];

        $bulanSekarang = $bulanArray[date('n')];
        $tahunSekarang = date('Y');

        // cek apakah status bulan ini sudah di-generate
        $cekGenerate = mysqli_query($conn, "
            SELECT 1 
            FROM status_pembayaran 
            WHERE bulan='$bulanSekarang' 
            AND tahun='$tahunSekarang'
            LIMIT 1
        ");

        $belumGenerate = (mysqli_num_rows($cekGenerate) == 0);
    ?>

    <?php if ($belumGenerate): ?>
        <div class="alert alert-warning">
            <b>Perhatian!</b><br>
            Status pembayaran bulan
            <b><?= $bulanSekarang ?> <?= $tahunSekarang ?></b>
            belum di-generate.<br>
            Silakan generate terlebih dahulu di menu
            <b>Status Pembayaran</b>.
        </div>
    <?php endif; ?>

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
