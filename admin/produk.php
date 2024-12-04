<?php
require('../config/koneksi.php');

$lokasiimage = "assets/uploads/";
// Proses tambah produk
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $kategori_id = $_POST['kategori_id'];
    $harga = $_POST['harga'];
    $detail = $_POST['detail'];
    $ketersediaan_stok = $_POST['ketersediaan_stok'];
    // Proses upload foto produk
    $foto = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoFolder = $lokasiimage; // Sesuaikan dengan folder yang digunakan untuk menyimpan foto

    // Cek jika foto ada
    if ($foto) {
        $fotoPath = $fotoFolder . time() . '_' . basename($foto);
        if (move_uploaded_file($fotoTmp, $fotoPath)) {
        } else {
            $fotoPath = NULL; // Jika gagal uploads
        } // Pindahkan file foto ke folder uploads
    } else {
        $fotoPath = NULL; // Jika tidak ada foto yang diupload, set null
    }

    // Query untuk menambah produk ke database
    $query = "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
              VALUES ('$kategori_id', '$nama', '$harga', '$fotoPath', '$detail', '$ketersediaan_stok')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Produk berhasil ditambahkan'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk'); window.location='produk.php';</script>";
    }
}

// Proses edit produk
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori_id = $_POST['kategori_id']; // Ambil kategori_id dari form
    $harga = $_POST['harga'];
    $detail = $_POST['detail'];
    $ketersediaan_stok = isset($_POST['ketersediaan_stok']) ? $_POST['ketersediaan_stok'] : null;

    // Jika kategori tidak dipilih, ambil kategori lama dari database
    if (empty($kategori_id)) {
        $query = "SELECT kategori_id FROM produk WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        $kategori_id = $row['kategori_id']; // Set kategori lama
    }

    // Proses update data
    $foto = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoFolder = $lokasiimage;

    if ($foto) {
        $fotoPath = $fotoFolder . basename($foto);
        move_uploaded_file($fotoTmp, $fotoPath);

        $query = "UPDATE produk SET kategori_id='$kategori_id', nama='$nama', harga='$harga', 
                  foto='$fotoPath', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'";
    } else {
        $query = "UPDATE produk SET kategori_id='$kategori_id', nama='$nama', harga='$harga', 
                  detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'";
    }


    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Produk berhasil diperbarui'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk'); window.location='produk.php';</script>";
    }
}



