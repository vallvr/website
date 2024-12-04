<?php
require('../config/koneksi.php');

// Query untuk menghitung jumlah produk
$query = "SELECT COUNT(*) AS jumlah_produk FROM produk";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();

// Ambil jumlah produk
$jumlah_produk = $data['jumlah_produk'];

$query = "SELECT COUNT(*) AS jumlah_kategori FROM kategori";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();

// Ambil jumlah kategori
$jumlah_kategori = $data['jumlah_kategori'];

$query = "SELECT COUNT(*) AS jumlah_pengguna FROM pengguna";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();

// Ambil jumlah pengguna
$jumlah_pengguna = $data['jumlah_pengguna'];

$query = "SELECT kategori.nama AS kategori, COUNT(produk.id) AS jumlah_produk
          FROM kategori
          LEFT JOIN produk ON kategori.id = produk.kategori_id
          GROUP BY kategori.nama";
$result = $koneksi->query($query);

$produk_data = [];
while ($row = $result->fetch_assoc()) {
    $produk_data[] = [
        'kategori' => $row['kategori'],
        'jumlah_produk' => $row['jumlah_produk']
    ];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">

            <?php include 'menukiri.php'; ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <?php include 'menuatas.php'; ?>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah Pengguna</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php echo isset($jumlah_pengguna) ? number_format($jumlah_pengguna, 0, ',', '.') : '0'; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah Kategori</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php echo isset($jumlah_kategori) ? $jumlah_kategori : '0'; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah Produk</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php echo isset($jumlah_produk) ? $jumlah_produk : '0'; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Produk</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="chart-visitors-profile"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <!-- Tombol Logout -->
                                <form action="../logout.php" method="POST">
                                    <button type="submit" class="btn btn-danger mt-3">Log Out</button>
                                </form>
                            </div>
                        </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Valesia Vita Rosiana</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data produk dari PHP
    var produkData = <?php echo json_encode($produk_data); ?>;

    // Ambil kategori dan jumlah produk
    var kategoriLabels = produkData.map(function(item) { return item.kategori; });
    var jumlahProdukData = produkData.map(function(item) { return item.jumlah_produk; });

    // Konfigurasi Chart.js
    var ctx = document.getElementById('chart-visitors-profile').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',  // Jenis grafik (bar chart)
        data: {
            labels: kategoriLabels,  // Kategori produk
            datasets: [{
                label: 'Jumlah Produk',
                data: jumlahProdukData,  // Jumlah produk di setiap kategori
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>