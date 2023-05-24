<?php
session_start();
include "../../controller/config.php";
require('../../controller/admin/ambilData.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perincian</title>
    <link rel="stylesheet" href="../../asset/css/rinci.css">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
</head>

<body>
    <div class="atas">
        <div class="container">
            <a href="../../controller/logout.php"><img src="../../asset/img/icon/Logout-line.svg" alt=""></a>
            <a href="listPengajuan.php"><img src="../../asset/img/icon/back-line.svg" alt="" style="float: right;"></a>
        </div>
    </div>
    <?php
    //ambil data dari tb_admin di database
    $id = $_GET["id_aplikasi"];
    $data_pengajuan = pengajuan_rinci($id)[0];
    $file =  $data_pengajuan['proposal'];

    $ambildata = mysqli_query(dbKoneksi(), "SELECT * FROM aplikasi WHERE id_aplikasi = $id");
    while ($data = mysqli_fetch_array($ambildata)) {
    ?>
        <div class="konten container">
            <h1 style="text-align: center; font-weight: bold; letter-spacing: 2px;">Perincian</h1>
            <table>
                <tr>
                    <td>Judul Aplikasi</td>
                    <td>:</td>
                    <td><?php echo $data['judul_aplikasi']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal dibuat</td>
                    <td>:</td>
                    <td><?php echo $data['tanggal']; ?></td>
                </tr>
                <tr>
                    <td>Keterangan pengajuan</td>
                    <td>:</td>
                    <td><?php if ($data['notif'] == 0) {
                            echo "Masih Proses";
                        } elseif ($data['notif'] == 1) {
                            echo "Selamat Anda Lolos";
                        } else {
                            echo "Mohon Maaf, Anda Tidak Lolos";
                        } ?></td>
                </tr>
                <tr>
                    <td>Pesan</td>
                    <td>:</td>
                    <td><?php echo $data['pesan']; ?></td>
                </tr>
            <?php
        }
            ?>
            </table>
            <p>File</p>
            <a href="../../controller/admin/download.php?file=<?= $file ?>"><img src="../../admin/rar.svg" alt="" style="width: 150px;"></a>
        </div>
</body>

</html>