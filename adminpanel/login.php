<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <style>
        .main {
            height: 100vh;
        }

        .login-box {
            width: 500px;
            height: 320px;
            border-radius: 10px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <h3 class="text-center">Login</h3>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username" autocomplete="off">
                </div>
                <div class="mt-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password">
                </div>
                <div class="my-3">
                    <button class="btn btn-success form-control" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width:500px">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($conn, "SELECT password FROM users WHERE username = '$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $username;
                        $_SESSION['login'] = true;
                        header("Location:index.php");
                        exit;
                    } else {
            ?>
                        <div class="alert alert-danger" role="alert">
                            Password Salah
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Akun Tidak Tersedia
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>