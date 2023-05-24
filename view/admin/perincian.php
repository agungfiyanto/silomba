<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

require('../../controller/config.php');
require('../../controller/admin/ambilData.php');
$id = $_GET['id_aplikasi'];
$id_user = $_GET['id_user'];
$data_pengajuan = pengajuan_rinci($id)[0];
$file =  $data_pengajuan['proposal'];

if (isset($_GET['notif'])) {
    $notif = $_GET['notif'];
    $query = "UPDATE aplikasi SET notif = '$notif' WHERE id_aplikasi = $id";
    $perubahan = mysqli_query(dbKoneksi(), $query);
    header("Refresh:0");
    exit;
}

if (isset($_POST['simpanPesan'])) {
    $pesan = $_POST['pesan'];
    $query = "UPDATE aplikasi SET pesan = '$pesan' WHERE id_aplikasi = $id";
    mysqli_query(dbKoneksi(), $query);
    if (mysqli_affected_rows(dbKoneksi())) {
        echo "<script>
                alert('data berhasil di simpan');
            </script>";
        header("Refresh:0");
        exit;
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
    <link rel="stylesheet" href="../../asset/css/admin/perincian.css?version=2">
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
                <h3 class="title">Perincian Pengajuan</h3>
                <div class="kotak2">
                    <div class="isi">
                        <p>Proposal</p>
                        <table>
                            <tr>
                                <!-- Konten kiri pdf, download -->
                                <td>
                                    <div class="kotakpdf">
                                        <a href="../../controller/admin/download.php?file=<?= $file ?>">
                                            <img src="../../admin/rar.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="btnDownload">
                                        <a href="../../controller/admin/download.php?file=<?= $file ?>">Download</a>
                                    </div>
                                </td>
                                <!-- konten kanan -->
                                <td>
                                    <!-- keterangan -->
                                    <div class="keterangan">
                                        <table>
                                            <tr>
                                                <td>Judul Aplikasi</td>
                                                <td>:</td>
                                                <td><?= $data_pengajuan['judul_aplikasi']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Dibuat</td>
                                                <td>:</td>
                                                <td><?= $data_pengajuan['tanggal']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan Pengajuan</td>
                                                <td>:</td>
                                                <td>
                                                    <!-- dropdown -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-light dropdown-toggle tombol" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-style: italic;">
                                                            <?php if ($data_pengajuan['notif'] == 0) {
                                                                echo "Masih Proses"; ?>
                                                            <?php } elseif ($data_pengajuan['notif'] == 1) {
                                                                echo "Diterima"; ?>
                                                            <?php } elseif ($data_pengajuan['notif'] == 2) {
                                                                echo "Ditolak"; ?>
                                                            <?php } ?>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="?notif=1&id_aplikasi=<?= $id ?>&id_user=<?= $id_user; ?>">Terima</a></li>
                                                            <li><a class="dropdown-item" href="?notif=2&id_aplikasi=<?= $id ?>&id_user=<?= $id_user; ?>">Tolak</a></li>
                                                            <li><a class="dropdown-item" href="?notif=0&id_aplikasi=<?= $id ?>&id_user=<?= $id_user; ?>">Masih Proses</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <form action="" method="POST">
                                                <tr>
                                                    <!-- textarea -->
                                                    <td colspan="3">
                                                        <div class="mb-3" style="min-width: 100%">
                                                            <label for="exampleFormControlTextarea1" class="form-label">Beri Pesan</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pesan"><?= $data_pengajuan['pesan']; ?></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- tombol kanan bawah -->
                                                <tr class="tombolKanan">
                                                    <td colspan="3">
                                                        <button class="btnSimpan btn" type="submit" name="simpanPesan">Simpan</button>
                                                        <div class="btnKembali btn"><a href="detail.php?id=<?= $id_user; ?>">Data User</a></div>
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
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