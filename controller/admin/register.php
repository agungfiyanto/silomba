<?php
//Menambah akun user ke dalam database
function data_masuk($nilai)
{
    $username = $nilai["username"];
    $email = $nilai["email"];
    $password = $nilai["password"];
    $konfirmasi = $nilai["konfirmasi"];
    $level = $nilai["level"];

    //enkripsi
    $pass = md5($password);

    //Mengecek password
    if ($password == $konfirmasi) {
        //Memasukan data ke database
        $query = "INSERT INTO users VALUE ('','$username','$email','$pass','$level')";
        mysqli_query(dbKoneksi(), $query);
        return true;
    } else {
        $salah = false;
        return  $salah;
    }
}
