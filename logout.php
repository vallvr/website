<?php
// Mulai sesi
session_start();

// Menghapus semua data sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Mengarahkan pengguna kembali ke halaman index.php
header("Location: ./index.php");
exit;
?>
