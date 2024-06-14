<?php
require "session.php";
require "../koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
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
                    <input type="text" id="nama" class="form-control my-1" name="nama" autocomplete="off" required>
                </div>

                <div class="my-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control my-1" required>
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
                    <input type="number" class="form-control my-1" name="harga" required>
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

                <div class="my-3">
                    <button type="submit" class="btn btn-success" name="simpan">Submit</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $stok = htmlspecialchars($_POST['stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, kategori, dan harga harus diisi!
                    </div>
                    <?php
                } else {
                    if ($nama_file != '') {
                        if ($image_size > 5000000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File foto terlalu besar!
                            </div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif' && $imageFileType != 'jpeg') {
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Jenis file tidak dapat diupload!
                                </div>
                        <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }
                    // masukkan data kedalam database
                    $querySimpan = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$stok')");

                    if ($querySimpan) {
                        ?>
                        <div class="alert alert-success mt-3" role="alert">
                            Produk berhasil tersimpan!
                        </div>

                        <meta http-equiv="refresh" content="1; url=produk.php">
            <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>
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