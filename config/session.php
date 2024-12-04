<?php
// Mulai sesi
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Jika sudah login, tampilkan halaman sesuai keinginan
echo "Selamat datang, " . $_SESSION['username'] . "!";
?>
