<?php
session_start();

// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'toko_online';

// Buat koneksi
$koneksi = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $koneksi->real_escape_string($_POST['password']);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM pengguna";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['username'] = $username;
        header("Location: admin/index.php");
        exit();
    } else {
        // Login gagal
        echo "<script>
                alert('Username atau password salah');
                window.location.href = 'index.php';
              </script>";
    }
}

// Tutup koneksi
$koneksi->close();
?>
