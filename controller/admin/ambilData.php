<?php

// Data Users
function users($id)
{
    $query = "SELECT * FROM users WHERE id_user = $id";
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}

// Semua Data Users
function semua_users()
{
    $query = "SELECT * FROM users";
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}

// Data pengajuan berdasarkan user tertentu
function pengajuan($id)
{
    $query = "SELECT * FROM aplikasi WHERE id_user = $id";
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}

// Mengambil satu data
function pengajuan_rinci($id)
{
    $query = "SELECT * FROM aplikasi WHERE id_aplikasi = $id";
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}

// Mengambil data pengajuan sesuai apa yang di inginkan
function semua_pengajuan($query)
{
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}

// Mengambil data pengajuan sesuai apa yang di inginkan
function data_users($query)
{
    $hasil = mysqli_query(dbKoneksi(), $query);
    $isi_data = [];
    while ($data = mysqli_fetch_assoc($hasil)) {
        $isi_data[] = $data;
    }
    return $isi_data;
}
