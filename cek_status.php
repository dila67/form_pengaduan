<?php
include 'koneksi.php';
$hasil = null;
$error = "";

if (isset($_GET['cari'])) {
    $kode = mysqli_real_escape_string($conn, $_GET['kode_tiket']);
    $query = mysqli_query($conn, "SELECT * FROM pengaduan WHERE kode_tiket = '$kode'");
    
    if (mysqli_num_rows($query) > 0) {
        $hasil = mysqli_fetch_assoc($query);
    } else {
        $error = "Kode tiket tidak ditemukan. Periksa kembali kode Anda.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Status Pengaduan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-website">
<div class="result">
        <h2>Cek Status Pengaduan Warga</h2>
        <form action="" method="GET">
            <input type="text" name="kode_tiket" placeholder="Masukkan Kode Tiket Anda..." required>
            <button type="submit" name="cari">Cek Status</button>
        </form>

        <?php if (!empty($error)) : ?>
            <p class="error"><?= $error; ?></p>
        <?php endif; ?>

        <?php if ($hasil) : ?>
            <div class="result">
                <h3>Detail Pengaduan:</h3>
                <p><strong>Kode Tiket:</strong> <?= $hasil['kode_tiket']; ?></p>
                <p><strong>Nama Pelapor:</strong> <?= htmlspecialchars($hasil['nama_warga']); ?></p>
                <p><strong>Kategori:</strong> <?= $hasil['kategori']; ?></p>
                <p><strong>Lokasi:</strong> <?= htmlspecialchars($hasil['lokasi']); ?></p>
                <p><strong>Deskripsi:</strong> <?= htmlspecialchars($hasil['deskripsi']); ?></p>
                <p><strong>Status Saat Ini:</strong> 
                    <span class="badge 
                        <?php 
                            if($hasil['status'] == 'Pending') echo 'bg-pending';
                            elseif($hasil['status'] == 'Diproses') echo 'bg-proses';
                            else echo 'bg-selesai';
                        ?>">
                        <?= $hasil['status']; ?>
                    </span>
                </p>
                <p><small>Tanggal Laporan: <?= $hasil['created_at']; ?></small></p>
            </div>
        <?php endif; ?>

        <p style="margin-top: 20px;"><a href="index.php">&larr; Kembali ke Form Pengaduan</a></p>
    </div>
</body>
</html>s