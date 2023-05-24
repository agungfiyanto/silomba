<?php
session_start();
$_SESSION['id_aplikasi'] = $_GET['id_aplikasi'];
echo "<script>document.location.href='../../view/user/detailPengajuan.php'</script>";
