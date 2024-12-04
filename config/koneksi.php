<?php
$host = 'localhost'; // Host database, biasanya localhost
$username = 'root';  // Username MySQL
$password = '';      // Password MySQL, kosongkan jika tidak ada password
$database = 'toko_online'; // Nama database yang benar

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
