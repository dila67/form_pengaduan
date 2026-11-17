<?php
include 'koneksi.php';

// Fitur Ubah Status Pengaduan oleh Petugas
if (isset($_GET['aksi']) && $_GET['aksi'] == 'update') {
    $id = $_GET['id'];
    $status_baru = $_GET['status'];
    mysqli_query($conn, "UPDATE pengaduan SET status='$status_baru' WHERE id='$id'");
    header("Location: admin.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Monitoring Instansi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="table-container">
        <h2>Dashboard Monitoring Pengaduan Pemerintah</h2>
        <p>Kelola dan pantau status penanganan pengaduan masyarakat secara real-time.</p>
        
        <p><a href="index.php" class="btn-primary">+ Buat Pengaduan Baru</a></p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>Waktu</th>
                        <th>Nama Warga</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) : ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td><strong><?= $row['kode_tiket']; ?></strong></td>
                            <td><?= $row['created_at']; ?></td>
                            <td><?= htmlspecialchars($row['nama_warga']); ?> (NIK: <?= $row['nik']; ?>)</td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td>
                                <!-- Menampilkan Badge Status dengan Rapi & Berwarna -->
                                <?php if ($row['status'] == 'Pending'): ?>
                                    <span class="badge bg-pending">Pending</span>
                                <?php elseif ($row['status'] == 'Diproses'): ?>
                                    <span class="badge bg-proses">Diproses</span>
                                <?php else: ?>
                                    <span class="badge bg-selesai">Selesai</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Tombol Aksi Petugas dengan ID Dinamis -->
                                <a href="admin.php?aksi=update&id=<?= $row['id']; ?>&status=Pending" class="btn-pending">Pending</a>
                                <a href="admin.php?aksi=update&id=<?= $row['id']; ?>&status=Diproses" class="btn-proses">Proses</a>
                                <a href="admin.php?aksi=update&id=<?= $row['id']; ?>&status=Selesai" class="btn-selesai">Selesai</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">Belum ada data pengaduan masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>