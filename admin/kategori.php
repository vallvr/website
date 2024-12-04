<?php
require('../config/koneksi.php');

// Proses Tambah Kategori
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $query = "INSERT INTO kategori (nama) VALUES ('$nama')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Kategori berhasil ditambahkan!'); window.location.href='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan kategori!');</script>";
    }
}

// Proses Edit Kategori
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $query = "UPDATE kategori SET nama = '$nama' WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Kategori berhasil diperbarui!'); window.location.href='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori!');</script>";
    }
}

// Proses Hapus Kategori
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $query = "DELETE FROM kategori WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Kategori berhasil dihapus!'); window.location.href='kategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kategori!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Kategori</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
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

            <div class="page-heading">
                <div class="page-title">
                    <h3>Data Kategori</h3>
                    <p class="text-subtitle text-muted">Semua Data Kategori</p>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <i class="bi bi-plus-circle"></i> Tambah Kategori
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = mysqli_query($koneksi, "SELECT * FROM kategori");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $data['id']; ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEdit<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?php echo $data['id']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="" method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalEditLabel<?php echo $data['id']; ?>">Edit Kategori</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="nama<?php echo $data['id']; ?>" class="form-label">Nama Kategori</label>
                                                                        <input type="text" id="nama<?php echo $data['id']; ?>" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tombol Hapus -->
                                                <a href="?delete_id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <p>2024 &copy; Mazer</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
</body>

</html>
