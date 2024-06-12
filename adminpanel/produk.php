<?php
require "session.php";
require "../koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <?php
    require "navbar.php";
    ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-inboxes-fill me-1"></i>Produk
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control my-1" name="nama" autocomplete="off">
                </div>

                <div class="my-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control my-1">
                        <option value="">Pilih Kategori</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-2">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control my-1" name="harga">
                </div>

                <div class="my-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="my-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="my-2">
                    <label for="stok">Ketersediaan Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan=5 class="text-center">Data produk tidak ada</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['kategori_id'] ?></td>
                                    <td><?php echo $data['harga'] ?></td>
                                    <td><?php echo $data['ketersediaan_stok'] ?></td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
            </div>
        </div>
    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>