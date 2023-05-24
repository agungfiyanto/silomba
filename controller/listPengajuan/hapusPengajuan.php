<?php
require_once "../config.php";
require_once "../query/perintahSelect.php";

$id_aplikasi = $_GET['id_aplikasi'];

if (HapusPengajuan($id_aplikasi)) {
    echo "<script>document.location.href='../../view/user/listPengajuan.php'</script>";
} else {
    "<script>
        alert('Data gagal dihapus');
        document.location.href = '../../view/user/listPengajuan.php';
    </script>";
}

function hapusPengajuan($id)
{
    $query = "DELETE FROM aplikasi WHERE id_aplikasi = $id";
    return mysqli_query(dbKoneksi(), $query);
}
