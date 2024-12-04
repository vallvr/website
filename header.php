<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="index.html" class="logo d-flex align-items-center">
      <h1 class="sitename m-0">Vales Charm</h1>
    </a>

    <!-- Navigation Menu -->
    <nav id="navmenu" class="navmenu d-flex align-items-center">
      <ul class="d-flex align-items-center list-unstyled m-0">
        <li><a href="#hero" class="active me-3 text-decoration-none">Beranda</a></li>
        <li><a href="#about" class="me-3 text-decoration-none">Tentang Toko Kami</a></li>
        <li><a href="#services" class="me-3 text-decoration-none">Kategori</a></li>
        <li><a href="#portfolio" class="me-3 text-decoration-none">Semua Produk</a></li>
        <li><a href="#contact" class="text-decoration-none">Hubungi Kami</a></li>
      </ul>

      <!-- Button Login Admin -->
      <button class="btn btn-outline-primary ms-3 d-none d-xl-block" data-bs-toggle="modal" data-bs-target="#loginModal">Login Admin</button>

      <!-- Mobile Navigation Toggle -->
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="login.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Login</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>