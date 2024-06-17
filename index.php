<?php
require "koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6 ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safira Hijab Collection Website</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require "navbar.php";
    ?>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Safira Hijab Collection</h1>
            <h4>Mau Belanja Apa?</h4>
            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get" class="">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Yuk!" aria-label="" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn color1 text-white">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3 ">
                    <div class="highlighted-kategori kategori-dress d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Dress" class="no-decoration ">Dress</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3 ">
                    <div class="highlighted-kategori kategori-bag d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Tas" class="no-decoration ">Tas</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3 ">
                    <div class="highlighted-kategori kategori-mukenah d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Mukenah" class="no-decoration">Mukenah</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about -->
    <div class="container-fluid color2 py-5">
        <div class="container text-center">
            <h3 class="text-color1">Tentang Kami</h3>
            <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi aliquam quod, perferendis a fuga ratione modi. Fugiat quod sit eius libero, quam aliquam consectetur! Enim excepturi fugiat ipsum consectetur tempore!</p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk Kami</h3>

            <div class="row mt-5">
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card">
                        <img src="image/dress-highlight.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text text-truncate">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <p class="card-text fw-bold">Rp.120000</p>
                            <a href="#" class="btn text-white color1">Lihat Produk</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>