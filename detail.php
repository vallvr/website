<?php
// Koneksi ke database
require('config/koneksi.php');

// Ambil ID dari URL
$id_produk = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query SQL untuk mendapatkan data produk berdasarkan ID
$sql = mysqli_query($koneksi, "
    SELECT 
        produk.id, 
        produk.nama, 
        produk.harga, 
        produk.foto, 
        produk.detail, 
        produk.ketersediaan_stok, 
        kategori.nama AS kategori_nama
    FROM 
        produk
    LEFT JOIN 
        kategori 
    ON 
        produk.kategori_id = kategori.id
    WHERE 
        produk.id = $id_produk
    LIMIT 1
");

// Jika data ditemukan, ambil detailnya
$data = mysqli_fetch_assoc($sql);

if (!$data) {
    echo "<p>Produk tidak ditemukan atau ID tidak valid.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Blog Details - Selecao Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .category-item {
    color: #333; /* Warna teks default */
    cursor: pointer; /* Mengubah kursor saat hover */
    padding: 5px 0;
    display: flex;
    justify-content: space-between;
    font-size: 16px;
    transition: color 0.3s;
}

.category-item:hover {
    color: #555; /* Warna teks saat hover */
    background-color: #f0f0f0; /* Background saat hover */
    border-radius: 4px; /* Opsional untuk membuat efek lembut */
}

  </style>
</head>

<body class="blog-details-page">

    <?php include 'header.php'; ?>

    <main class="main">
        <!-- Page Title -->
        <div class="page-title dark-background">
            <div class="container position-relative">
                <h1>Detail Produk</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.php">Beranda</a></li>
                        <li class="current">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Detail Produk -->
                    <article class="article">
                        <div class="post-img">
                            <img
                                src="<?php echo !empty($data['foto']) ? 'admin/assets/uploads/' . basename($data['foto']) : 'path/to/placeholder.png'; ?>" 
                                alt="">
                            </div>
                        <h2 class="title"><?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?></h2>
                        <div class="content">
                            <p><?php echo htmlspecialchars($data['detail'], ENT_QUOTES); ?></p>
                            <p><strong>Harga:</strong> Rp<?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                            <p><strong>Ketersediaan Stok:</strong> <?php echo $data['ketersediaan_stok']; ?> unit</p>
                            <p><strong>Kategori:</strong> <?php echo htmlspecialchars($data['kategori_nama'], ENT_QUOTES); ?></p>
                        </div>
                    </article>

                    <!-- Form Pemesanan -->
                    <section id="comment-form" class="comment-form section">
                        <form id="orderForm" onsubmit="sendOrder(event)">
                            <h4>Form Pemesanan</h4>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="product-name">Produk yang Dipesan:</label>
                                    <input name="product-name" id="product-name" type="text" 
                                           class="form-control" value="<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Nama Anda*" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input name="phone" id="phone" type="text" class="form-control" placeholder="Nomor WhatsApp*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="comment" id="comment" class="form-control" placeholder="Pesanan atau Pertanyaan Lain*" required></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                            </div>
                        </form>
                    </section>
                </div>

                <div class="col-lg-4 sidebar">
                    <div class="widgets-container">
                        <div class="categories-widget widget-item">
                            <h3 class="widget-title">Kategori</h3>
                            <ul class="mt-3">
                                <?php
                                $query_kategori = "
                                    SELECT kategori.id, kategori.nama, COUNT(produk.id) AS jumlah_produk
                                    FROM kategori
                                    LEFT JOIN produk ON kategori.id = produk.kategori_id
                                    GROUP BY kategori.id, kategori.nama
                                ";
                                $result_kategori = $koneksi->query($query_kategori);
                                if ($result_kategori && $result_kategori->num_rows > 0) {
                                    while ($kategori = $result_kategori->fetch_assoc()) {
                                        echo '<li class="category-item">' . htmlspecialchars($kategori['nama'], ENT_QUOTES) . ' <span>(' . $kategori['jumlah_produk'] . ')</span></li>';
                                    }
                                } else {
                                    echo '<li class="category-item">Tidak ada kategori ditemukan.</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container">
            <h3 class="sitename">Vales Char,</h3>
            <p>Akses Toko Kami Di Sosial Media Anda</p>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-skype"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="container">
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    Valesia Vita Rosiana</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <script>
    function sendOrder(event) {
        event.preventDefault();

        // Ambil data dari form
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const comment = document.getElementById("comment").value;

        // Nomor WhatsApp admin
        const adminNumber = "0882005010182"; // Ganti dengan nomor WhatsApp admin

        // Format pesan WhatsApp
        const message = `
            Halo Admin, saya ingin memesan bunga.
            Berikut detail saya:
            - Nama: ${name}
            - Email: ${email}
            - Nomor WhatsApp: ${phone}
            - Pesanan/Pertanyaan: ${comment}
        `;

        // Encode URL dan redirect ke WhatsApp
        const waUrl = `https://wa.me/${adminNumber}?text=${encodeURIComponent(message)}`;
        window.open(waUrl, "_blank");
    }
</script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>