<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Baru</title>
    <link rel="stylesheet" href="../../asset/css/pengajuan.css">
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">
</head>

<body>
    <nav class="container">
        <a href="listPengajuan.php"><img src="../../asset/img/icon/back-line2.svg" alt="" style="float: right;"></a>
    </nav>
    <div class="clear"></div>
    <div class="konten container">
        <p><b>Masukan judul aplikasi dan proposal Anda,<br>
                lalu tunggu konfirmasi dari kami</b></p>
        <form action="../../controller/upload.php" method="post" enctype="multipart/form-data">
            <label style="display: block;">Judul Aplikasi</label>
            <input type="text" name="judul" required="required">
            <br><br>
            <label style="display: block;">Upload Proposal</label>
            <input type="file" name="proposal">
            <br><br><br>
            <a href="persyaratan.php">Lihat Persyaratan</a>
            <br>
            <input type="submit" name="upload" value="KIRIM" class="btn btn-primary" style="width: 90px; float: right;">

        </form>
        <div class="gambar">
            <img src="../../asset/img/Add file.svg" alt="Tambah File">
        </div>
    </div>
</body>

</html>