<?php
require('../config/koneksi.php');

// Proses Tambah Pengguna
if (isset($_POST['tambah'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $cek_query = "SELECT * FROM pengguna WHERE username = '$username'";
    $result = mysqli_query($koneksi, $cek_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
    } else {
        $query = "INSERT INTO pengguna (username, password) VALUES ('$username', '$hashed_password')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Pengguna berhasil ditambahkan!'); window.location.href='pengguna.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan pengguna!');</script>";
        }
    }
}

// Proses Edit Data Pengguna
if (isset($_POST['edit'])) {
    $id = $_POST['id']; 
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE pengguna SET username = '$username', password = '$hashed_password' WHERE id = $id";
    } else {
        $query = "UPDATE pengguna SET username = '$username' WHERE id = $id";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pengguna berhasil diupdate!'); window.location.href='pengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate pengguna!');</script>";
    }
}

// Proses Hapus Pengguna
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $query = "DELETE FROM pengguna WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pengguna berhasil dihapus!'); window.location.href='pengguna.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna!');</script>";
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
                    <h3>Data Pengguna</h3>
                    <p class="text-subtitle text-muted">Semua Data Pengguna</p>
                </div>

                <section class="section">
                    <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">
                            <i class="bi bi-plus-circle"></i> Tambah Pengguna
                        </button>

                        <!-- Modal Tambah Pengguna -->
                        <div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-labelledby="modalTambahPenggunaLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahPenggunaLabel">Tambah Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Input Username -->
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" id="username" name="username" class="form-control" required>
                                            </div>
                                            <!-- Input Password -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" id="password" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Pengguna</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = mysqli_query($koneksi, "SELECT * FROM pengguna");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
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
                                                                    <h5 class="modal-title" id="modalEditLabel<?php echo $data['id']; ?>">Edit Pengguna</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Input Username -->
                                                                    <div class="mb-3">
                                                                        <label for="username<?php echo $data['id']; ?>" class="form-label">Username</label>
                                                                        <input type="text" id="username<?php echo $data['id']; ?>" name="username" class="form-control" value="<?php echo htmlspecialchars($data['username']); ?>" required>
                                                                    </div>
                                                                    <!-- Input Password -->
                                                                    <div class="mb-3">
                                                                        <label for="password<?php echo $data['id']; ?>" class="form-label">Password</label>
                                                                        <input type="password" id="password<?php echo $data['id']; ?>" name="password" class="form-control">
                                                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- Hidden Input untuk ID -->
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


    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
</body>

</html>
