<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

require('../../controller/config.php');
require('../../controller/admin/ambilData.php');
$id = $_GET['id'];
$data_user = users($id)[0];
$data_pengajuan = pengajuan($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/reset.css">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/admin/detail.css">
    <link rel="stylesheet" href="../../asset/css/admin/pagination.css">
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
                <h3 class="title">Detail</h3>
                <div class="kotak2">
                    <table class="table1">
                        <tr>
                            <td>
                                <table class="table2">
                                    <tr>
                                        <td>Nama </td>
                                        <td>: <?= $data_user['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Id User </td>
                                        <td>: <?= $data_user['id_user']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td>: <?= $data_user['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sebagai </td>
                                        <?php if ($data_user['level'] == 2) { ?>
                                            <td>: User Biasa</td>
                                        <?php } else { ?>
                                            <td>: Admin</td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Daftar Pengajuan <?= $data_user['username'];  ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table3">
                                    <tr>
                                        <th><b>Keterangan</b></th>
                                    </tr>
                                    <tr>
                                        <td><img src="../../asset/img/notif/tunggu.svg" alt="">
                                            <p>On Process</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="../../asset/img/notif/terima.svg" alt="">
                                            <p>Dalam Pengajuan</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <!-- Pagination -->
                    <?php
                    $jumlahDataPerHalaman = 3;
                    $jumlahData = count(pengajuan($id));
                    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                    $sql = "SELECT * from aplikasi WHERE id_user = $id LIMIT $awalData, $jumlahDataPerHalaman";
                    $_SESSION['posisi'] = "";

                    $hasil = mysqli_query(dbKoneksi(), $sql);
                    ?>
                    <!-- Akhir Pagination -->
                    <div class="tabel">
                        <table>
                            <tr>
                                <th>No</th>
                                <th class="nama">Judul Aplikasi</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = $awalData + 1;
                            while ($isi_data = mysqli_fetch_assoc($hasil)) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td class="akun admin">
                                        <?php if ($isi_data['notif'] == 0) { ?>
                                            <img src="../../asset/img/notif/tunggu.svg" alt="">
                                        <?php } elseif ($isi_data['notif'] == 1) { ?>
                                            <img src="../../asset/img/notif/terima.svg" alt=""><?php } ?>
                                        <?= $isi_data["judul_aplikasi"] ?>
                                    </td>
                                    <td><a href="perincian.php?id_aplikasi=<?= $isi_data['id_aplikasi'] ?>&id_user=<?= $id; ?>" class="btn">Lihat</a></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </table>
                        <!-- Pagination -->
                        <div class="pagination" id="atur_pagination">
                            <?php if ($halamanAktif > 1) { ?>
                                <a href="?halaman=<?= $halamanAktif - 1; ?>&<?= $_SESSION['posisi'] ?>id=<?= $id; ?>" class="btn">&laquo;</a>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if ($i == $halamanAktif) { ?>
                                    <a href="?halaman=<?= $i ?>&<?= $_SESSION['posisi'] ?>id=<?= $id; ?>" class="btn aktif"><?= $i; ?></a>
                                <?php } else { ?>
                                    <a href="?halaman=<?= $i ?>&<?= $_SESSION['posisi'] ?>id=<?= $id; ?>" class="btn"><?= $i; ?></a>
                                <?php } ?>
                            <?php endfor; ?>
                            <?php if ($halamanAktif < $jumlahHalaman) { ?>
                                <a href="?halaman=<?= $halamanAktif + 1; ?>&<?= $_SESSION['posisi'] ?>id=<?= $id; ?>" class="btn">&raquo;</a>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Akhir konten -->
    </div>
</body>

</html>