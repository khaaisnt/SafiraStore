<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id ='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safira Hijab Collection Website | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    require "navbar.php";
    ?>

    <!-- detail produk -->
    <div class="container-fluid p-5">
        <div class="container">
            <div class="row">
                <a href="produk.php" class="mb-5 arrow-no-decoration">
                    <i class="bi bi-arrow-left fs-5"></i>
                </a>
                <div class="col-lg-5">
                    <img src="image/<?php echo $produk['foto']; ?>" alt="" class="w-100 border border-tertiary rounded">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1 class="my-4"><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5">
                        <?php echo $produk['detail']; ?>
                    </p>
                    <p class="fs-5">
                        Rp. <?php echo $produk['harga'] ?>
                    </p>
                    <p class="fs-5">
                        Status Ketersediaan: <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                    </p>
                    <a href="https://wa.me/6285234078910/" target="_blank">

                        <button class="btn btn-success"><i class="bi bi-whatsapp me-1"></i>Pesan Via WA</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- produk terkait -->
    <div class="container-fluid py-5">
        <div class="container">
            <h2 class="text-center mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                            <img src="image/<?php echo $data['foto']; ?>" alt="produk terkait" class="img-fluid img-thumbnail">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    require "footer.php";
    ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>