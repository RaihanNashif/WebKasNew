<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../backend/config/koneksi.php';
include '../navbar.php';
$id_user = $_SESSION['id_user'] ?? 0;
$q = mysqli_query($conn,"SELECT * FROM status_pembayaran WHERE id_user='$id_user' ORDER BY tahun DESC, bulan DESC");
?>
<div class="container">
  <h2>Status Pembayaran Saya</h2>
  <div class="main-card">
    <?php if(mysqli_num_rows($q)==0) echo "<p class='small'>Belum ada data pembayaran</p>";
    else {
      echo "<table class='table'>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>";
            while($r=mysqli_fetch_assoc($q)) echo "<tr>
                <td>{$r['bulan']}</td>
                <td>{$r['tahun']}</td>
                <td>Rp ".number_format($r['jumlah'],0,',','.')."</td>
                <td>{$r['tanggal_bayar']}</td>
            </tr>";
      echo "
        </tbody>
      </table>";
    } ?>
  </div>
</div>
<footer class="container">
    <small>© Sistem Kas Desa</small>
</footer>
