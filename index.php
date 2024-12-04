<?php
// Koneksi ke database
require('config/koneksi.php');

// Query untuk mengambil data kategori
$query = "SELECT * FROM kategori";
$result = mysqli_query($koneksi, $query);

// Query untuk mengambil data produk dan kategorinya
$query_produk = "
    SELECT produk.*, kategori.nama AS kategori_nama 
    FROM produk 
    JOIN kategori ON produk.kategori_id = kategori.id
";
$result_produk = $koneksi->query($query_produk);

// Periksa apakah query berhasil
if (!$result_produk) {
    die("Query produk gagal: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Vales Charm</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
</head>

<body class="index-page">

<?php include 'header.php'; ?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Selamat Datang di Toko <span>vales Charm</span></h2>
            <p class="animate__animated animate__fadeInUp">Temukan buket bunga dengan pesona istimewa di Vales Charm, karena setiap rangkaian bunga kami diciptakan untuk memikat hati dan membuat setiap momen semakin mempesona.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Baca Selengkapnya</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Vales Charm: Sentuhan Keindahan yang Memikat di Setiap Buket Bunga.</h2>
            <p class="animate__animated animate__fadeInUp">Ciptakan momen istimewa dengan rangkaian bunga dari Vales Charm, di mana setiap buket membawa pesona dan keanggunan yang tak terlupakan.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Baca Selengkapnya</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Vales Charm: Keindahan Bunga yang Menawan, Untuk Setiap Cerita Hidup Anda.</h2>
            <p class="animate__animated animate__fadeInUp">Kami di Vales Charm menghadirkan bunga segar yang memancarkan keindahan dan pesona, sempurna untuk menyampaikan perasaan Anda pada momen-momen berharga.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Baca Selengkapnya</a>
          </div>
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang</h2>
        <p>Toko kami</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
            Di Vales Charm, kami tidak hanya menyajikan bunga segar dan indah, tetapi juga pengalaman berbelanja yang memuaskan. Setiap buket kami dirangkai dengan penuh perhatian, memastikan bahwa setiap bunga yang kami kirimkan membawa keindahan dan kebahagiaan. Pelayanan kami yang ramah dan cepat siap membantu Anda memilih bunga terbaik untuk setiap momen spesial.
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>Bunga yang Memikat, Pelayanan yang Luar Biasa.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Keindahan Bunga, Sentuhan Profesional.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Keindahan Bunga, Pelayanan Tepat, Hati yang Terpikat.</span></li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <h2>Kategori</h2>
          <p>Cari Kategori Yang Ingin Kamu Pesan</p>
      </div>

      <div class="container">
          <div class="row">
              <?php
              // Looping data kategori
              while ($kategori = mysqli_fetch_assoc($result)) {
              ?>
                  <div class="col-md-4 mb-4">
                      <div class="card">
                          <div class="card-body">
                          <div class="icon">
                            <i class="bi bi-calendar4-week" style="color: #fd7e14;"></i>
                          </div>
                              <h5 class="card-title"><?php echo $kategori['nama']; ?></h5>
                          </div>
                      </div>
                  </div>
              <?php
              }
              ?>
          </div>
      </div><!-- End Section Title -->

    </section><!-- /Services Section -->

   <!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Semua Produk</h2>
    <p>Lihat Produk dari Toko Kami</p>
</div><!-- End Section Title -->

        <!-- Destination Start -->
        <div class="container-xxl py-5 destination">
    <div class="container">
        <div class="row g-3">
            <?php
            $sql = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($data = mysqli_fetch_assoc($sql)) {
                ?>
                <div class="col-lg-4 col-md-4 wow zoomIn" data-wow-delay="0.1s">
                    <a class="position-relative d-block overflow-hidden" href="detail.php?id=<?php echo $data['id']; ?>">
                        <img class="img-fluid rounded-2" style="height: 300px; width:100%; object-fit:cover" 
                             src="<?php echo !empty($data['foto']) ? 'admin/assets/uploads/' . basename($data['foto']) : 'path/to/placeholder.png'; ?>" 
                             alt="">
                        <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">
                            <?php echo htmlspecialchars($data['detail'], ENT_QUOTES); ?>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

    <!-- Destination Start -->



    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Hubungi Kami Apabila Ingin Custom Pesanan</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Palur</h3>
                <p>Mojolaban, Sukoharjo</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Nomer Telepon</h3>
                <p>+62 882005010182</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>valesiavita@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

        <!-- Contact Form -->
<div class="col-lg-8">
    <form id="contactForm" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
        <div class="row gy-4">

            <div class="col-md-6">
                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Kamu" required="">
            </div>

            <div class="col-md-12">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Yang Kamu Inginkan" required="">
            </div>

            <div class="col-md-12">
                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Beri Pesan Sesuai dengan yang Kamu Inginkan" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>

                <!-- Button to send message -->
                <button type="button" id="sendMessageBtn">Kirim Pesan</button>
            </div>

        </div>
    </form>
</div><!-- End Contact Form -->

<!-- Script to handle sending the message via WhatsApp -->
<script>
document.getElementById("sendMessageBtn").addEventListener("click", function() {
    // Get the values from the form inputs
    var name = document.getElementById("name").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    // Check if all fields are filled
    if (name === "" || subject === "" || message === "") {
        alert("Harap lengkapi semua kolom sebelum mengirim pesan.");
        return; // Prevent sending if any field is empty
    }

    // Create the message content for WhatsApp
    var whatsappMessage = `*Nama*: ${name}\n*Yang Kamu Inginkan*: ${subject}\n*Pesan*: ${message}`;

    // Encode the message to make it URL-friendly
    var encodedMessage = encodeURIComponent(whatsappMessage);

    // WhatsApp phone number (replace with the target WhatsApp number)
    var phoneNumber = "0882005010182"; // Replace with your WhatsApp number

    // Create the WhatsApp URL
    var whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

    // Redirect to the WhatsApp URL
    window.location.href = whatsappURL;

    // Clear the form after sending
    document.getElementById("contactForm").reset();
});
</script>



        <!-- Add this script to handle the WhatsApp message sending -->
        <script>
        document.getElementById("sendMessageBtn").addEventListener("click", function() {
            // Get the values from the form
            var name = document.getElementById("name").value;
            var subject = document.getElementById("subject").value;
            var message = document.getElementById("message").value;

            // Create the message to send
            var whatsappMessage = `*Name*: ${name}\n*Subject*: ${subject}\n*Message*: ${message}`;

            // Encode the message to make it URL-friendly
            var encodedMessage = encodeURIComponent(whatsappMessage);

            // WhatsApp phone number (change this to the number you want to receive messages)
            var phoneNumber = "0882005010182"; // Replace with your WhatsApp number
            
            // Construct the WhatsApp URL
            var whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

            // Redirect to the WhatsApp URL to send the message
            window.location.href = whatsappURL;
        });
        </script>


        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">
        <div class="container">
            <h3 class="sitename">Vales Char,</h3>
            <p>Akses Toko Kami Di Sosial Media Anda</p>
            <div class="social-links d-flex justify-content-center">
                <a href="https://wa.me/62882005010182" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                </a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>