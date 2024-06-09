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
</head>
<body>
    <?php 
    require "navbar.php";
    ?>
    <h2>Selamat Datang <?php echo $_SESSION['username']?></h2>
</body>
</html>