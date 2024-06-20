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
    <link rel="icon" type="image/x-icon" href="image/favicon.ico">
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
                    <div class="input-group input-group-lg-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Yuk!" aria-label="" aria-describedby="basic-addon2" name="keyword" autocomplete="off">
                        <button type="submit" class="btn color1 text-white"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
    <div class="container-fluid py-5" id="kategori">
        <div class="container text-center ">
            <h3 class="fs-1">Kategori Terlaris</h3>
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
            <h3 class="text-color1 fs-1">Tentang Kami</h3>
            <p class="mt-3">Selamat datang di website resmi Safira Hijab Collection Malang! Kami sangat senang anda mengunjungi website resmi kami. Jika ingin melihat koleksi kamu Anda bisa datang atau menghubungi kami.</p>
            <ul class="list-group list-group-flush mt-3 lead">
                <li class="list-group-item color2">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="fw-bold">Location: </span><br>The 8 Residence Kav. 8 Tasikmadu
                </li>
                <li class="list-group-item color2">
                    <i class="bi bi-telephone-fill"></i>
                    <span class="fw-bold">Phone: </span><br />085234078910
                </li>
                <li class="list-group-item color2">
                    <i class="bi bi-instagram"></i>
                    <span class="fw-bold">Instagram: </span><br />@Safira0410
                </li>
            </ul>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5" id="produk">
        <div class="container text-center">
            <h3 class="fs-1">Produk</h3>
            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src=" image/<?php echo $data['foto']; ?>" class="card-img-top" alt="fotoProduk">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                                <p class="card-text text-truncate"> <?php echo $data['detail']; ?> </p>
                                <p class="card-text fw-bold">Rp. <?php echo $data['harga'] ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn text-white color1">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-dark mt-2" href="produk.php">Lihat Lainnya</a>
        </div>
    </div>

    <!-- footer -->
    <?php
    require "footer.php";
    ?>

    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>