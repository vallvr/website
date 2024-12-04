<?php
    session_start();
    require('../config/koneksi.php'); // pastikan koneksi database sudah benar

    // Cek jika sudah login
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        header('Location: index.php');
        exit;
    }

    // Cek jika ada pesan error sebelumnya
    $error_message = '';
    if (isset($_SESSION['error_message'])) {
        $error_message = $_SESSION['error_message'];
        unset($_SESSION['error_message']); // Hapus pesan error setelah ditampilkan
    }

    if (isset($_POST['loginbtn'])) {
        // Mengambil data input
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Query untuk memeriksa keberadaan username
        $query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username='$username'");
        $countdata = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        if ($countdata > 0) {
            // Memeriksa password
            if (password_verify($password, $data['password'])) {
                // Set session jika login berhasil
                $_SESSION['username'] = $data['username'];
                $_SESSION['login'] = true;

                // Redirect ke halaman admin (index.php)
                header('Location: index.php');
                exit;
            } else {
                // Password salah, set pesan error
                $_SESSION['error_message'] = 'Password Salah.';
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        } else {
            // Username tidak ditemukan, set pesan error
            $_SESSION['error_message'] = 'Akun tidak ada.';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form action="" method="POST">
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <!-- Tombol Login -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="loginbtn">Login</button>
                </div>
            </form>

            <?php
            // Menampilkan error message jika ada
            if ($error_message) {
                echo '<div class="alert alert-warning mt-3" role="alert">' . $error_message . '</div>';
            }
            ?>

        </div>
    </div>

    <!-- Link ke file JS Bootstrap -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
