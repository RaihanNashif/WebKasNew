<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../backend/config/koneksi.php';
include '../navbar.php';
?>
<div class="container">
  <h2>Data Pengeluaran</h2>
  <div class="main-card">
    <a class="btn btn-primary" href="tambah_pengeluaran.html">+ Tambah</a>
    <table class="table">
      <thead><tr><th>No</th><th>Keperluan</th><th>Jumlah</th><th>Tanggal</th><th>Oleh</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php
        $q=mysqli_query($conn,"SELECT p.*,u.nama FROM pengeluaran p LEFT JOIN users u ON p.id_user=u.id_user ORDER BY p.tanggal DESC");
        $no=1;
        while($r=mysqli_fetch_assoc($q)){
          $id=$r['id'];
      ?>
        <tr>
          <td><?=$no?></td>
          <td><?=htmlentities($r['keperluan'])?></td>
          <td>Rp <?=number_format($r['jumlah'],0,',','.')?></td>
          <td><?=htmlentities($r['tanggal'])?></td>
          <td><?=htmlentities($r['nama'])?></td>
          <td>
            <a class="btn btn-warning" href="edit_pengeluaran.html?id=<?=$id?>">Edit</a>
            <a class="btn btn-danger" href="../../backend/pengeluaran/index.php?action=delete&id=<?=$id?>" onclick="return confirm('Hapus pengeluaran ini?')">Hapus</a>
          </td>
        </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<footer class="container"><small>© Sistem Kas Desa</small></footer>
