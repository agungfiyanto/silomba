<?php
require('../config.php');
$id_pengguna = $_GET['id'];

//fungsi untuk menghapus data
function hapusData($id)
{
    global $kon;
    $query = "DELETE FROM users WHERE id_user = $id";
    mysqli_query(dbKoneksi(), $query);
    return true;
}

if (hapusData($id_pengguna)) {
    echo "<script>document.location.href='../../view/admin/controlUser.php'</script>";
} else {
    echo
    "<script>
        alert('Data gagal dihapus');
        document.location.href = '../../view/admin/controlUser.php';
    </script>";
}
