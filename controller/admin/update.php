<?php
function data_masuk($nilai)
{
    global $kon;
    $id = $nilai["id"];
    $username = $nilai["username"];
    $email = $nilai["email"];
    $password = $nilai["password"];
    $konfirmasi = $nilai["konfirmasi"];
    $level = $nilai["level"];

    //enkripsi
    $pass = md5($password);
    $konfirm = md5($konfirmasi);

    //Mengecek password
    if ($pass == $konfirm) {
        $query = "UPDATE users SET
                    username = '$username',
                    email = '$email',
                    password = '$pass',
                    level = '$level'
                    WHERE id_user = $id";
        mysqli_query(dbKoneksi(), $query);
        return true;
    } else {
        return  false;
    }
}
