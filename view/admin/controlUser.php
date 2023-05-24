<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    echo "<script type='text/javascript'>document.location.href = '../../index.php';</script>";
}

include_once('../../controller/config.php');
include_once('../../controller/admin/ambilData.php');
require_once("../../controller/admin/register.php");
require_once('../../controller/query/perintahSelect.php');
require_once('../../controller/admin/jumlahData.php');


if (isset($_POST["Simpan"])) {
    if (data_masuk($_POST)) {
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

$jumlahAkun = jumlahAkun();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../asset/css/admin/controlUser.css?version=1">
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
                    <h5>Daftar Pengguna</h5>
                </div>
                <div class="isi">
                    <div class="atas">
                        <table>
                            <tr>
                                <td>Jumlah Admin</td>
                                <td>:</td>
                                <td><?= $jumlahAkun[0]; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah User</td>
                                <td>:</td>
                                <td><?= $jumlahAkun[1] ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Total</td>
                                <td>:</td>
                                <td><?= $jumlahAkun[0] + $jumlahAkun[1]; ?></td>
                            </tr>
                        </table>
                        <div class="keterangan">
                            <h5>Keterangan</h5>
                            <p class="user">Sebagai User</p>
                            <p class="admin">Sebagai Admin</p>
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
                                <input type="text" name="kata_kunci" value="<?php echo $kata_kunci; ?>" placeholder="Cari Pengguna" />
                            </span>
                            <!-- Kategori -->
                            <div class="dropdown" style="margin-left: 35px;">
                                <button class="btn btn-light dropdown-toggle tombol" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-style: italic;">
                                    Kategori
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="?level=0">Semua</a></li>
                                    <li><a class="dropdown-item" href="?level=1">Admin</a></li>
                                    <li><a class="dropdown-item" href="?level=2">User</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="tabel">
                        <table>
                            <tr>
                                <th>No</th>
                                <th class="nama">Nama</th>
                                <th>Aksi</th>
                            </tr>
                            <!-- Pagination -->
                            <?php
                            $jumlahDataPerHalaman = 5;
                            if (isset($_GET['kata_kunci'])) {
                                $jumlahData = count(data_users("SELECT * FROM users where username LIKE '%$kata_kunci' or username LIKE '$kata_kunci%' or username LIKE '%$kata_kunci%'"));
                                $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                                $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                                $sql = "SELECT * FROM users where username LIKE '%$kata_kunci' or username LIKE '$kata_kunci%' or username LIKE '%$kata_kunci%' LIMIT $awalData, $jumlahDataPerHalaman";
                                $cari = $_GET['kata_kunci'];
                                $_SESSION['posisi'] = "kata_kunci=$cari";
                            } else {
                                $jumlahData = count(data_users("SELECT * FROM users"));
                                $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                                $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                                $sql = "SELECT * FROM users ORDER BY username ASC LIMIT $awalData, $jumlahDataPerHalaman";
                                $_SESSION['posisi'] = "";
                            }

                            // Kategori
                            if (isset($_GET['level'])) {
                                if ($_GET['level'] == 1) {
                                    $level = $_GET['level'];
                                    $jumlahData = count(data_users("SELECT * FROM users WHERE level = $level"));
                                    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                                    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                                    $sql = "SELECT * FROM users WHERE level = $level  ORDER BY username ASC LIMIT $awalData, $jumlahDataPerHalaman";
                                    $cari = $_GET['level'];
                                    $_SESSION['posisi'] = "level=$cari";
                                } elseif ($_GET['level'] == 2) {
                                    $level = $_GET['level'];
                                    $jumlahData = count(data_users("SELECT * FROM users WHERE level = $level"));
                                    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                                    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                                    $sql = "SELECT * FROM users WHERE level = $level  ORDER BY username ASC LIMIT $awalData, $jumlahDataPerHalaman";
                                    $cari = $_GET['level'];
                                    $_SESSION['posisi'] = "level=$cari";
                                } elseif ($_GET['level'] == 0) {
                                    $level = $_GET['level'];
                                    $jumlahData = count(data_users("SELECT * FROM users"));
                                    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
                                    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
                                    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
                                    $sql = "SELECT * FROM users ORDER BY username ASC LIMIT $awalData, $jumlahDataPerHalaman";
                                    $cari = $_GET['level'];
                                    $_SESSION['posisi'] = "level=$cari";
                                }
                            }

                            $hasil = mysqli_query(dbKoneksi(), $sql);

                            $no = $awalData;
                            while ($data = mysqli_fetch_assoc($hasil)) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <?php if ($data["level"] == "1") { ?>
                                        <td class="akun admin"><?= $data["username"]; ?></td>
                                    <?php } else { ?>
                                        <td class="akun"><?= $data["username"]; ?></td>
                                    <?php } ?>
                                    <td>
                                        <a type="button" href="detail.php?id=<?php echo $data['id_user']; ?>" class="btn detail">Detail</a>
                                        <a href="editAkun.php?id=<?= $data['id_user']; ?>" class="btn edit">Edit</a>
                                        <a onclick="return confirm('Apakah anda yakin');" href="../../controller/admin/hapusAkun.php?id=<?= $data['id_user']; ?>" class="btn hapus">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                        <!-- tampilan Pagination -->
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
            <div class="kotak dua">
                <div class="bg">
                    <h5><img src="../../asset/img/icon/person_add-Filled.svg" alt="" style="padding-right: 10px; margin-top: -7px;">Tambah Akun</h5>
                </div>
                <div class="isi">
                    <form action="" method="POST">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" name="konfirmasi" id="konfirmasi">
                        <h6 style="margin-top: 20px; font-weight: bold;">Sebagai</h6>
                        <div style="margin-left: 20px;">
                            <input type="radio" name="level" id="admin" value="1">
                            <label for="admin">Admin</label><br>
                            <input type="radio" name="level" id="user" value="2">
                            <label for="user">User</label>
                        </div>
                        <button type="submit" class="btn" name="Simpan">Selesai</button>
                    </form>
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