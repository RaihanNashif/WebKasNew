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

    <?php if (isset($_GET['bulan']) && isset($_GET['tahun'])): ?>
        <a href="export_pdf.php?bulan=<?= $_GET['bulan']; ?>&tahun=<?= $_GET['tahun']; ?>" 
           target="_blank"
           style="margin-left:20px; padding:8px; background:green; color:white; text-decoration:none;">
           Export PDF
        </a>
    <?php endif; ?>
</form>

<br><br>

<?php
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {

    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

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

        // Ambil status pembayaran asli
        $cek = mysqli_query($conn, "
            SELECT status, jumlah, tanggal_bayar 
            FROM status_pembayaran 
            WHERE id_users='{$a['id_users']}'
            AND bulan='$bulan'
            AND tahun='$tahun'
            LIMIT 1
        ") or die("Query status gagal: " . mysqli_error($conn));

        if(mysqli_num_rows($cek) > 0){
            $row = mysqli_fetch_assoc($cek);
            $status = ($row['status'] === 'lunas') 
                ? "<span style='color:green;font-weight:bold;'>LUNAS</span>"
                : "<span style='color:red;font-weight:bold;'>BELUM</span>";
            $jumlah = "Rp " . number_format($row['jumlah'], 0, ',', '.');
            $tanggal = $row['tanggal_bayar'];
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
