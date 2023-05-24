<?php
session_start();
require('data.php');

$id_aplikasi = $_GET['id_aplikasi'];
$nama= mysqli_query($conn,"SELECT proposal FROM aplikasi WHERE id_aplikasi='$id_aplikasi'");
$proposal  = mysqli_fetch_array($nama);

if(hapusData($id_aplikasi)){
    unlink('../../dokumen/'.$proposal['proposal']);
    echo "<script>document.location.href='../../view/list.php'</script>";
}else{
    "<script>
        alert('Data gagal dihapus');
        document.location.href = '../../view/list.php';
    </script>";
}
