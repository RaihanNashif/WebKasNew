<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Keuangan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Laporan Keuangan Saya</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabel-laporan">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Total Pemasukan</th>
                    <th>Total Pengeluaran</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="5" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
fetch('../../backend/laporan/get_laporan.php')
.then(res => res.json())
.then(data => {
    const tbody = document.querySelector("#tabel-laporan tbody");
    tbody.innerHTML = "";
    if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada laporan</td></tr>';
    } else {
        data.forEach((laporan, index) => {
            tbody.innerHTML += `
                <tr class="text-center">
                    <td>${index + 1}</td>
                    <td>${laporan.periode}</td>
                    <td>Rp ${Number(laporan.total_pemasukan).toLocaleString('id-ID')}</td>
                    <td>Rp ${Number(laporan.total_pengeluaran).toLocaleString('id-ID')}</td>
                    <td>Rp ${Number(laporan.saldo_akhir).toLocaleString('id-ID')}</td>
                </tr>
            `;
        });
    }
})
.catch(err => {
    console.error(err);
    document.querySelector("#tabel-laporan tbody").innerHTML = '<tr><td colspan="5" class="text-center">Gagal memuat data</td></tr>';
});
</script>

</body>
</html>
