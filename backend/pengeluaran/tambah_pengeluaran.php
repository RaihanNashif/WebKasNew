<?php
session_start();
require "../config/koneksi.php";
include "../partials/navbar.php";

$id_input = $_SESSION['id_users']; // admin yang input

// list anggota untuk dropdown
$anggota = mysqli_query($conn, "SELECT id_users, nama FROM users WHERE role='anggota' ORDER BY nama ASC");

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $keperluan = $_POST['keperluan'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $insert = mysqli_query($conn, "
        INSERT INTO pengeluaran (id_users, keperluan, keterangan, jumlah, tanggal, input_by)
        VALUES ('$id_user', '$keperluan', '$keterangan', '$jumlah', '$tanggal', '$id_input')
    ");

    if ($insert) {
        header("Location: list_pengeluaran.php");
        exit;
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<div class="container py-4">
    <h2>Tambah Pengeluaran</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Nama Anggota</label>
            <select name="id_user" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>
                <?php while ($row = mysqli_fetch_assoc($anggota)): ?>
                    <option value="<?= $row['id_users']; ?>">
                        <?= htmlentities($row['nama']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Keperluan</label>
            <input type="text" name="keperluan" class="form-control" required>
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
