<?php
session_start();
require_once('config.php');

if ($_POST['upload']) {
    $judul    = $_POST['judul'];
    $idUser = $_SESSION["id_user"];
    $tanggal = date("y-m-d");
    $ekstensiDiperbolehkan    = array('pdf');
    $proposal    = $_FILES['proposal']['name'];
    $pisahKata       = explode('.', $proposal);
    $ekstensi    = strtolower(end($pisahKata));
    $ukuran        = $_FILES['proposal']['size'];
    $file_tmp    = $_FILES['proposal']['tmp_name'];

    if (in_array($ekstensi, $ekstensiDiperbolehkan) === true) {
        if ($ukuran < 30000000) {
            $query    = mysqli_query(dbKoneksi(), "INSERT INTO aplikasi VALUES(NULL, '$judul', '$proposal', '$idUser', '$tanggal', '', NULL, '0')");
            $get_id = mysqli_query(dbKoneksi(), "SELECT id_aplikasi FROM aplikasi ORDER BY id_aplikasi DESC LIMIT 1");
            $id  = mysqli_fetch_array($get_id);
            $namabaru = $idUser . "." . $id['id_aplikasi'] . "." . $judul . "." . $proposal;
            move_uploaded_file($file_tmp, '../dokumen/' . $namabaru);
            mysqli_query(dbKoneksi(), "UPDATE aplikasi SET proposal='$namabaru' WHERE id_aplikasi='$id[id_aplikasi]'");
            if ($query) {
                echo "<script>
                alert('UPLOAD FILE BERHASIL');
                window.location.href='../view/user/listPengajuan.php';
                </script>";
            } else {
                echo "<script>
                alert('UPLOAD FILE GAGAL');
                window.location.href='../view/user/listPengajuan.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('UKURAN FILE TERLALU BESAR');
                window.location.href='../view/user/listPengajuan.php';
                </script>";
        }
    } else {

        echo "<script>
                alert('EKSTENSI FILE YANG DIGUNAKAN SALAH');
                window.location.href='../view/user/listPengajuan.php';
                </script>";
    }
}
