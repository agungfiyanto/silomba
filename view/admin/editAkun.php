<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

require('../../controller/config.php');
require('../../controller/admin/ambilData.php');
require('../../controller/admin/update.php');
$id = $_GET['id'];
$data = users($id)[0];

if (isset($_POST["Simpan"])) {
    if (data_masuk($_POST)) {
        $id = $_GET['id'];
        $data = users($id)[0];
        echo
        "<script>
            alert('data berhasil di simpan');
        </script>";
    } else {
        echo
        "<script>
            alert('data gagal di simpan, sandi dan konfirmasi tidak sama');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/reset.css">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/admin/editAkun.css">
    <title>Document</title>
</head>

<body>
    <div class="tata-letak">
        <!-- Awal Navigasi -->
        <?php
        include('navigasi.php');
        ?>
        <!-- Akhir navigasi -->

        <!-- Isi Konten -->
        <div class="konten">
            <div class="kotak">
                <h3 class="title">Edit Akun</h3>
                <div class="kotak2">
                    <div class="isi">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id_user']; ?>">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" value="<?= $data['username']; ?>">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" value="<?= $data['email']; ?>">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" id="konfirmasi">
                            <h6 style="margin-top: 20px; font-weight: bold;">Sebagai</h6>
                            <div style="margin-left: 20px;">
                                <?php
                                $checked = 'checked';
                                if ($data['level'] == 1) { ?>
                                    <input type="radio" name="level" id="admin" value="1" <?= $checked ?>>
                                    <label for="admin">Admin</label><br>
                                    <input type="radio" name="level" id="user" value="2">
                                    <label for="user">User</label>
                                <?php } elseif ($data['level'] == 2) { ?>
                                    <input type="radio" name="level" id="admin" value="1">
                                    <label for="admin">Admin</label><br>
                                    <input type="radio" name="level" id="user" value="2" <?= $checked ?>>
                                    <label for="user">User</label>
                                <?php } ?>
                            </div>
                            <button type="submit" class="btn" name="Simpan">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir konten -->
    </div>

    <script src="../../asset/bootstrap/js/jquery.js"></script>
    <script src="../../asset/bootstrap/js/popper.js"></script>
    <script src="../../asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../asset/alert/sweetalert2.all.min.js"></script>
</body>

</html>