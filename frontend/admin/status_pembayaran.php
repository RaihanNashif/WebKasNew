<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include '../navbar.php';
?>
<div class="container">
  <h2>Tambah Pengeluaran</h2>
  <div class="main-card" style="max-width:720px">
    <form action="../../backend/pengeluaran/index.php?action=add" method="POST">
      <div class="form-row">
        <label>Keperluan</label>
        <input type="text" name="keperluan" required>
      </div>
      <div class="form-row">
        <label>Jumlah</label>
        <input type="number" name="jumlah" required>
      </div>
      <div class="form-row">
        <label>Tanggal</label>
        <input type="date" name="tanggal" required>
      </div>
      <button class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
<footer class="container">
    <small>© Sistem Kas Desa</small>
</footer>
