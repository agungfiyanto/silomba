<?php
require_once('../../controller/config.php');
require_once('../../controller/query/perintahSelect.php');
require_once('../../controller/admin/jumlahData.php');

session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

$jumlahPengajuan = jumlahPengajuan();
$jumlahAkun = jumlahAkun();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/admin/dashboard.css">
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
            <div class="kotak kotak-1 pengajuan">
                <h3 style="text-align: center;">Jumlah<br>Pengajuan</h3>
                <table style="margin-top: 30px;">
                    <tr>
                        <td>
                            <div class="belum"></div>
                        </td>
                        <td>Masih Proses</td>
                        <td>:</td>
                        <td><?= $jumlahPengajuan[0];  ?></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="terima"></div>
                        </td>
                        <td>Diterima</td>
                        <td>:</td>
                        <td><?= $jumlahPengajuan[1]; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="tolak"></div>
                        </td>
                        <td>Ditolak</td>
                        <td>:</td>
                        <td><?= $jumlahPengajuan[2]; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total Pengajuan</td>
                        <td>:</td>
                        <td><?= $jumlahPengajuan[0] + $jumlahPengajuan[1] + $jumlahPengajuan[2]; ?></td>
                    </tr>
                </table>
            </div>
            <div class="kotak kotak-2 admin">
                <h3>Jumlah<br>Admin</h3>
                <h1><b><?= $jumlahAkun[0]; ?></b></h1>
            </div>
            <div class="kotak kotak-2 user">
                <h3>Jumlah<br>User</h3>
                <h1><b><?= $jumlahAkun[1]; ?></b></h1>
            </div>
            <div class="kotak kotak-3 kominfo">
                <img src="../../asset/img/logo_silomba.png" alt="Logo Kominfo" height="150px" style="display: block; margin: 60px auto;">
                <h1>Anda Masuk<br>Sebagai Admin</h1>
            </div>
        </div>
        <!-- Akhir konten -->
    </div>
</body>

</html>