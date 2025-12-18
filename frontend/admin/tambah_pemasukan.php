<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include '../navbar.html';
?>
<div class="container">
    <h2>Tambah Pemasukan</h2>
    <div class="main-card">

        <form action="../../backend/pemasukan/index.php?action=add" method="POST">

            <div class="form-row">
                <label>Sumber</label>
                <input type="text" name="sumber" required>
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
<footer class="container"><small>© Sistem Kas Desa</small></footer>