<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../backend/config/koneksi.php';
include '../navbar.php';
$id = mysqli_real_escape_string($conn, $_GET['id'] ?? '');
$q = mysqli_query($conn,"SELECT * FROM users WHERE id_user='$id' LIMIT 1");
$data = mysqli_fetch_assoc($q);
?>
<div class="container">
  <h2>Edit Anggota</h2>
  <div class="main-card" style="max-width:720px">
    <form action="../../backend/anggota/index.php?action=edit" method="POST">
    <input type="hidden" name="id_user" value="<?=htmlentities($data['id_user'])?>">
        <div class="form-row">
            <label>Nama</label>
            <input type="text" name="nama" value="<?=htmlentities($data['nama'])?>" required>
        </div>
        <div class="form-row">
            <label>Username</label>
            <input type="text" name="username" value="<?=htmlentities($data['username'])?>" required>
        </div>
        <div class="form-row">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="form-row">
            <label>Alamat</label>
            <textarea name="alamat">
                <?=htmlentities($data['alamat'])?>
            </textarea>
        </div>
        <div class="form-row">
            <label>No HP</label>
            <input type="text" name="no_hp" value="<?=htmlentities($data['no_hp'])?>">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
<footer class="container"><small>© Sistem Kas Desa</small></footer>
