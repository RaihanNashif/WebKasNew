<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include '../navbar.php';
?>
<div class="container">
  <h2>Tambah Anggota</h2>
  <div class="main-card" style="max-width:720px">
    <form action="../../backend/anggota/index.php?action=add" method="POST">
        <div class="form-row">
            <label>Nama</label><input type="text" name="nama" required>
        </div>
        <div class="form-row">
            <label>Username</label><input type="text" name="username" required>
        </div>
        <div class="form-row">
            <label>Password</label><input type="password" name="password" required>
        </div>
        <div class="form-row">
            <label>Alamat</label><textarea name="alamat"></textarea>
        </div>
        <div class="form-row">
            <label>No HP</label><input type="text" name="no_hp">
        </div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
<footer class="container">
    <small>© Sistem Kas Desa</small>
</footer>
