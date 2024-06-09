<?php
require "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<style>
    .box{
        border: solid;
    }

    .summary-kategori{
        background-color: #41ba52;
    }

    .large-icon {
        font-size: 4rem; /* Atur ukuran sesuai kebutuhan */
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
                    <i class="bi bi-house-door-fill"></i>Home
                </li>
            </ol>
        </nav>
        <h2>Selamat Datang <?php echo $_SESSION['username'] ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 box summary-kategori">
                    <div class="row" >
                        <div class="col-6">
                            <i class="bi bi-card-list large-icon"></i>
                        </div>
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>