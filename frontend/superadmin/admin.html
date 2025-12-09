<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../backend/config/koneksi.php';
include '../navbar.php';
?>
<div class="container">
  <h2>Kelola Admin (Superadmin)</h2>
  <div class="main-card">
    <a class="btn btn-primary" href="tambah_admin.html">+ Tambah Admin</a>
    <table class="table">
      <thead><tr><th>No</th><th>Nama</th><th>Username</th><th>Role</th><th>No HP</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php
        $q=mysqli_query($conn,"SELECT * FROM users WHERE role IN ('admin','superadmin') ORDER BY role DESC, nama");
        $no=1;
        while($r=mysqli_fetch_assoc($q)){
          $id=$r['id_user'];
      ?>
        <tr>
          <td><?=$no?></td>
          <td><?=htmlentities($r['nama'])?></td>
          <td><?=htmlentities($r['username'])?></td>
          <td><?=htmlentities($r['role'])?></td>
          <td><?=htmlentities($r['no_hp'])?></td>
          <td>
            <a class="btn btn-warning" href="edit_admin.html?id=<?=$id?>">Edit</a>
            <?php if($r['role']!='superadmin'): ?>
              <a class="btn btn-danger" href="../../backend/admin/index.php?action=delete&id=<?=$id?>" onclick="return confirm('Hapus admin ini?')">Hapus</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php $no++; } ?>
      </tbody>
    </table>
  </div>
</div>
<footer class="container"><small>© Sistem Kas Desa</small></footer>
