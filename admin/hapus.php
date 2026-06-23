<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
require_once '../koneksi.php';

$id = intval($_GET['id'] ?? 0);
if ($id) {
    // Ambil nama foto dulu sebelum dihapus
    $result = mysqli_query($koneksi, "SELECT foto FROM customers WHERE id=$id");
    $row    = mysqli_fetch_assoc($result);

    // Hapus file foto dari folder assets
    if (!empty($row['foto']) && file_exists('../assets/' . $row['foto'])) {
        unlink('../assets/' . $row['foto']);
    }

    // Hapus dari database
    mysqli_query($koneksi, "DELETE FROM customers WHERE id=$id");
}

header('Location: customers.php?success=Customer berhasil dihapus!');
exit;