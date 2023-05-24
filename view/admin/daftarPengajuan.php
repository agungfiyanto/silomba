<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

include_once('../../controller/config.php');
require('../../controller/admin/ambilData.php');
require_once('../../controller/query/perintahSelect.php');
require_once('../../controller/admin/jumlahData.php');

$jumlahPengajuan = jumlahPengajuan();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/admin/navigasi.css">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/admin/daftarPengajuan.css">
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
            <div class="kotak satu">
                <div class="bg">
                    <h5>Daftar Pengajuan</h5>
                </div>
                <div class="isi">
                    <div class="atas">
                        <table>
                            <tr>
                                <td>Masih Proses</td>
                                <td>:</td>
                                <td><?= $jumlahPengajuan[0]; ?></td>
                            </tr>
                            <tr>
                                <td>Diterima</td>
                                <td>:</td>
                                <td><?= $jumlahPengajuan[1]; ?></td>
                            </tr>
                            <tr>
                                <td>Ditolak</td>
                                <td>:</td>
                                <td><?= $jumlahPengajuan[2]; ?></td>
                            </tr>
                            <tr>
                                <td>Total Pengajuan</td>
                                <td>:</td>
                                <td><?= $jumlahPengajuan[0] + $jumlahPengajuan[1] + $jumlahPengajuan[2]; ?></td>
                            </tr>
                        </table>
                        <div class="keterangan">
                            <h5>Keterangan</h5>
                            <img src="../../asset/img/notif/tunggu.svg" alt="">
                            <p>Masih Proses</p>
                            <img src="../../asset/img/notif/terima.svg" alt="">
                            <p>Diterima</p>
                            <img src="../../asset/img/notif/tolak.svg" alt="">
                            <p>Ditolak</p>
                        </div>
                    </div>
                    <div class="search">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET">
                            <!-- Cari -->
                            <span>
                                <img src="../../asset/img/icon/search-Filled.svg" alt="">
                                <?php
                                $kata_kunci = "";
                                if (isset($_GET['kata_kunci'])) {
                                    $kata_kunci = $_GET['kata_kunci'];
                                }
                                ?>
                                <input type="text" name="kata_kunci" value="<?php echo $kata_kunci; ?>" placeholder="Cari Pengajuan" />
                            </span>
                            <!-- Kategori -->
                            <div class="dropdown" style="margin-left: 35px;">
                                <button class="btn btn-light dropdown-toggle tombol" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-style: italic;">
                                    Kategori
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="?notif=3">Semua</a></li>
                                    <li><a class="dropdown-item" href="?notif=0">Masih Proses</a></li>
                                    <li><a class="dropdown-item" href="?notif=1">Diterima</a></li>
                                    <li><a class="dropdown-item" href="?notif=2">Ditolak</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>

                    <?php
                    $jumlahDataPerHalaman = 5;
                    if (isset($_GET['kata_kunci'])) {
                        $jumlahData = count(semua_pengajuan("SELECT * from aplikasi where judul_aplikasi LIKE '%$kata_kunci' or judul_aplikasi LIKE '$kata_kunci%' or judul_aplikasi LIKE '%$kata_kunci%'"));
                        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                        $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                        $sql = "SELECT * from aplikasi where judul_aplikasi LIKE '%$kata_kunci' or judul_aplikasi LIKE '$kata_kunci%' or judul_aplikasi LIKE '%$kata_kunci%' LIMIT $awalData, $jumlahDataPerHalaman";
                        $cari = $_GET['kata_kunci'];
                        $_SESSION['posisi'] = "kata_kunci=$cari";
                    } else {
                        $jumlahData = count(semua_pengajuan("SELECT * FROM aplikasi"));
                        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                        $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                        $sql = "SELECT * from aplikasi order by judul_aplikasi asc LIMIT $awalData, $jumlahDataPerHalaman";
                        $_SESSION['posisi'] = "";
                    }

                    // Kategori
                    if (isset($_GET['notif'])) {
                        if ($_GET['notif'] == 0) {
                            $notif = $_GET['notif'];
                            $jumlahData = count(semua_pengajuan("SELECT * FROM aplikasi WHERE notif = $notif"));
                            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                            $sql = "SELECT * FROM aplikasi WHERE notif = $notif  ORDER BY judul_aplikasi ASC LIMIT $awalData, $jumlahDataPerHalaman";
                            $cari = $notif;
                            $_SESSION['posisi'] = "notif=$cari";
                        } elseif ($_GET['notif'] == 1) {
                            $notif = $_GET['notif'];
                            $jumlahData = count(semua_pengajuan("SELECT * FROM aplikasi WHERE notif = $notif"));
                            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                            $sql = "SELECT * FROM aplikasi WHERE notif = $notif  ORDER BY judul_aplikasi ASC LIMIT $awalData, $jumlahDataPerHalaman";
                            $cari = $notif;
                            $_SESSION['posisi'] = "notif=$cari";
                        } elseif ($_GET['notif'] == 2) {
                            $notif = $_GET['notif'];
                            $jumlahData = count(semua_pengajuan("SELECT * FROM aplikasi WHERE notif = $notif"));
                            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                            $sql = "SELECT * FROM aplikasi WHERE notif = $notif  ORDER BY judul_aplikasi ASC LIMIT $awalData, $jumlahDataPerHalaman";
                            $cari = $notif;
                            $_SESSION['posisi'] = "notif=$cari";
                        } elseif ($_GET['notif'] == 3) {
                            $notif = $_GET['notif'];
                            $jumlahData = count(semua_pengajuan("SELECT * FROM aplikasi"));
                            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                            $sql = "SELECT * FROM aplikasi ORDER BY judul_aplikasi ASC LIMIT $awalData, $jumlahDataPerHalaman";
                            $cari = $notif;
                            $_SESSION['posisi'] = "notif=$cari";
                        }
                    }
                    $hasil = mysqli_query(dbKoneksi(), $sql);
                    ?>

                    <div class="tabel">
                        <table>
                            <tr>
                                <th>No</th>
                                <th class="nama">Judul Aplikasi</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = $awalData + 1;
                            while ($pengajuan = mysqli_fetch_assoc($hasil)) { ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td class="akun admin">
                                        <?php if ($pengajuan['notif'] == 0) { ?>
                                            <img src="../../asset/img/notif/tunggu.svg" alt="">
                                        <?php } elseif ($pengajuan['notif'] == 1) { ?>
                                            <img src="../../asset/img/notif/terima.svg" alt="">
                                        <?php } elseif ($pengajuan['notif'] == 2) { ?>
                                            <img src="../../asset/img/notif/tolak.svg" alt="">
                                        <?php } ?>
                                        <?= $pengajuan['judul_aplikasi']; ?>
                                    </td>
                                    <?php $id_user = $pengajuan['id_user']; ?>
                                    <td><a href="perincian.php?id_aplikasi=<?= $pengajuan['id_aplikasi'] ?>&id_user=<?= $id_user; ?>" class="btn">Lihat</a></td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </table>
                        <!-- Pagination -->
                        <div class="pagination" id="atur_pagination">
                            <?php if ($halamanAktif > 1) { ?>
                                <a href="?halaman=<?= $halamanAktif - 1; ?>&<?= $_SESSION['posisi'] ?>" class="btn">&laquo;</a>
                            <?php } ?>
                            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if ($i == $halamanAktif) { ?>
                                    <a href="?halaman=<?= $i ?>&<?= $_SESSION['posisi'] ?>" class="btn aktif"><?= $i; ?></a>
                                <?php } else { ?>
                                    <a href="?halaman=<?= $i ?>&<?= $_SESSION['posisi'] ?>" class="btn"><?= $i; ?></a>
                                <?php } ?>
                            <?php endfor; ?>
                            <?php if ($halamanAktif < $jumlahHalaman) { ?>
                                <a href="?halaman=<?= $halamanAktif + 1; ?>&<?= $_SESSION['posisi'] ?>" class="btn">&raquo;</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../asset/bootstrap/js/jquery.js"></script>
    <script src="../../asset/bootstrap/js/popper.js"></script>
    <script src="../../asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../asset/alert/sweetalert2.all.min.js"></script>
</body>

</html>