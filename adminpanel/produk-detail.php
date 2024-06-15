<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" value="<?php echo $data['nama']; ?>" class="form-control my-1" name="nama" autocomplete="off" required>
                </div>

                <div class="my-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control my-1" required>
                        <option value="<?php echo $data['kategori_id'] ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id'] ?>"><?php echo $dataKategori['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-2">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control my-1" name="harga" value="<?php echo $data['harga'] ?>" required>
                </div>

                <div>
                    <label for="fotoTerkini">Foto Produk Terkini</label>
                    <img src="../image/<?php echo $data['foto'] ?>" width="350px" alt="foto produk terkini">
                </div>
                <div class="my-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="my-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"><?php echo $data['detail'] ?></textarea>
                </div>

                <div class="my-2">
                    <label for="stok">Ketersediaan Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok'] ?>"><?php echo $data['ketersediaan_stok'] ?></option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="Habis">habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="my-3">
                    <button type="submit" class="btn btn-primary me-1" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
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
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$stok' WHERE id=$id");

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

                                $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE id=$id");

                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Produk berhasil tersimpan!
                                    </div>

                                    <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }
            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

                if ($queryHapus) {
                    ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Produk Berhasil Dihapus!
                    </div>

                    <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>