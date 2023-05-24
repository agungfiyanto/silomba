<?php
require_once("controller/login.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css?version=1">
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/index_copy.css">
</head>

<body>
    <!-- Navbar -->
    <header class="container">
        <div class="nav-right">
            <a href="#link_sop">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Petunjuk
            </a>
            <a href="#link_pengajuan">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                pengajuan
            </a>
            <?php if (isset($_SESSION["id_user"])) : ?>
                <a onclick="return confirm('Apakah anda yakin ingin keluar');" href="controller/logout.php" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Logout
                </a>
            <?php else : ?>
                <a href="controller/login.php" type="button" data-bs-toggle="modal" data-bs-target="#login">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Login
                </a>
            <?php endif; ?>
        </div>
    </header>
    <!-- Akhir Navbar -->

    <!-- Login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="imgcontainer">
                        <img src="asset/img/logo_silomba.png" alt="Logo" class="logo" height="100px">
                    </div>
                    <div class="container">
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>
                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <div class="text-right">
                            <input type="submit" class="btn btn-success btn-block" name="login" value="Login" />
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Akhir Login -->

    <!-- Background Video -->
    <div class="bg-video">
        <img src="asset/img/lomba.jpg"></img>
        <p>SILOMBA</p>
        <p class="kepanjangan">Website Pengajuan Lomba</p>
    </div>
    <!-- Akhir Background Video -->

    <!-- Pengajuan -->
    <div class="konten container">
        <div class="pengajuan" id="link_pengajuan">
            <img src="asset/img/logo_silomba.png" alt="Logo SILOMBA" height="200px">
            <div class="kata">
                <h1><b>SILOMBA</b></h1>
                <p>SILOMBA merupakan website yang bertujuan untuk melakukan permohonan pengajuan lomba</p>

                <?php if (isset($_SESSION["id_user"])) : ?>
                    <a href="view/user/listPengajuan.php" class="btn btn-primary">Pengajuan</a>
                <?php else : ?>
                    <a onclick="Swal.fire(
                        'LOGIN',
                        'Silahkan Login terlebih dahulu untuk mengakses',
                        'warning'
                      )" class="btn btn-primary">Pengajuan</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Akhir Pengajuan -->

    <!-- Penggunaan -->
    <div class="penggunaan container" id="link_sop">
        <h1><b>Cara Permohonan Pengajuan Lomba</b></h1>
        <img src="asset/img/cara_penggunaan_silomba.svg" alt="Cara penggunaan" class="gambar1">
    </div>
    <!-- Ahhir Penggunaan -->

    <script src="asset/bootstrap/js/jquery.js"></script>
    <script src="asset/bootstrap/js/popper.js"></script>
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/alert/sweetalert2.all.min.js"></script>

</body>

</html>