<?php 
include "../middleware/anggota_only.php";
include "../partials/navbar.php";
require "../config/koneksi.php";

// Ambil status pembayaran user ini
$idUser = $_SESSION['id_user'];
$q = mysqli_query($conn,
    "SELECT bulan, tahun FROM status_pembayaran WHERE id_users='$idUser'"
);

?>

<div class="container">
    <h2>Dashboard Anggota</h2>
    <p>Halo <?= $_SESSION['nama']; ?>! Berikut status pembayaran kamu:</p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Status</th>
        </tr>

        <?php if (mysqli_num_rows($q) == 0): ?>
            <tr>
                <td colspan="3" class="center">Belum ada data pembayaran.</td>
            </tr>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($q)): ?>
            <tr>
                <td><?= $row['bulan'] ?></td>
                <td><?= $row['tahun'] ?></td>
                <td style="color:green; font-weight:bold;">LUNAS</td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>

    </table>

</div>
                