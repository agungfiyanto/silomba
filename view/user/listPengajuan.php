<?php
require_once "../../controller/config.php";
require_once "../../controller/query/perintahSelect.php";
require_once "../../controller/listPengajuan/menampilkanPengajuan.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan</title>
    <link rel="stylesheet" href="../../asset/css/list.css?version=1">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
</head>

<body>
    <div class="atas">
        <div class="container">
            <a onclick="return confirm('Apakah anda yakin ingin keluar');" href="../../controller/logout.php"><img src="../../asset/img/icon/Logout-line.svg" alt=""></a>
            <a href="../../index.php"><img src="../../asset/img/icon/back-line.svg" alt="" style="float: right;"></a>
        </div>
    </div>
    <div class="konten">
        <h1 style="text-align: center;">Pengajuan</h1>
        <div class="container">
            <a href="pengajuan.php" class="btn btn-primary">Buat Baru</a>
        </div>
        <div class="container" style="padding-bottom: 50px;">
            <table>
                <tr>
                    <th>Judul Proposal</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
                <?php $data = dataPengajuan();
                foreach ($data as $isi) :
                ?>
                    <tr class="data">
                        <td style="text-align: left;">
                            <?php if ($isi['notif'] == 0) { ?>
                                <img src="../../asset/img/notif/tunggu.svg" alt="">
                            <?php } elseif ($isi['notif'] == 1) { ?>
                                <img src="../../asset/img/notif/terima.svg" alt="">
                            <?php } else { ?>
                                <img src="../../asset/img/notif/tolak.svg" alt="">
                            <?php } ?>
                            <?= $isi['judul_aplikasi']; ?>
                        </td>
                        <td><?= $isi['tanggal']; ?></td>
                        <td>
                            <a href="detailPengajuan.php?id_aplikasi=<?= $isi['id_aplikasi']; ?>">lihat</a>
                            <span style="margin-left: 20px;"></span>
                            <a onclick="return confirm('Apakah anda yakin');" href="../../controller/listPengajuan/hapusPengajuan.php?id_aplikasi=<?= $isi['id_aplikasi']; ?>">hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>