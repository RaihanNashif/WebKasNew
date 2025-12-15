<?php 
include "../middleware/admin_superadmin.php";
include "../partials/navbar.php";
require "../config/koneksi.php";
?>

<h2>Daftar Status Pembayaran</h2>

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
    
    <button type="submit">Cari</button>
</form>

<br><br>

<?php
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {

    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    $query = mysqli_query($conn, "
        SELECT sp.*, u.nama 
        FROM status_pembayaran sp
        JOIN users u ON sp.id_users = u.id_users
        WHERE sp.bulan = '$bulan' AND sp.tahun = '$tahun'
        ORDER BY u.nama ASC
    ");
?>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Nama Anggota</th>
        <th>Status</th>
        <th>Jumlah</th>
        <th>Tanggal Bayar</th>
        <th>Aksi</th>
    </tr>

    <?php while ($d = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $d['nama']; ?></td>
            <td><b><?= $d['status']; ?></b></td>
            <td>Rp <?= number_format($d['jumlah'], 0, ',', '.') ?></td>
            <td><?= $d['tanggal_bayar']; ?></td>
            <td>
                <a href="hapus_status.php?id=<?= $d['id_status']; ?>" 
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Hapus data?')">
                    Hapus
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php } ?>