// Proses Hapus Pengguna
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']); // Konversi ke integer untuk keamanan

    // Query untuk menghapus data pengguna berdasarkan ID
    $query = "DELETE FROM produk WHERE id = ?";

    // Siapkan statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $id); // "i" untuk tipe data integer

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Produk berhasil dihapus!'); window.location.href='produk.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus Produk!');</script>";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Terjadi kesalahan pada query!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Produk</title>
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
                    <h3>Data Produk</h3>
                    <p class="text-subtitle text-muted">Semua Data Produk</p>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                                <i class="bi bi-plus-circle"></i> Tambah Produk
                            </button>

                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID</th>
                                        <th>Nama Kategori</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Detail</th>
                                        <th>Ketersediaan Stok</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query untuk mengambil data produk dengan kategori
                                    $query = "SELECT p.id, p.kategori_id, p.nama, p.harga, p.foto, p.detail, p.ketersediaan_stok, k.nama AS kategori_nama
                                                FROM produk p
                                                LEFT JOIN kategori k ON p.kategori_id = k.id";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;

                                    while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['kategori_nama']; ?></td> <!-- Menampilkan nama kategori -->
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['harga']; ?></td>
                                            <td><img src="<?php echo $data['foto']; ?>" alt="Foto Produk" width="100"></td>
                                            <td><?php echo $data['detail']; ?></td>
                                            <td><?php echo $data['ketersediaan_stok']; ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $data['id']; ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <a href="produk.php?delete_id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="btn btn-danger btn-sm">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <!-- Modal Edit -->
                                <?php
                                // Reset data pointer jika $result digunakan lagi
                                mysqli_data_seek($result, 0);

                                while ($data = mysqli_fetch_assoc($result)) { ?>
                                    <div class="modal fade" id="modalEdit<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?php echo $data['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditLabel<?php echo $data['id']; ?>">Edit Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <!-- Input Kategori Produk -->
                                                        <div class="mb-3">
                                                            <label for="kategori_id<?php echo $data['id']; ?>" class="form-label">Kategori</label>
                                                            <select id="kategori_id<?php echo $data['id']; ?>" name="kategori_id" class="form-select" required>
                                                                <option value="">--Pilih Kategori--</option>
                                                                <?php
                                                                $query_kategori = "SELECT * FROM kategori";
                                                                $result_kategori = mysqli_query($koneksi, $query_kategori);

                                                                while ($kategori = mysqli_fetch_assoc($result_kategori)) {
                                                                    $selected = ($kategori['id'] == $data['kategori_id']) ? 'selected' : '';
                                                                    echo "<option value='{$kategori['id']}' {$selected}>{$kategori['nama']}</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <!-- Input Nama Produk -->
                                                        <div class="mb-3">
                                                            <label for="nama<?php echo $data['id']; ?>" class="form-label">Nama Produk</label>
                                                            <input type="text" id="nama<?php echo $data['id']; ?>" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama'], ENT_QUOTES); ?>" required>
                                                        </div>

                                                        <!-- Input Harga -->
                                                        <div class="mb-3">
                                                            <label for="harga<?php echo $data['id']; ?>" class="form-label">Harga</label>
                                                            <input type="number" id="harga<?php echo $data['id']; ?>" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
                                                        </div>

                                                        <!-- Input Foto -->
                                                        <div class="mb-3">
                                                            <label for="foto<?php echo $data['id']; ?>" class="form-label">Foto Produk</label>
                                                            <input type="file" id="foto<?php echo $data['id']; ?>" name="foto" class="form-control">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                                                        </div>

                                                        <!-- Input Detail -->
                                                        <div class="mb-3">
                                                            <label for="detail<?php echo $data['id']; ?>" class="form-label">Detail Produk</label>
                                                            <textarea id="detail<?php echo $data['id']; ?>" name="detail" class="form-control" required><?php echo htmlspecialchars($data['detail'], ENT_QUOTES); ?></textarea>
                                                        </div>

                                                        <!-- Input Ketersediaan Stok -->
                                                        <div class="mb-3">
                                                            <label for="ketersediaan_stok<?php echo $data['id']; ?>" class="form-label">Ketersediaan Stok</label>
                                                            <select id="ketersediaan_stok<?php echo $data['id']; ?>" name="ketersediaan_stok" class="form-select" required>
                                                                <option value="tersedia" <?php echo ($data['ketersediaan_stok'] == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                                                <option value="habis" <?php echo ($data['ketersediaan_stok'] == 'habis') ? 'selected' : ''; ?>>Habis</option>
                                                            </select>
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
                                <?php } ?>
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

        <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahProdukLabel">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select id="kategori_id" name="kategori_id" class="form-select" required>
                                    <!-- Isi kategori dari database -->
                                    <?php
                                    $conn = $koneksi;
                                    $query = "SELECT * FROM kategori";
                                    $result = mysqli_query($conn, $query);
                                    // $kategori = mysqli_fetch_assoc($result);
                                    // var_dump($kategori);
                                    if (@$result) {
                                        while ($kategori = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$kategori['id']}'>{$kategori['nama']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk</label>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" id="harga" name="harga" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea id="detail" name="detail" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ketersediaan_stok" class="form-label">Ketersediaan Stok</label>
                                <select id="ketersediaan_stok" name="ketersediaan_stok" class="form-select" required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="habis">Habis</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Produk</button>
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