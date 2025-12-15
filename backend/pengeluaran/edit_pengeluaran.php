<?php
session_start();
require "../config/koneksi.php";
include "../partials/navbar.php";

$id = $_GET['id'];
$id_input = $_SESSION['id_users'];

$p = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id_pengeluaran='$id'");
$data = mysqli_fetch_assoc($p);

// list anggota
$anggota = mysqli_query($conn, "SELECT id_users, nama FROM users WHERE role='anggota' ORDER BY nama ASC");

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $keperluan = $_POST['keperluan'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $update = mysqli_query($conn, "
        UPDATE pengeluaran 
        SET id_users='$id_user',
            keperluan='$keperluan',
            keterangan='$keterangan',
            jumlah='$jumlah',
            tanggal='$tanggal',
            input_by='$id_input'
        WHERE id_pengeluaran='$id'
    ");

    if ($update) {
        header("Location: list_pengeluaran.php");
        exit;
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<div class="container py-4">
    <h2>Edit Pengeluaran</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Anggota</label>
            <select name="id_user" class="form-select" required>
                <?php while ($row = mysqli_fetch_assoc($anggota)): ?>
                    <option value="<?= $row['id_users']; ?>"
                        <?= $row['id_users'] == $data['id_users'] ? 'selected' : '' ?>>
                        <?= htmlentities($row['nama']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Keperluan</label>
            <input type="text" name="keperluan" class="form-control" value="<?= htmlentities($data['keperluan']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= htmlentities($data['keterangan']); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal']; ?>" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Update</button>
    </form>
</div>
